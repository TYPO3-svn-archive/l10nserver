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
	 * Initializes the current action and repositories
	 *
	 * @return void
	 */
	public function initializeAction() {		
        session_start();

		$this->suggestionRepository = t3lib_div::makeInstance('Tx_L10nServer_Domain_Repository_SuggestionRepository');
	}

	/**
	 * Index action for this controller. Displays a list of projects.
	 *
	 * @return string The rendered view
	 */
	public function indexAction() {
	}

	/**
	 * Add suggestion
     * @param Tx_L10nServer_Domain_Model_Project $project
     * @param Tx_L10nServer_Domain_Model_Part $part
	 *
	 * @return void
	 */
	public function addAction(Tx_L10nServer_Domain_Model_Project $project, Tx_L10nServer_Domain_Model_Part $part) {
        $added = false;
        $userSuggestions = $this->request->getArguments();

        $userId = $_SESSION['l10nserver']['user_id'];
        $langId = $_SESSION['l10nserver']['lang_id'];

        foreach ($userSuggestions['suggestion'] as $labelId => $suggestion) {
            if (empty($suggestion)) {
                continue;
            }
            
            $userSuggestion = $this->suggestionRepository->
                findByUserAndLang($labelId, $userId, $langId);

            if (!empty($userSuggestion)) {
                $userSuggestion->setSuggestion($suggestion);
            } else {
                $userSuggestion = t3lib_div::makeInstance('Tx_L10nServer_Domain_Model_Suggestion', 
                    $suggestion, 
                    $labelId, 
                    $userId,
                    $langId
                );
                
                $this->suggestionRepository->add($userSuggestion);
            }

            $added = true;
        }

        /**
         * After suggestions are added redirect to labels list
         */
        $this->redirect('index', 'Label', NULL, 
            array('project' => $project, 'part' => $part, 'suggestions_are_added' => $added));
	}
}
