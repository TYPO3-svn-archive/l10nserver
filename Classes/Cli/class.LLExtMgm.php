<?php


class Tx_L10nserver_Cli_LLExtMgm {
    /**
     * Paths where to search for extensions. All paths are reletive to TYPO3ROOT (!)
     *
     * @var array
     */
    //protected $listOfExtDirs = array('typo3/sysext/', 'typo3/ext/', 'typo3conf/ext/');
    protected $listOfExtDirs = array('typo3conf/ext/');

    /**
     * Array containing info about extensions
     * array(
     *      'EXT KEY' => array(
     *          'title' => '...',
     *          'description' => '...',
     *          'version' => '...',
     *          'path' => '...',
     *          'lang_files' => array(),
     *          'labels' => array(),
     *      ),
     * )
     *
     * @var array
     */
    protected $listOfExtensions = array();

    /**
     * Name of extension info file (by default ext_emconf.php)
     *
     * @var string
     */
    protected $extConfFile = 'ext_emconf.php';

    /**
     * Prefix of locallang files
     *
     * @var string
     */
    protected $langFilePrefix = 'locallang';

    /**
     * Lang file extension
     *
     * @var string
     */
    protected $langFileExt = 'xml';

    /**
     * Default translation key (e.g. 'default' for locallang.xml)
     *
     * @var string
     */
    protected $defaultLangFileKey = 'default';
    
    /**
     * Constructor
     */
    public function __construct($listOfExtensions = array(), $extConfFile = '') {
        if (! empty($listOfExtensions)) {
            $this->listOfExtensions = $listOfExtensions;
        }

        if (! empty($extConfFile)) {
            $this->extConfFile = $extConfFile;
        }
    }

    public function addExtDir($dir) {
        $this->listOfExtDirs[] = $dir;
    }

    public function setExtDirs(array $dirs) {
        $this->listOfExtDirs = $dirs;
    }

    public function setExtConfFile($file) {
        $this->extConfFile = $file;
    }

    public function getExtensions() {
        if (empty($this->listOfExtensions)) {
            $this->process();
        }

        return $this->listOfExtensions;
    }

    public function process() {
        $extPaths = $this->getExtPaths($this->listOfExtDirs);

        foreach ($extPaths as $extPath) {
            $this->listOfExtensions[ $this->getExtKey($extPath) ] = 
                $this->getExtInfo($extPath);
        }
    }

    public function getExtPaths(array $listOfExtDirs) {
        $extPaths = array();

        foreach ($listOfExtDirs as $dir) {
            $extDir = realpath(TYPO3ROOT. '/'. $dir). '/';

			if (is_dir($extDir) && is_readable($extDir)) {
               @$extPaths = t3lib_div::getAllFilesAndFoldersInPath(
                    $extPaths, $extDir, 'php', NULL, 99, '^\.svn');
            }
        }

        $len = strlen($this->extConfFile);
        foreach ($extPaths as $k => $path) {
            if (substr($path, -$len, $len) != $this->extConfFile) {
                unset($extPaths[$k]);
            } else {
                $extPaths[$k] = dirname($path);
            }
        }
        
        return array_values($extPaths);
    }
    
    public function getExtKey($path) {
        $key = $this->isExtDir($path);
        if (empty($key)) {
            throw new Exception("'$path' is not extension directory.");
        }

        return $key;
    }

    public function isExtDir($path) {
        static $extDirCache;

        $path = realpath($path);
        if (!empty($extDirCache) && array_key_exists($path, $extDirCache)) {
            return $extDirCache[$path];
        }

        if (is_readable($path. '/'. $this->extConfFile)) {
            $extDirCache[$path] = basename($path);
            return $extDirCache[$path];
        } 
        
        return NULL;
    }

    public function getExtInfo($path) {
        $key = $this->isExtDir($path);
        if (empty($key)) {
            throw new Exception("'$path' is not extension directory.");
        }
        
        $_EXTKEY = $key;
        include_once($path. '/'. $this->extConfFile);
        
        $info = $EM_CONF[$_EXTKEY];
        $info['path'] = realpath($path);
        $info['lang_files'] = $this->findLLFiles($path);

        if ($info['lang_files']) {
            $info['labels'] = $this->readLangFiles($info['lang_files']);
        }

        return $info;
    }

    /**
     * Finds all locallang files inside exension dir
     * (!) Returns all llfiles reletive to ext dir path
     *
     * @param $path string ext dir path
     * @return array of LL files
     */
    public function findLLFiles($path) {
        $path .= '/';
        $files = array();
        
       @$files = t3lib_div::getAllFilesAndFoldersInPath(
           $files, $path, $this->langFileExt, NULL, 99, '^\.svn');

        foreach ($files as $k => $file) {
            if (substr(basename($file), 0, strlen($this->langFilePrefix)) != $this->langFilePrefix) {
                unset($files[$k]);
            } 
        }
        
        $files = t3lib_div::removePrefixPathFromList($files, TYPO3ROOT);
        return array_values($files);
    }

    /**
     * Read list of lang files
     *
     * @param $files array list of files to read
     * @return array of 'lang file' => array of 'label' => 'default translation' 
     */
    public function readLangFiles(array $files) {
        $labels = array();
        foreach ($files as $file) {
             $labelsTmp = $this->readLLXMLfile(
                TYPO3ROOT. "/$file", $this->defaultLangFileKey);

            if (!empty($labelsTmp)) {
                $labels[ $file ] = $labelsTmp;
            }
        }

        return $labels;
    }

    /**
     * Read locallang XML file.
     * Note: source code is taken from t3lib_div::xml2arrayProcess 
     * (because this method is originally "protected")
     *
     * @param $file string file to read
     * @param $key string name of the key to read
     * @return array 'label' => 'default translation'
     */
    public function readLLXMLfile($file) {
        $NSprefix = '';
        $reportDocTag = FALSE;

        $string = t3lib_div::getUrl($file);
        
		$parser = xml_parser_create();
		$vals = array();
		$index = array();

		xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
		xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 0);

			// default output charset is UTF-8, only ASCII, ISO-8859-1 and UTF-8 are supported!!!
		$match = array();
		preg_match('/^[[:space:]]*<\?xml[^>]*encoding[[:space:]]*=[[:space:]]*"([^"]*)"/',substr($string,0,200),$match);
		$theCharset = 'iso-8859-1';
		xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, $theCharset);  // us-ascii / utf-8 / iso-8859-1

			// Parse content:
		xml_parse_into_struct($parser, $string, $vals, $index);

			// If error, return error message:
		if (xml_get_error_code($parser))	{
            throw new Exception('Line '
                . xml_get_current_line_number($parser). ': ' 
                . xml_error_string(xml_get_error_code($parser)));
		}
		xml_parser_free($parser);

			// Init vars:
		$stack = array(array());
		$stacktop = 0;
		$current = array();
		$tagName = '';
		$documentTag = '';

			// Traverse the parsed XML structure:
		foreach($vals as $key => $val) {

				// First, process the tag-name (which is used in both cases, whether "complete" or "close")
			$tagName = $val['tag'];
			if (!$documentTag)	$documentTag = $tagName;

				// Test for name space:
			$tagName = ($NSprefix && substr($tagName,0,strlen($NSprefix))==$NSprefix) ? substr($tagName,strlen($NSprefix)) : $tagName;

				// Test for numeric tag, encoded on the form "nXXX":
			$testNtag = substr($tagName,1);	// Closing tag.
			$tagName = (substr($tagName,0,1)=='n' && !strcmp(intval($testNtag),$testNtag)) ? intval($testNtag) : $tagName;

				// Test for alternative index value:
			if (!empty($val['attributes']['index']))	{ $tagName = $val['attributes']['index']; }

				// Setting tag-values, manage stack:
			switch($val['type'])	{
				case 'open':		// If open tag it means there is an array stored in sub-elements. Therefore increase the stackpointer and reset the accumulation array:
					$current[$tagName] = array();	// Setting blank place holder
					$stack[$stacktop++] = $current;
					$current = array();
				break;
				case 'close':	// If the tag is "close" then it is an array which is closing and we decrease the stack pointer.
					$oldCurrent = $current;
					$current = $stack[--$stacktop];
					end($current);	// Going to the end of array to get placeholder key, key($current), and fill in array next:
					$current[key($current)] = $oldCurrent;
					unset($oldCurrent);
				break;
				case 'complete':	// If "complete", then it's a value. If the attribute "base64" is set, then decode the value, otherwise just set it.
					if (!empty($val['attributes']['base64']))	{
						$current[$tagName] = base64_decode($val['value']);
					} else {
                        if (! isset($val['value'])) {
                            $val['value'] = '';
                        }

						$current[$tagName] = (string)$val['value']; // Had to cast it as a string - otherwise it would be evaluate false if tested with isset()!!
                        if (empty($val['attributes']['type'])) {
                            break;
                        }
							// Cast type:
						switch((string)$val['attributes']['type'])	{
							case 'integer':
								$current[$tagName] = (integer)$current[$tagName];
							break;
							case 'double':
								$current[$tagName] = (double)$current[$tagName];
							break;
							case 'boolean':
								$current[$tagName] = (bool)$current[$tagName];
							break;
							case 'array':
								$current[$tagName] = array();	// MUST be an empty array since it is processed as a value; Empty arrays would end up here because they would have no tags inside...
							break;
						}
					}
				break;
			}
		}

		if ($reportDocTag)	{
			$current[$tagName]['_DOCUMENT_TAG'] = $documentTag;
		}
        
		return $current[$tagName]['data'][$this->defaultLangFileKey];
    }

}
