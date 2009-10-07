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
 * Label for translation
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */


class Tx_L10nserver_Domain_Model_Label extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * 
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name;
	
	/**
	 * 
	 * @var string
	 * @validate NotEmpty
	 */
	protected $englishtext;
	
	/**
	 * 
	 * @var string
	 * @validate NotEmpty
	 */
	protected $filepath;
	
	/**
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_L10nserver_Domain_Model_Suggestion>
	 */
	protected $suggestions;

	/**
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_L10nserver_Domain_Model_Suggestion>
	 */
	protected $otherSuggestions;

	/**
	 * 
	 * @var Tx_L10nserver_Domain_Repository_SuggestionRepository
	 */
	protected $suggestionRepository = NULL;
	
	/**
	 * Enumeration index
     *
	 * @var int
	 */
	protected $num = 0;

	/**
	 * Constructor. Initializes all Tx_Extbase_Persistence_ObjectStorage instances.
	 */
	public function __construct() {
		$this->suggestions = new Tx_Extbase_Persistence_ObjectStorage();

        $this->initSuggestionRepository();
	}

    protected function initSuggestionRepository() {
        $this->suggestionRepository = 
            t3lib_div::makeInstance('Tx_L10nserver_Domain_Repository_SuggestionRepository');
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
	 * Setter for name
	 *
	 * @param string $name 
	 * @return void
	 */
	public function setName( $name) {
		$this->name = $name;
	}
	
	/**
	 * Getter for englishtext
	 * 
	 * @return string 
	 */
	public function getEnglishtext() {
		return $this->englishtext;
	}
	
	/**
	 * Setter for englishtext
	 *
	 * @param string $englishtext 
	 * @return void
	 */
	public function setEnglishtext( $englishtext) {
		$this->englishtext = $englishtext;
	}
	
	/**
	 * Getter for filepath
	 * 
	 * @return string 
	 */
	public function getFilepath() {
		return $this->filepath;
	}
	
	/**
	 * Setter for filepath
	 *
	 * @param string $filepath 
	 * @return void
	 */
	public function setFilepath( $filepath) {
		$this->filepath = $filepath;
	}
	
	/**
	 * Getter for suggestions
	 * 
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_L10nserver_Domain_Model_Suggestion> 
	 */
	public function getSuggestions() {
		return $this->suggestions;
	}
	
	/**
	 * Setter for suggestions
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_L10nserver_Domain_Model_Suggestion> $suggestions 
	 * @return void
	 */
	public function setSuggestions(Tx_Extbase_Persistence_ObjectStorage $suggestions) {
		$this->suggestions = $suggestions;
	}
	
	// TODO: ADD the "add"-method for the "ManyToMany" Relation as well
	/**
	 * Add a Suggestion
	 *
	 * @param Tx_L10nserver_Domain_Model_Suggestion The Suggestion to add
	 * @return void
	 */
	public function addSuggestion(Tx_L10nserver_Domain_Model_Suggestion $suggestion) {
		$this->suggestions->attach($suggestion);
	}
	
	/**
	 * Getter for num
	 * 
	 * @return int 
	 */
	public function getNum() {
		return $this->num;
	}
	
	/**
	 * Setter for num
	 *
	 * @param int $num 
	 * @return void
	 */
	public function setNum( $num) {
		$this->num = $num;
	}

	/**
	 * Getter for otherSuggestions
	 * 
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_L10nserver_Domain_Model_Suggestion> $suggestions 
	 */
	public function getOtherSuggestions() {
        if (! 
            ($this->suggestionRepository instanceof Tx_L10nserver_Domain_Repository_SuggestionRepository) 
        ) {
            $this->initSuggestionRepository();
        }

        $this->otherSuggestions = 
            $this->suggestionRepository->findOtherSuggestions($this);

		return $this->otherSuggestions;
	}
	
	/**
	 * Setter for otherSuggestions
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_L10nserver_Domain_Model_Suggestion> $suggestions 
	 * @return void
	 */
	public function setOtherSuggestions( $otherSuggestions) {
		$this->otherSuggestions = $otherSuggestions;
	}

    public function __toString() {
        return $this->englishtext;
    }
}
