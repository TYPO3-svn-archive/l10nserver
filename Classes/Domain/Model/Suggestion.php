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
 * Suggestions for label translation
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */


class Tx_L10nserver_Domain_Model_Suggestion extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * 
	 * @var string
	 * @validate NotEmpty
	 */
	protected $translation;
	
	/**
	 * 
	 * @var DateTime
	 * @validate NotEmpty
	 */
	protected $datetime;
	
	/**
	 * 
	 * @var boolean
	 * @validate NotEmpty
	 */
	protected $approved;
	
	/**
	 * 
	 * @var Tx_L10nserver_Domain_Model_Translator
	 */
	protected $translator;
	
	/**
	 * 
	 * @var Tx_L10nserver_Domain_Model_Language
	 */
	protected $language;

	/**
	 * 
	 * @var Tx_L10nserver_Domain_Model_Language
	 */
	protected $label_uid;
	

	/**
	 * Constructor. Initializes all Tx_Extbase_Persistence_ObjectStorage instances.
	 */
	public function __construct($suggestion = '', $label = 0, $translator = 0, $lang = 0, $approved = 0) {
	    if (! empty($suggestion)) {
            $this->setTranslation($suggestion);

            $this->setDatetime(new DateTime);

            $this->setTranslator($translator);
            $this->setLanguage($lang);
            $this->setApproved($approved);

            if ($label > 0) {
                $this->setLabelUid($label);
            }
        }
	}
	
	/**
	 * Getter for translation
	 * 
	 * @return string 
	 */
	public function getTranslation() {
		return $this->translation;
	}
	
	/**
	 * Setter for translation
	 *
	 * @param string $translation 
	 * @return void
	 */
	public function setTranslation($translation) {
		$this->translation = $translation;
	}
	
	/**
	 * Getter for datetime
	 * 
	 * @return DateTime 
	 */
	public function getDatetime() {
		return $this->datetime;
	}
	
	/**
	 * Setter for datetime
	 *
	 * @param DateTime $datetime 
	 * @return void
	 */
	public function setDatetime(DateTime $datetime) {
		$this->datetime = $datetime;
	}
	
	/**
	 * Getter for approved
	 * 
	 * @return boolean 
	 */
	public function getApproved() {
		return $this->approved;
	}
	
	/**
	 * Setter for approved
	 *
	 * @param boolean $approved 
	 * @return void
	 */
	public function setApproved( $approved) {
		$this->approved = $approved;
	}
	
	/**
	 * Getter for translator
	 * 
	 * @return Tx_L10nserver_Domain_Model_Translator 
	 */
	public function getTranslator() {
		return $this->translator;
	}
	
	/**
	 * Setter for translator
	 *
	 * @param Tx_L10nserver_Domain_Model_Translator $translator 
	 * @return void
	 */
	public function setTranslator(Tx_L10nserver_Domain_Model_Translator $translator) {
		$this->translator = $translator;
	}
	
	/**
	 * Getter for language
	 * 
	 * @return Tx_L10nserver_Domain_Model_Language 
	 */
	public function getLanguage() {
		return $this->language;
	}
	
	/**
	 * Setter for language
	 *
	 * @param Tx_L10nserver_Domain_Model_Language $language 
	 * @return void
	 */
	public function setLanguage($language) {
		$this->language = $language;
	}

	/**
	 * Setter for label_uid
	 *
	 * @param int $label_uid 
	 * @return void
	 */
	public function setLabelUid($label) {
		$this->label_uid = $label;
	}
}
