<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_l10nserver_domain_model_project'] = array(
	'ctrl' => $TCA['tx_l10nserver_domain_model_project']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'name, description'
	),
	'columns' => array(
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
	),
	'types' => array(
		'1' => array('showitem' => 'name, description')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	)
);

