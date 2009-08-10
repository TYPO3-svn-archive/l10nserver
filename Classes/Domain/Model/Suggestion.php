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
 * A suggestion
 *
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_L10nServer_Domain_Model_Suggestion extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
     * Suggestion for translation
     *
	 * @var string
	 */
	protected $suggestion = '';

	/**
     * Is suggestion approved
     *
	 * @var bool
	 */
	protected $approved = false;

	/**
     * Label id
     *
	 * @var int
	 */
	protected $labelUid = '';

	/**
     * User id
     *
	 * @var int
	 */
	protected $userUid = '';

	/**
     * Language id
     *
	 * @var int
	 */
	protected $langUid = '';

    /**
     * Constructor for Suggestion object
     *
     * @param string $suggestion
     * @param int $labelId
     * @param int $userId
     * @param int $langId
     */
    public function __construct($suggestion = '', $labelId, $userId, $langId) {
        if (!empty($suggestion)) {
            $this->setSuggestion($suggestion);
            $this->setLabelUid($labelId);
            $this->setUserUid($userId);
            $this->setLangUid($langId);

            $this->setApproved(false);
        }
    }

    /**
     * Setter for approvement
     *
     * @param bool $approved
     */
    public function setApproved($approved = true) {
        $this->approved = $approved;
    }

    /**
     * Getter for approvement
     *
     * @return bool
     */
    public function getApproved() {
        return $this->approved;
    }

    /**
     * Setter for label id
     *
     * @param int $labelUid
     */
    public function setLabelUid($labelUid) {
        $this->labelUid = $labelUid;
    }

    /**
     * Getter for label id
     *
     * @return int
     */
    public function getLabelUid() {
        return $this->labelUid;
    }

    /**
     * Setter for user id
     *
     * @param int $userUid
     */
    public function setUserUid($userUid) {
        $this->userUid = $userUid;
    }

    /**
     * Getter for user id
     *
     * @return int
     */
    public function getUserUid() {
        return $this->userUid;
    }

    /**
     * Setter for language id
     *
     * @param int $langUid
     */
    public function setLangUid($langUid) {
        $this->langUid = $langUid;
    }

    /**
     * Getter for language id
     *
     * @return int
     */
    public function getLangUid() {
        return $this->langUid;
    }

    /**
     * Getter for suggestion
     *
     * @return string
     */
    public function getSuggestion() {
        return $this->suggestion;
    }

    /**
     * Setter for suggestion
     *
     * @param string
     */
    public function setSuggestion($suggestion) {
        $this->suggestion = $suggestion;
    }

    public function __toString() {
        return $this->getSuggestion();
    }
}
