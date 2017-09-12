<?php
namespace JWeiland\Socialservices\Domain\Repository;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Stefan Frömken <sfroemken@jweiland.net>, jweiland.net
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
use TYPO3\CMS\Backend\Utility\BackendUtility;

/**
 * @package socialservices
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class HelpdeskRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * @var array
	 */
	protected $defaultOrderings = array(
		'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	);





	/**
	 * find all records starting with given letter
	 *
	 * @param string $letter
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByStartingLetter($letter) {
		$query = $this->createQuery();

		$constraint = array();

		if ($letter == '0-9') {
			$constraint[] = $query->like('title', '0%');
			$constraint[] = $query->like('title', '1%');
			$constraint[] = $query->like('title', '2%');
			$constraint[] = $query->like('title', '3%');
			$constraint[] = $query->like('title', '4%');
			$constraint[] = $query->like('title', '5%');
			$constraint[] = $query->like('title', '6%');
			$constraint[] = $query->like('title', '7%');
			$constraint[] = $query->like('title', '8%');
			$constraint[] = $query->like('title', '9%');
		} else {
			$constraint[] = $query->like('title', $letter . '%');
		}
		return $query->matching($query->logicalOr($constraint))->execute();
	}
	/**
	 * get an array with available starting letters
	 *
	 * @return array
	 */
	public function getStartingLetters() {
		$query = $this->createQuery();
		return $query->statement('
			SELECT UPPER(LEFT(title, 1)) as letter
			FROM tx_socialservices_domain_model_helpdesk
			WHERE 1=1' .
			BackendUtility::BEenableFields('tx_socialservices_domain_model_helpdesk')	.
			BackendUtility::deleteClause('tx_socialservices_domain_model_helpdesk')	. '
			GROUP BY letter
			ORDER by letter;
		')->execute(TRUE);
	}

	/**
	 * search records
	 *
	 * @param string $search
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function searchHelpdesks($search) {
		$query = $this->createQuery();
		return $query->matching(
			$query->logicalOr(
				$query->like('title', '%' . $search . '%'),
				$query->like('street', '%' . $search . '%'),
				$query->like('zip', '%' . $search . '%'),
				$query->like('city', '%' . $search . '%'),
				$query->like('contactPerson', '%' . $search . '%'),
				$query->like('description', '%' . $search . '%'),
				$query->like('tags', '%' . $search . '%')
			)
		)->execute();
	}

}