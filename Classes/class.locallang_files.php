<?php

define('TYPO3ROOT', realpath(dirname(__FILE__). '../../../../../'));
require_once(TYPO3ROOT. '/t3lib/class.t3lib_div.php');

define(L10N_CACHE_FILE, TYPO3ROOT. '/typo3conf/ext/l10nserver/l10n_cache.txt');

class locallang_files {

    protected $listOfExtDirs = array('typo3/sysext/', 'typo3/ext/', 'typo3conf/ext/');

    protected $listOfLocallangFiles = array();

    public function __construct() {
    }

    public function addExtDir($dir) {
        $this->listOfExtDirs[] = $dir;
    }

    public function setExtDirs($dirs) {
        $this->listOfExtDirs = $dirs;
    }

    public function getListOfLocallangFiles() {
        foreach ($this->listOfExtDirs as $dir) {
            $dir = TYPO3ROOT. '/'. $dir;

			if (is_dir($dir) && is_readable($dir)) {
                $this->listOfLocallangFiles =
                    t3lib_div::getAllFilesAndFoldersInPath($this->listOfLocallangFiles, $dir, 'xml');
            }
        }
        
        $this->listOfLocallangFiles = 
            t3lib_div::removePrefixPathFromList($this->listOfLocallangFiles, TYPO3ROOT);
        
        foreach ($this->listOfLocallangFiles as $key => $file) {
            if (substr(basename($file), 0, 9) != 'locallang') {
                unset($this->listOfLocallangFiles[$key]);
            }
        }

        return $this->listOfLocallangFiles;
    }

    public function getLogicalPath($file) {
        $logicalPath = array();

        if(preg_match('#ext/([^/]+)/#', $file, $extKey)) {
            $logicalPath['extKey'] = $extKey[1];
        } else {
            return array();
        }

        if(preg_match('#/(mod\d*|pi\d*|func\d*)/#', $file, $part)) {
            $logicalPath['part'] = $part[1];
        } else {
            $logicalPath['part'] = 'default';
        }

        return $logicalPath;
    }

    public function getLogicalTree() {
        if (empty($this->listOfLocallangFiles)) {
            $this->getListOfLocallangFiles();
        }

        $logicalTree = array();
        foreach ($this->listOfLocallangFiles as $file) {
            $logicalPath = $this->getLogicalPath($file);

            if (!empty($logicalPath)) {
                $logicalTree[$logicalPath['extKey']][$logicalPath['part']][] = $file;
            }
        }
        
        return $logicalTree;
    }

    public function getLabels() {
        $labels = array();

        $logicalTree = $this->getLogicalTree();
        foreach ($logicalTree as $extKey => $modules) {
            foreach ($modules as $moduleName => $files) {
                foreach ($files as $file) {
                    $xml = file_get_contents(TYPO3ROOT. "/$file");

                    $labelsFromXML = t3lib_div::xml2tree($xml);
                    
                    $labelsFromXML = 
                        $labelsFromXML
                            ['T3locallang']
                            [0]
                            ['ch']
                            ['data']
                            [0]
                            ['ch']
                            ['languageKey']
                            [0]
                            ['ch']
                            ['label'];

                    if (!is_array($labelsFromXML)) {
                        continue;
                    }

                    foreach ($labelsFromXML as $labelInfo) {
                        $labels[$extKey][$moduleName][$file]
                            [$labelInfo['attrs']['index']] =
                                $labelInfo['values'][0];
                    }
                }
            }
        }
        
        return $labels;
    }
    
}
