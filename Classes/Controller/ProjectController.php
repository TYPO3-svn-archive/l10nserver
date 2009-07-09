<?php

class Tx_L10nTranslate_Controller_ProjectController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_L10nServer_Domain_Model_ProjectRepository
	 */
	protected $projectRepository;

	/**
	 * @var Tx_L10nServer_Domain_Model_PartRepository
	 */
	protected $partRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {		
		$this->projectRepository = t3lib_div::makeInstance('Tx_L10nServer_Domain_Model_ProjectRepository');
		$this->partRepository = t3lib_div::makeInstance('Tx_L10nServer_Domain_Model_PartRepository');
	}

	/**
	 * Index action for this controller. Displays a list of projects.
	 *
	 * @return string The rendered view
	 */
	public function indexAction() {
        $projects = $this->projectRepository->findAll();

		$this->view->assign('projects', $projects);
	}

}

?>
