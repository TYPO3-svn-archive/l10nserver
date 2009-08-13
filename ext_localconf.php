<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

Tx_Extbase_Utility_Extension::configureDispatcher(
	$_EXTKEY,
	'Pi1',
	array(
		'Project' => 'index',
        'Part' => 'index',
        'Label' => 'index',
        'Suggestion' => 'add',
	),
    array(
        'Suggestion' => 'add',
    )
);

Tx_Extbase_Utility_Extension::configureDispatcher(
	$_EXTKEY,
	'Pi2',
	array(
		'Suggestion' => 'index,process',
	),
    array(
		'Suggestion' => 'process',
    )
);
