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
 * Project entity
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */


class Tx_L10nserver_Domain_Model_Project extends Tx_Extbase_DomainObject_AbstractEntity {
	
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
	protected $description;
	
	/**
	 * 
	 * @var string
	 * @validate NotEmpty
	 */
	protected $version;
	
	/**
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_L10nserver_Domain_Model_Label>
	 */
	protected $labels;

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
		$this->labels = new Tx_Extbase_Persistence_ObjectStorage();
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
	 * Getter for description
	 * 
	 * @return string 
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 * Setter for description
	 *
	 * @param string $description 
	 * @return void
	 */
	public function setDescription( $description) {
		$this->description = $description;
	}
	
	/**
	 * Getter for version
	 * 
	 * @return string 
	 */
	public function getVersion() {
		return $this->version;
	}
	
	/**
	 * Setter for version
	 *
	 * @param string $version 
	 * @return void
	 */
	public function setVersion( $version) {
		$this->version = $version;
	}
	
	/**
	 * Getter for labels
	 * 
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_L10nserver_Domain_Model_Label> 
	 */
	public function getLabels() {
        return $this->labels;
	}
	
	/**
	 * Setter for labels
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_L10nserver_Domain_Model_Label> $labels 
	 * @return void
	 */
	public function setLabels(Tx_Extbase_Persistence_ObjectStorage $labels) {
		$this->labels = $labels;
	}
	
	// TODO: ADD the "add"-method for the "ManyToMany" Relation as well
	/**
	 * Add a Label
	 *
	 * @param Tx_L10nserver_Domain_Model_Label The Label to add
	 * @return void
	 */
	public function addLabel(Tx_L10nserver_Domain_Model_Label $label) {
		$this->labels->attach($label);
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

    public function __toString() {
        return $this->name;
    }
}
