<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2009 Andriy Kushnarov <akushnarov@gmail.com>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * The Project controller for the 'l10n server' package
 *
 * @author Andriy Kushnarov <akushnarov@gmail.com>
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class Tx_L10nServer_Controller_SuggestionController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_L10nServer_Domain_Repository_SuggestionRepository
	 */
	protected $suggestionRepository;

	/**
	 * @var Tx_L10nServer_Domain_Repository_LabelRepository
	 */
	protected $labelRepository;

	/**
	 * @var int
	 */
	protected $langId = 0;

	/**
	 * @var int
	 */
	protected $translatorId = 0;

	/**
	 * Initializes the current action and repositories
	 *
	 * @return void
	 */
	public function initializeAction() {		
		$this->labelRepository = t3lib_div::makeInstance('Tx_L10nServer_Domain_Repository_LabelRepository');

		$this->suggestionRepository = t3lib_div::makeInstance('Tx_L10nServer_Domain_Repository_SuggestionRepository');
		$this->translatorRepository = t3lib_div::makeInstance('Tx_L10nServer_Domain_Repository_TranslatorRepository');
        
        $this->setVars();
	}
    
    //  TODO: validate lang
    protected function setVars() {
        @session_start();

        $this->langId = !empty($_SESSION['l10nserver']['language']) ? 
            $_SESSION['l10nserver']['language'] : '';

        //  Throw exception if not registered user
        //  TODO Important: translator should have pid (fe_user.pid) same as plugin
        //  TODO: Check if user is in appropriate group: translator (if seted in TypoScript) or ChifTranslator 
        if (
            ! $this->translator = $this->translatorRepository
                ->findByUid(intval($GLOBALS['TSFE']->fe_user->user['uid']))
        ) {
            throw new Exception('Unregistered user');
        }
    }

	/**
	 * Index action for this controller. Displays a list of projects.
	 *
	 * @return string The rendered view
	 */
	public function indexAction() {
	}

	/**
	 * Process approved/canceled actions
	 *
	 * @param array of Suggestions
	 */
	public function processAction($suggestions) {
	}

	/**
	 * Add suggestion
     * @param Tx_L10nServer_Domain_Model_Project $project
     * @param Tx_L10nServer_Domain_Model_Part $part
	 *
	 * @return void
	 */
	public function addAction(Tx_L10nServer_Domain_Model_Project $project) {
        $added = false;

        $userSuggestions = $this->request->getArguments();
        foreach ($userSuggestions['suggestion'] as $labelId => $suggestion) {
            $labelId = intval($labelId);
            if (empty($suggestion) || $labelId <= 0) {
                continue;
            }
            
            $currentSuggestion = $this->suggestionRepository->
                findByUserAndLang($labelId, $this->translatorId, $this->langId);

            if (!empty($currentSuggestion)) {
                $currentSuggestion->setSuggestion($suggestion);
            } else {
                $currentSuggestion = t3lib_div::makeInstance('Tx_L10nServer_Domain_Model_Suggestion', 
                    $suggestion, NULL, $this->translator, $this->langId);

                $label = $this->labelRepository->findByUid($labelId);
                if (! empty($label)) {
                    $label->addSuggestion($currentSuggestion);
                }
            }

            $added = true;
        }

        /**
         * After suggestions are added redirect to labels list
         * + flash message: Suggestions was added
         */
        if ($added) {
		    $this->flashMessages->add('TODO LL:suggestion_was_added');
        }
        $this->redirect('index', 'Label', NULL, array('project' => $project));
	}
}
