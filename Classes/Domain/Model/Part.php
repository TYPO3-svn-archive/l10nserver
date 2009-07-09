<?php

class Tx_L10nServer_Domain_Model_Part extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var int The uid of the blog the post is related to
	 */
	protected $projectUid;

	/**
	 * @var string
	 */
	protected $name = '';

	/**
	 * @var string
	 */
	protected $description = '';

	/**
	 * @var array
	 */
	protected $labels = array();

	/**
	 * Constructs this post
	 */
	public function __construct() {
	}	
	
	/**
	 * Sets the uid of the blog this post is related to
	 *
	 * @param int $blogUid The blog uid
	 * @return void
	 */
	public function setProjectUid($projectUid) {
		$this->projectUid = $projectUid;
	}

	/**
	 * Returns the uid of the blog this post is related to
	 *
	 * @return int The blog uid this post is part of
	 */
	public function getProjectUid() {
		return $this->projectUid;
	}
	
	/**
	 * Setter for title
	 *
	 * @param string $title
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

	public function setDescription($description) {
		$this->description = $description;
	}

	public function getDescription() {
		return $this->description;
	}


	/**
	 * Setter for tags
	 *
	 * @param array $tags One or more Tx_L10nServer_Domain_Model_Tag objects
	 * @return void
	 */
	public function setLabels(array $labels) {
		foreach ($labels as $label) {
			$this->addLabel($label);			
		}
	}

	/**
	 * Adds a tag to this post
	 *
	 * @param Tx_L10nServer_Domain_Model_Tag $tag
	 * @return void
	 */
	public function addLabel(Tx_L10nServer_Domain_Model_Label $label) {
		$this->labels[] = $label;
	}

	/**
	 * Getter for tags
	 *
	 * @return array holding Tx_L10nServer_Domain_Model_Tag objects
	 */
	public function getLabels() {
		return $this->labels;
	}

	/**
	 * Returns this post as a formatted string
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->title;
	}
}
?>
