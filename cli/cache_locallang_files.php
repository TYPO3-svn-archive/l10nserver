<?php

define('TYPO3_cliMode', TRUE);

require 'Classes/class.locallang_files.php';

$locallangFiles = new locallang_files();
$labels = $locallangFiles->getLabels();

$labels = serialize($labels);
fwrite(fopen(L10N_CACHE_FILE, "w"), $labels);
