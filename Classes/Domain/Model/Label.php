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
 * A label
 *
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_L10nServer_Domain_Model_Label extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
     * The uid of the project part the label is related to
     *
	 * @var int 
	 */
	protected $partUid;

	/**
     * The label name
     *
	 * @var string
	 */
	protected $name = '';

	/**
     * The label english text
     *
	 * @var string
	 */
	protected $description = '';

	/**
     * Suggestions for translation
     *
	 * @var array
	 */
	protected $suggestions = array();

	/**
     * Current user suggestion for translation
     *
	 * @var string
	 */
	protected $userSuggestion = '';

	/**
     * Approved translation
     *
	 * @var string
	 */
	protected $approved_translation = '';

	/**
	 * Constructs this label
	 */
	public function __construct() {
	}	

    public function makeSuggestionRepository() {
        static $suggestionRepository;

        if (empty($suggestionRepository) 
            || ! ($suggestionRepository instanceof Tx_L10nServer_Domain_Repository_SuggestionRepository)) {
           $suggestionRepository = t3lib_div::makeInstance('Tx_L10nServer_Domain_Repository_SuggestionRepository');
        }

        return $suggestionRepository;
    }
	
	/**
	 * Sets the uid of the blog this post is related to
	 *
	 * @param int $blogUid The blog uid
	 * @return void
	 */
	public function setPartUid($partUid) {
		$this->partUid = $partUid;
	}

	/**
	 * Returns the uid of the part this label is related to
	 *
	 * @return int The part uid this label is part of
	 */
	public function getPartUid() {
		return $this->partUid;
	}
	
	/**
	 * Setter for name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Getter for name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Setter for num
	 *
	 * @param string $num
	 * @return void
	 */
	public function setNum($num) {
		$this->num = $num;
	}

	/**
	 * Getter for num
	 *
	 * @return string
	 */
	public function getNum() {
		return $this->num;
	}

	/**
	 * Setter for description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Getter for description
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Setter for suggestions
	 *
	 * @param array $suggestions One or more Tx_L10nServer_Domain_Model_Suggestion objects
	 * @return void
	 */
	public function setSuggestion(array $suggestions) {
		foreach ($suggestions as $suggestion) {
			$this->addSuggestion($suggestion);			
		}
	}

	/**
	 * Adds a suggestion to this label
	 *
	 * @param Tx_L10nServer_Domain_Model_Suggestion $tag
	 * @return void
	 */
	public function addSuggestion(Tx_L10nServer_Domain_Model_Suggestion $suggestion) {
		$this->suggestions[] = $suggestion;
	}

	/**
	 * TODO: Getter for suggestions
	 *
	 * @return array of Tx_L10nServer_Domain_Model_Suggestions objects
	 */
	public function getSuggestions() {
		return $this->suggestions;
	}


	/**
	 * Getter for approved translation
	 *
	 * @return string approved translation
	 */
	public function getApprovedTranslation() {
        return $this->makeSuggestionRepository()
            ->findApprovedByLang($this->getUid(), $_SESSION['l10nserver']['lang_id']);
	}

	/**
	 * TODO: Getter for user suggestion
	 * 
	 * @return string user suggestion
	 */
	public function getUserSuggestion() {
        $suggestion = $this->makeSuggestionRepository()
            ->findByUserAndLang(
                $this->getUid(), 
                $_SESSION['l10nserver']['user_id'], 
                $_SESSION['l10nserver']['lang_id']);

        return !empty($suggestion) ? $suggestion->getSuggestion() : '';
	}

	/**
	 * Returns this label as a formatted string
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->name;
	}
}
