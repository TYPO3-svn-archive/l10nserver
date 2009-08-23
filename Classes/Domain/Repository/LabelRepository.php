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
 * A repository for Labels
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class Tx_L10nServer_Domain_Repository_LabelRepository extends Tx_Extbase_Persistence_Repository {
    
    /**
     * Repository for suggestions
     *
     * @var Tx_L10nServer_Domain_Repository_SuggestionRepository
     */
    protected $suggestionRepository;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        $this->suggestionRepository = t3lib_div::makeInstance('Tx_L10nServer_Domain_Repository_SuggestionRepository');
    }

    /**
	 * Get all labels with not approved suggestions 
	 *
	 * @param int $langId
	 * @return array of Tx_L10nServer_Domain_Model_Label
	 */
	public function getLabelsToApprove($langId) {
        $labels = array();

        $result = $this->suggestionRepository->findNotApproved($langId);
        foreach ($result as $key => $uid) {
            $label = $this->findByUid($uid);

            $label->setNum($key + 1);

            $label->setProjectPart();
            
            $label->setSuggestionsToApprove(
                $this->suggestionRepository->findNotApproved(
                    $langId, $uid));

            $labels[] = $label;
        }

        return $labels;
	}
}
