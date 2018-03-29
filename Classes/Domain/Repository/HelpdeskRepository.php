<?php
namespace JWeiland\Socialservices\Domain\Repository;

/*
 * This file is part of the socialservices project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Class HelpdeskRepository
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class HelpdeskRepository extends Repository
{
    /**
     * Default orderings
     *
     * @var array
     */
    protected $defaultOrderings = [
        'title' => QueryInterface::ORDER_ASCENDING
    ];

    /**
     * find all records starting with given letter
     *
     * @param string $letter
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByStartingLetter(string $letter)
    {
        $query = $this->createQuery();

        $constraint = [];

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
    public function getStartingLetters()
    {
        /** @var Query $query */
        $query = $this->createQuery();
        return $query->statement('
			SELECT UPPER(LEFT(title, 1)) as letter
			FROM tx_socialservices_domain_model_helpdesk
			WHERE 1=1' .
            BackendUtility::BEenableFields('tx_socialservices_domain_model_helpdesk') .
            BackendUtility::deleteClause('tx_socialservices_domain_model_helpdesk') . '
			GROUP BY letter
			ORDER by letter;
		')->execute(true);
    }

    /**
     * search records
     *
     * @param string $search
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function searchHelpdesks(string $search)
    {
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
