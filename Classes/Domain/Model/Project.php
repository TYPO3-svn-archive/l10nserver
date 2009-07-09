<?php

class Tx_L10nServer_Domain_Model_Project extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * The blog's name
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * A short description of the blog
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * The posts contained in this blog
	 *
	 * @var array
	 */
	protected $parts = array();

	/**
	 * The number in list of projects
	 *
	 * @var int
	 */
//	protected $num = 0;

	/**
	 * Constructs this blog
	 *
	 * @return
	 */
	public function __construct() {
	}
	
	/**
	 * Sets this blog's name
	 *
	 * @param string $name The blog's name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the blog's name
	 *
	 * @return string The blog's name
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Sets the description for the blog
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

	
	public function addPart(Tx_L10nServer_Domain_Model_Part $part) {
		$this->parts[] = $part;
	}

	public function setParts($parts) {
        foreach ($parts as $part) {
            $this->addPart($part);
        }
	}

	public function getParts() {
		return $this->parts;
	}




	/**
	 * Returns this blog as a formatted string
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->name;
	}
}
?>
