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
 * Repository for Tx_L10nserver_Domain_Model_Label
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_L10nserver_Domain_Repository_SuggestionRepository extends Tx_Extbase_Persistence_Repository {

	/**
	 * Finds labels by the specified project
	 *
	 * @param Tx_L10nServer_Domain_Model_Project $project The project the label must refer to
	 * @return array The labels
	 */
	public function findOtherSuggestions(Tx_L10nServer_Domain_Model_Label $label) {
		$query = $this->createQuery();
        
        //  TODO: AND user_id != currentUserId AND lang_uid = currentLangId
        return $query
            ->matching($query->equals('label_uid', $label))
            ->execute();
	}
    
	/**
	 * Finds labels by the specified params
	 *
	 * @param int Label id
	 * @param int Translator id
	 * @param int Language id
	 * @return array The labels
	 */
    public function findByUserAndLang($label, $translator, $language) {
		$query = $this->createQuery();
        
        $result = $query
            ->matching(
                $query->logicalAnd(
                    $query->logicalAnd(
                        $query->equals('translator', $translator),
                        $query->equals('language', $language)
                    ),
                $query->equals('label_uid', $label)))
			->setLimit(1)
			->execute();

        return empty($result) ? NULL : $result[0];
    }
}
