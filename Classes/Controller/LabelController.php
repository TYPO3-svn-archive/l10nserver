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
 * The Label controller for the 'l10n server' package
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class Tx_L10nServer_Controller_LabelController extends Tx_Extbase_MVC_Controller_ActionController {

    /**
	 * Constructor. Initializes repositories.
	 *
	 * @return void
	 */
	public function initializeAction() {		
        $this->labelRepository = 
            t3lib_div::makeInstance('Tx_L10nServer_Domain_Repository_LabelRepository');
	}

	/**
	 * List action for this controller. Displays labels posts
	 *
	 * @param Tx_L10nServer_Domain_Model_Project $project The project
	 * @param Tx_L10nServer_Domain_Model_Part $part The project part to show the labels of
	 * @return string
	 */
	public function indexAction(Tx_L10nServer_Domain_Model_Project $project) {
        // TODO: FlashMessage

        $this->view->assign('project', $project);
        $this->view->assign('labels', 
            $this->labelRepository->findByProject($project));
	}
}
