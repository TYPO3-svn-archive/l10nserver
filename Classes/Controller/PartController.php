<?php

class Tx_L10nTranslate_Controller_PartController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_BlogExample_Domain_Model_BlogRepository
	 */
	protected $projectRepository;

	/**
	 * @var Tx_BlogExample_Domain_Model_PostRepository
	 */
	protected $partRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {
		$this->blogRepository = t3lib_div::makeInstance('Tx_L10nServer_Domain_Model_ProjectRepository');
		$this->postRepository = t3lib_div::makeInstance('Tx_L10nServer_Domain_Model_PartRepository');
	}

	/**
	 * List action for this controller. Displays latest posts
	 *
	 * @param Tx_BlogExample_Domain_Model_Blog $blog The blog to show the posts of
	 * @return string
	 */
	public function indexAction(Tx_L10nServer_Domain_Model_Project $project) {
		$this->view->assign('parts', $project->getParts());
	}
}

?>
