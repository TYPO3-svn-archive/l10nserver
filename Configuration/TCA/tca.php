<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_l10nserver_domain_model_project'] = array(
	'ctrl' => $TCA['tx_l10nserver_domain_model_project']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'name,description,version,labels'
	),
	'types' => array(
		'1' => array('showitem' => 'name,description,version,labels')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	),
	'columns' => array(

		'sys_language_uid' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config' => array (
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages',-1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value',0)
				)
			)
		),
		'l18n_parent' => array (
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => array (
				'type' => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table' => 'tt_news',
				'foreign_table_where' => 'AND tt_news.uid=###REC_FIELD_l18n_parent### AND tt_news.sys_language_uid IN (-1,0)', // TODO
			)
		),
		'l18n_diffsource' => array(
			'config'=>array(
				'type'=>'passthrough')
		),
		't3ver_label' => array (
			'displayCond' => 'FIELD:t3ver_label:REQ:true',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
			'config' => array (
				'type'=>'none',
				'cols' => 27
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type' => 'check'
			)
		),
		
		'name' => array(
			'exclude' => 0,
			'label'   => 'name', // TODO 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_blog.title',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			)
		),
		
		'description' => array(
			'exclude' => 0,
			'label'   => 'description', // TODO 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_blog.title',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			)
		),
		
		'version' => array(
			'exclude' => 0,
			'label'   => 'version', // TODO 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_blog.title',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			)
		),
		
		'labels' => array(
			'exclude' => 0,
			'label'   => 'labels', // TODO 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_blog.title',
			'config'  => array(
				'type' => 'inline',
				'loadingStrategy' => 'proxy', // TODO: was "storage"
				'foreign_class' => 'Tx_L10nserver_Domain_Model_Label',
				'foreign_table' => 'tx_l10nserver_domain_model_label',
				'foreign_field' => 'project_uid',
				'maxitems'      => 999999, // TODO This is only necessary because of a bug in tcemain
				'appearance' => array(
				 'newRecordLinkPosition' => 'bottom',
				 'collapseAll' => 1,
				 'expandSingle' => 1,
				),
			)
		),
		
		
	),
);

$TCA['tx_l10nserver_domain_model_label'] = array(
	'ctrl' => $TCA['tx_l10nserver_domain_model_label']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'name,englishtext,filepath,suggestions'
	),
	'types' => array(
		'1' => array('showitem' => 'name,englishtext,filepath,suggestions')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	),
	'columns' => array(

		'sys_language_uid' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config' => array (
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages',-1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value',0)
				)
			)
		),
		'l18n_parent' => array (
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => array (
				'type' => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table' => 'tt_news',
				'foreign_table_where' => 'AND tt_news.uid=###REC_FIELD_l18n_parent### AND tt_news.sys_language_uid IN (-1,0)', // TODO
			)
		),
		'l18n_diffsource' => array(
			'config'=>array(
				'type'=>'passthrough')
		),
		't3ver_label' => array (
			'displayCond' => 'FIELD:t3ver_label:REQ:true',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
			'config' => array (
				'type'=>'none',
				'cols' => 27
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type' => 'check'
			)
		),
		
		'name' => array(
			'exclude' => 0,
			'label'   => 'name', // TODO 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_blog.title',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			)
		),
		
		'englishtext' => array(
			'exclude' => 0,
			'label'   => 'englishtext', // TODO 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_blog.title',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			)
		),
		
		'filepath' => array(
			'exclude' => 0,
			'label'   => 'filepath', // TODO 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_blog.title',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			)
		),
		
		'suggestions' => array(
			'exclude' => 0,
			'label'   => 'suggestions', // TODO 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_blog.title',
			'config'  => array(
				'type' => 'inline',
				'loadingStrategy' => 'proxy', // TODO: was "storage"
				'foreign_class' => 'Tx_L10nserver_Domain_Model_Suggestion',
				'foreign_table' => 'tx_l10nserver_domain_model_suggestion',
				'foreign_field' => 'label_uid',
				'maxitems'      => 999999, // TODO This is only necessary because of a bug in tcemain
				'appearance' => array(
				 'newRecordLinkPosition' => 'bottom',
				 'collapseAll' => 1,
				 'expandSingle' => 1,
				),
			)
		),
		
		
		'project_uid' => array(
			'config' => array(
				'type' => 'passthrough',
			)
		),
		
	),
);

$TCA['tx_l10nserver_domain_model_suggestion'] = array(
	'ctrl' => $TCA['tx_l10nserver_domain_model_suggestion']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'translation,approved,translator,language'
	),
	'types' => array(
		'1' => array('showitem' => 'translation,approved,translator,language')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	),
	'columns' => array(

		'sys_language_uid' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config' => array (
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages',-1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value',0)
				)
			)
		),
		'l18n_parent' => array (
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => array (
				'type' => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table' => 'tt_news',
				'foreign_table_where' => 'AND tt_news.uid=###REC_FIELD_l18n_parent### AND tt_news.sys_language_uid IN (-1,0)', // TODO
			)
		),
		'l18n_diffsource' => array(
			'config'=>array(
				'type'=>'passthrough')
		),
		't3ver_label' => array (
			'displayCond' => 'FIELD:t3ver_label:REQ:true',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
			'config' => array (
				'type'=>'none',
				'cols' => 27
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type' => 'check'
			)
		),
		
		'translation' => array(
			'exclude' => 0,
			'label'   => 'translation', // TODO 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_blog.title',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			)
		),
		
		'approved' => array(
			'exclude' => 0,
			'label'   => 'approved', // TODO 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_blog.title',
			'config'  => array(
				'type' => 'check',
				'default' => 0
			)
		),

		'translator' => Array (		
			'exclude' => 1,		
			'label'   => 'LLL:EXT:l10nserver/Resources/Private/Language/locallang_db.xml:tx_l10nserver_domain_model_suggestion.translator',
			'config' => Array (
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'foreign_class' => 'Tx_L10nServer_Domain_Model_Translator',
//				'foreign_table_where' => 'AND fe_users.pid=###STORAGE_PID###',
				'maxitems' => 1,
			)
		),

		'language' => array(
			'exclude' => 0,
			'label'   => 'language',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			)
		),
		
		'label_uid' => array(
			'config' => array(
				'type' => 'passthrough',
			)
		),
		
	),
);

