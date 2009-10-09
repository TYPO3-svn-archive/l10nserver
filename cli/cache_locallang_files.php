<?php

define('TYPO3_cliMode', TRUE);

require 'Classes/class.locallang_files.php';

define(L10N_CACHE_FILE, TYPO3ROOT. '/typo3conf/ext/l10nserver/l10n_cache.txt');

$locallangFiles = new locallang_files();
$labels = $locallangFiles->getLabels();

$labels = serialize($labels);
fwrite(fopen(L10N_CACHE_FILE, "w"), $labels);
