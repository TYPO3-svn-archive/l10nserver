<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

Tx_Extbase_Utility_Plugin::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'L10n Server: Translate'
);

Tx_Extbase_Utility_Plugin::registerPlugin(
	$_EXTKEY,
	'Pi2',
	'L10n Server: Manage'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'L10n Server');

t3lib_extMgm::allowTableOnStandardPages('tx_l10nserver_domain_model_project');
$TCA['tx_l10nserver_domain_model_project'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:l10nserver/Resources/Private/Language/locallang_db.xml:tx_l10nserver_domain_model_project',
		'label' 			=> 'name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> true,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',	
		'transOrigPointerField' 	=> 'l18n_parent',	
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',	
		'prependAtCopy' 	=> 'LLL:EXT:lang/locallang_general.xml:LGL.prependAtCopy',
		'copyAfterDuplFields' 		=> 'sys_language_uid',
		'useColumnsForDefaultValues' => 'sys_language_uid',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Private/Icons/icon_tx_l10nserver_domain_model_blog.gif'
	)
);

t3lib_extMgm::allowTableOnStandardPages('tx_l10nserver_domain_model_part');
$TCA['tx_l10nserver_domain_model_part'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:l10nserver/Resources/Private/Language/locallang_db.xml:tx_l10nserver_domain_model_part',
		'label' 			=> 'name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> true,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',	
		'transOrigPointerField' 	=> 'l18n_parent',	
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',	
		'prependAtCopy' 	=> 'LLL:EXT:lang/locallang_general.xml:LGL.prependAtCopy',
		'copyAfterDuplFields' 		=> 'sys_language_uid',
		'useColumnsForDefaultValues' => 'sys_language_uid',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Private/Icons/icon_tx_l10nserver_domain_model_blog.gif'
	)
);

t3lib_extMgm::allowTableOnStandardPages('tx_l10nserver_domain_model_label');
$TCA['tx_l10nserver_domain_model_label'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:l10nserver/Resources/Private/Language/locallang_db.xml:tx_l10nserver_domain_model_label',
		'label' 			=> 'name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> true,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',	
		'transOrigPointerField' 	=> 'l18n_parent',	
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',	
		'prependAtCopy' 	=> 'LLL:EXT:lang/locallang_general.xml:LGL.prependAtCopy',
		'copyAfterDuplFields' 		=> 'sys_language_uid',
		'useColumnsForDefaultValues' => 'sys_language_uid',
        'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Private/Icons/icon_tx_l10nserver_domain_model_blog.gif'
	)
);

t3lib_extMgm::allowTableOnStandardPages('tx_l10nserver_domain_model_suggestion');
$TCA['tx_l10nserver_domain_model_suggestion'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:l10nserver/Resources/Private/Language/locallang_db.xml:tx_l10nserver_domain_model_suggestion',
		'label' 			=> 'suggestion',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> true,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',	
		'transOrigPointerField' 	=> 'l18n_parent',	
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',	
		'prependAtCopy' 	=> 'LLL:EXT:lang/locallang_general.xml:LGL.prependAtCopy',
		'copyAfterDuplFields' 		=> 'sys_language_uid',
		'useColumnsForDefaultValues' => 'sys_language_uid',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Private/Icons/icon_tx_l10nserver_domain_model_blog.gif'
	)
);

