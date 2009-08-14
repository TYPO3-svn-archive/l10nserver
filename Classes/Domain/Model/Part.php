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
 * A Project part
 *
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_L10nServer_Domain_Model_Part extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
     * The uid of the project the part is related to
     *
	 * @var int
	 */
	protected $projectUid;

	/**
	 * The project's name
     *
	 * @var string
	 */
	protected $name = '';

	/**
	 * A short description of the project
     *
	 * @var string
	 */
	protected $description = '';

	/**
	 * Number in list
	 *
	 * @var int
	 */
    protected $num = 0;

	/**
     * Labels contained in this project part
     *
	 * @var array
	 */
	protected $labels = array();

	/**
	 * Constructs this post
     *
     * @return
	 */
	public function __construct($name = '', $description = '') {
        if (!empty($name)) {
            $this->name = $name;
            $this->description = $description;
        }
	}	
    
	
	/**
	 * Sets the uid of the blog this post is related to
	 *
	 * @param int $projectUid The project uid
	 * @return void
	 */
	public function setProjectUid($projectUid) {
		$this->projectUid = $projectUid;
	}

	/**
	 * Returns the uid of the project this part is related to
	 *
	 * @return int The project uid this (project) part is part of :)
	 */
	public function getProjectUid() {
		return $this->projectUid;
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
	 * @return string Description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets number in the list
	 *
	 * @param string $num The part's number
	 * @return void
	 */
	public function setNum($num) {
		$this->num = $num;
	}

	/**
	 * Returns the part's number
	 *
	 * @return int The part's number
	 */
	public function getNum() {
		return $this->num;
	}

	/**
	 * Setter for labels
	 *
	 * @param array $labels One or more Tx_L10nServer_Domain_Model_Label objects
	 * @return void
	 */
	public function setLabels(array $labels) {
		foreach ($labels as $label) {
			$this->addLabel($label);
		}
	}

	/**
	 * Adds a label to this part
	 *
	 * @param Tx_L10nServer_Domain_Model_Label $label
	 * @return void
	 */
	public function addLabel(Tx_L10nServer_Domain_Model_Label $label) {
		$this->labels[] = $label;
	}

	/**
	 * Getter for labels
	 *
	 * @return array of Tx_L10nServer_Domain_Model_Label objects
	 */
	public function getLabels() {
        $i = 1;
        foreach ($this->labels as $label) {
            $label->setNum($i++);
        }

		return $this->labels;
	}

	/**
	 * Returns this part as a formatted string
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->name;
	}
}
