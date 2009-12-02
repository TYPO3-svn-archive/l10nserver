<?php
    
    if (! defined('TYPO3ROOT')) {
        define('TYPO3ROOT', realpath(dirname(__FILE__). '/../../../../../'));
    }

    if(! isset($GLOBALS['TYPO3_CONF_VARS'])) {
        $GLOBALS['TYPO3_CONF_VARS'] = array();
    }

    if(! isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['curlUse'])) {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['curlUse'] = 0;
    }

    if(! isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['no_pconnect'])) {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['no_pconnect'] = FALSE;
    }

    if(! isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['dbClientCompress'])) {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['dbClientCompress'] = FALSE;
    }


    define('TYPO3_cliMode', TRUE);
    //define('TYPO3_MODE', 'BE');

    require_once(TYPO3ROOT. '/t3lib/class.t3lib_div.php');
    //require_once(TYPO3ROOT. '/t3lib/class.t3lib_extmgm.php');

    define('PATH_typo3conf', TYPO3ROOT. '/typo3conf/');
    define('PATH_site', TYPO3ROOT);

    require_once(PATH_typo3conf. '/localconf.php');
    require_once(TYPO3ROOT. '/t3lib/class.t3lib_db.php');
    $GLOBALS['TYPO3_DB'] = t3lib_div::makeInstance('t3lib_DB');

    define('TYPO3_db_host',     $typo_db_host);
    define('TYPO3_db_username', $typo_db_username);
    define('TYPO3_db_password', $typo_db_password);
    define('TYPO3_db',          $typo_db);

    @$GLOBALS['TYPO3_DB']->connectDB();
    
    require_once(dirname(__FILE__). '/class.LLExtMgm.php');
    require_once(dirname(__FILE__). '/class.UpdateDb.php');

    $o = new Tx_L10nserver_Cli_UpdateDb();
    $o->update();
    
