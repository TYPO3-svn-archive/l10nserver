<?php

$extensionClassesPath = t3lib_extMgm::extPath('l10nserver') . 'Classes/';
return array(
    'tx_l10nserver_domain_model_project' => 
        $extensionClassesPath. 'Domain/Model/Project.php',
    'tx_l10nserver_domain_model_part' => 
        $extensionClassesPath. 'Domain/Model/Part.php',
    'tx_l10nserver_domain_model_label' => 
        $extensionClassesPath. 'Domain/Model/Label.php',
    'tx_l10nserver_domain_model_suggestion' => 
        $extensionClassesPath. 'Domain/Model/Suggestion.php',

    'tx_l10nserver_domain_repository_projectrepository' => 
        $extensionClassesPath. 'Domain/Repository/ProjectRepository.php',
    'tx_l10nserver_domain_repository_partrepository' => 
        $extensionClassesPath. 'Domain/Repository/PartRepository.php',
    'tx_l10nserver_domain_repository_translatorrepository' => 
        $extensionClassesPath. 'Domain/Repository/TranslatorRepository.php',
    'tx_l10nserver_domain_repository_suggestionrepository' => 
        $extensionClassesPath. 'Domain/Repository/SuggestionRepository.php',
    'tx_l10nserver_domain_repository_labelrepository' => 
        $extensionClassesPath. 'Domain/Repository/LabelRepository.php',
);
