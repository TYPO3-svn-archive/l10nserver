<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_l10nserver_domain_model_project'] = array(
	'ctrl' => $TCA['tx_l10nserver_domain_model_project']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden, name, description, parts, num'
	),
	'columns' => array(
		'hidden' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type' => 'check'
			)
		),
		'name' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:l10nserver/Resources/Private/Language/locallang_db.xml:tx_l10nserver_domain_model_project.name',
			'config'  => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim,required',
				'max'  => 256
			)
		),
		'num' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:l10nserver/Resources/Private/Language/locallang_db.xml:tx_l10nserver_domain_model_project.name',
			'config'  => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim,required',
				'max'  => 256
			)
		),
		'description' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:l10nserver/Resources/Private/Language/locallang_db.xml:tx_l10nserver_domain_model_project.description',
			'config'  => array(
				'type' => 'text',
				'eval' => 'required',
				'rows' => 30,
				'cols' => 80,
			)
		),
		'parts' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:l10nserver/Resources/Private/Language/locallang_db.xml:tx_l10nserver_domain_model_project.parts',
			'config' => array(
				'type' => 'inline',
				'foreign_class' => 'Tx_L10nServer_Domain_Model_Part',
				'foreign_table' => 'tx_l10nserver_domain_model_part',
				'foreign_field' => 'project_uid',
				'foreign_table_field' => 'project_table',
				'appearance' => array(
					'newRecordLinkPosition' => 'bottom',
					'collapseAll' => 1,
					'expandSingle' => 1,
				),
			)
		),
	),
	'types' => array(
		'1' => array('showitem' => 'hidden, name, description, parts, num')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	)
);

$TCA['tx_l10nserver_domain_model_part'] = array(
	'ctrl' => $TCA['tx_l10nserver_domain_model_part']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden, name, description, labels, num'
	),
	'columns' => array(
		'hidden' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type' => 'check'
			)
		),
		'name' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:l10nserver/Resources/Private/Language/locallang_db.xml:tx_l10nserver_domain_model_part.title',
			'config'  => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim, required',
				'max'  => 256
			)
		),
		'description' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:l10nserver/Resources/Private/Language/locallang_db.xml:tx_l10nserver_domain_model_part.title',
			'config'  => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim, required',
				'max'  => 256
			)
		),
		'labels' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:l10nserver/Resources/Private/Language/locallang_db.xml:tx_l10nserver_domain_model_project.labels',
			'config' => array(
				'type' => 'inline',
				'foreign_class' => 'Tx_L10nServer_Domain_Model_Label',
				'foreign_table' => 'tx_l10nserver_domain_model_label',
				'foreign_field' => 'part_uid',
				'foreign_table_field' => 'part_table',
				'appearance' => array(
					'newRecordLinkPosition' => 'bottom',
					'collapseAll' => 1,
					'expandSingle' => 1,
				),
			)
		),
		'num' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:l10nserver/Resources/Private/Language/locallang_db.xml:tx_l10nserver_domain_model_project.name',
			'config'  => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim,required',
				'max'  => 256
			)
		),
		'project_uid' => array(		
			'config' => array(
				'type' => 'passthrough',	
			)
		),
		'project_table' => array(		
			'config' => array(
				'type' => 'passthrough',	
			)
		),
	),
	'types' => array(
		'1' => array('showitem' => 'hidden, name, description, labels, num')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	)
);

$TCA['tx_l10nserver_domain_model_label'] = array(
	'ctrl' => $TCA['tx_l10nserver_domain_model_label']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden, name, description, suggestions, num'
	),
	'columns' => array(
		'hidden' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type' => 'check'
			)
		),
		'name' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:l10nserver/Resources/Private/Language/locallang_db.xml:tx_l10nserver_domain_model_part.title',
			'config'  => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim, required',
				'max'  => 256
			)
		),
		'description' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:l10nserver/Resources/Private/Language/locallang_db.xml:tx_l10nserver_domain_model_part.title',
			'config'  => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim, required',
				'max'  => 256
			)
		),
		'num' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:l10nserver/Resources/Private/Language/locallang_db.xml:tx_l10nserver_domain_model_project.name',
			'config'  => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim,required',
				'max'  => 256
			)
		),
		'approved_translation' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:l10nserver/Resources/Private/Language/locallang_db.xml:tx_l10nserver_domain_model_part.title',
			'config'  => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim, required',
				'max'  => 256
			)
		),
		'user_suggestion' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:l10nserver/Resources/Private/Language/locallang_db.xml:tx_l10nserver_domain_model_part.title',
			'config'  => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim, required',
				'max'  => 256
			)
		),
		'suggestions' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:l10nserver/Resources/Private/Language/locallang_db.xml:tx_l10nserver_domain_model_project.labels',
			'config' => array(
				'type' => 'inline',
				'foreign_class' => 'Tx_L10nServer_Domain_Model_Suggestion',
				'foreign_table' => 'tx_l10nserver_domain_model_suggestion',
				'foreign_field' => 'label_uid',
				'foreign_table_field' => 'label_table',
				'appearance' => array(
					'newRecordLinkPosition' => 'bottom',
					'collapseAll' => 1,
					'expandSingle' => 1,
				),
			)
		),
		'part_uid' => array(		
			'config' => array(
				'type' => 'passthrough',	
			)
		),
		'part_table' => array(		
			'config' => array(
				'type' => 'passthrough',	
			)
		),
	),
	'types' => array(
		'1' => array('showitem' => 'hidden, title, description, suggestions, num, approved_translation, user_suggestion')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	)
);

$TCA['tx_l10nserver_domain_model_suggestion'] = array(
	'ctrl' => $TCA['tx_l10nserver_domain_model_suggestion']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden, suggestion, approved'
	),
	'columns' => array(
		'hidden' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type' => 'check'
			)
		),
		'suggestion' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:l10nserver/Resources/Private/Language/locallang_db.xml:tx_l10nserver_domain_model_part.title',
			'config'  => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim, required',
				'max'  => 256
			)
		),
		'approved' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type' => 'check'
			)
		),
///////////
		'label_uid' => array(		
			'config' => array(
				'type' => 'passthrough',	
			)
		),
		'label_table' => array(		
			'config' => array(
				'type' => 'passthrough',	
			)
		),
///////////
		'user_uid' => array(		
			'config' => array(
				'type' => 'passthrough',	
			)
		),
		'user_table' => array(		
			'config' => array(
				'type' => 'passthrough',	
			)
		),
///////////
    'lang_uid' => array(		
			'config' => array(
				'type' => 'passthrough',	
			)
		),
	'lang_table' => array(		
			'config' => array(
				'type' => 'passthrough',	
			)
		),
////////
	),
	'types' => array(
		'1' => array('showitem' => 'hidden, suggestion, approved')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	)
);
