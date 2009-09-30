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
 * @author Andriy Kushnarov <akushnarov@gmail.com>
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class Tx_L10nServer_Domain_Repository_SuggestionRepository extends Tx_Extbase_Persistence_Repository {
    /**
	 * Finds suggestions by current user for selected language
	 *
	 * @param int $labelId
	 * @param int $userId
	 * @param int $langId
	 * @return Tx_L10nServer_Domain_Model_Suggestion
	 */
	public function findByUserAndLang($labelId, $userId, $langId) {

		$query = $this->createQuery();
        $result = $query->matching(
                $query->logicalAnd(
                    $query->logicalAnd(
                        $query->equals('label_uid', $labelId),
                        $query->equals('user_uid', $userId)
                    ),
                    $query->equals('lang_uid', $langId)
                )
            )
			->setLimit(1)
			->execute();

        return empty($result) ? NULL : $result[0];
	}

    /**
	 * Finds suggestions by selected language
	 *
	 * @param int $labelId
	 * @param int $langId
	 * @return Tx_L10nServer_Domain_Model_Suggestion
	 */
	public function findApprovedByLang($labelId, $langId) {
		$query = $this->createQuery();
        $result = $query->matching(
                $query->logicalAnd(
                    $query->logicalAnd(
                        $query->equals('label_uid', $labelId),
                        $query->equals('approved', '1')
                    ),
                    $query->equals('lang_uid', $langId)
                )
            )
			->setLimit(1)
			->execute();

        return empty($result) ? NULL : $result[0];
	}

    /**
	 * Finds suggestions by current user for selected language
	 *
	 * @param int $langId
	 * @return array of Tx_L10nServer_Domain_Model_Suggestion
	 */
	public function findNotApproved($langId, $labelId = 0) {
        static $suggestions;
        if (empty($suggestions)) {
            $suggestions = array();
        }

        if (! $labelId) {
            $query = $this->createQuery();
            $result = $query->matching(
                    $query->logicalAnd(
                        $query->equals('lang_uid', $langId),
                        $query->logicalNot(
                            $query->equals('approved', 1) 
                        )
                    )
                )
                ->setOrderings(
                    array('label_uid' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING)
                )
                ->execute();
            
            $tmpLabelUid = 0;
            $labelIds = array();
            foreach ($result as $suggestion) {
                $labelUid = $suggestion->getLabelUid();

                if ($tmpLabelUid != $labelUid) {
                    $tmpLabelUid = $labelUid;
                    $labelIds[] = intval($labelUid);
                }

                $suggestions[$langId][$labelUid][] = $suggestion;
            }
            
            return $labelIds;
        } else {
            return $suggestions[$langId][$labelId];
        }
	}
}
