<?php

define('TYPO3ROOT', realpath(dirname(__FILE__). '../../../../../../'));
require_once(TYPO3ROOT. '/t3lib/class.t3lib_div.php');

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
     *          'llfiles' => array(),
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

    public function getListOfExtensions() {
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
        $info['llfiles'] = $this->findLLFiles($path);

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
}
