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
 * A Project
 *
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_L10nServer_Domain_Model_Project extends Tx_Extbase_DomainObject_AbstractEntity {

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
	 * The parts contained in this project
	 *
	 * @var array
	 */
	protected $parts = array();

	/**
	 * Number in the list table
	 *
	 * @var int
	 */
    protected $num = 0;

	/**
	 * Constructs this project
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
	 * Sets this project's name
	 *
	 * @param string $name The project's name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the project's name
	 *
	 * @return string The project's name
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Sets the description for the project
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the description
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets this project's number
	 *
	 * @param int $num The project's number
	 * @return void
	 */
	public function setNum($num) {
		$this->num = $num;
	}

	/**
	 * Returns the project's number
	 *
	 * @return int The project's number
	 */
	public function getNum() {
		return $this->num;
	}

	/**
	 * Adds a part to this project
	 *
	 * @param Tx_L10nServer_Domain_Model_Part $part
	 * @return void
	 */
	public function addPart(Tx_L10nServer_Domain_Model_Part $part) {
		$this->parts[] = $part;
	}

	/**
	 * Adds parts to this project
	 *
	 * @param array of Tx_L10nServer_Domain_Model_Part $part
	 * @return void
	 */
	public function setParts($parts) {
        foreach ($parts as $part) {
            $this->addPart($part);
        }
	}

	/**
	 * Returns all parts from this project
	 *
	 * @return array of Tx_L10nServer_Domain_Model_Post
	 */
	public function getParts() {
        $i = 1;
        foreach ($this->parts as $part) {
            $part->setNum($i++);
        }

		return $this->parts;
	}

	/**
	 * Returns this project as a formatted string
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->name;
	}
}
