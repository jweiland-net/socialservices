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

use JWeiland\Socialservices\Domain\Model\Search;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Qom\OrInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
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
     * @return QueryResultInterface
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
     * @param Search $search
     * @return QueryResultInterface
     */
    public function searchHelpdesks(Search $search)
    {
        $query = $this->createQuery();
        $constraints = [];

        // if a searchWord is set, do not process other filtering methods
        if ($search->getSearchWord()) {
            $constraints[] = $this->getConstraintForSearchWord($query, $search->getSearchWord());
        } elseif ($search->getLetter()) {
            // if a letter is set, do not process other filtering methods
            $constraintOr = [];
            if ($search->getLetter() === '0-9') {
                $constraintOr[] = $query->like('sortTitle', '0%');
                $constraintOr[] = $query->like('sortTitle', '1%');
                $constraintOr[] = $query->like('sortTitle', '2%');
                $constraintOr[] = $query->like('sortTitle', '3%');
                $constraintOr[] = $query->like('sortTitle', '4%');
                $constraintOr[] = $query->like('sortTitle', '5%');
                $constraintOr[] = $query->like('sortTitle', '6%');
                $constraintOr[] = $query->like('sortTitle', '7%');
                $constraintOr[] = $query->like('sortTitle', '8%');
                $constraintOr[] = $query->like('sortTitle', '9%');
            } else {
                $constraintOr[] = $query->like('sortTitle', $search->getLetter() . '%');
            }
            $constraints[] = $query->logicalOr($constraintOr);
        } else {
            // add (Sub-)Category
            if ($search->getSubCategory()) {
                $constraints[] = $query->contains('categories', $search->getSubCategory());
            } elseif ($search->getCategory()) {
                $constraints[] = $query->contains('categories', $search->getCategory());
            }

            // set ordering
            if (in_array($search->getOrderBy(), ['title', 'sortTitle'], true)) {
                if (!in_array($search->getDirection(), [QueryInterface::ORDER_ASCENDING, QueryInterface::ORDER_DESCENDING], true)) {
                    $search->setDirection(QueryInterface::ORDER_ASCENDING);
                }
                $query->setOrderings([
                    $search->getOrderBy() => $search->getDirection()
                ]);
            }
        }

        if (!empty($constraints)) {
            return $query->matching($query->logicalAnd($constraints))->execute();
        }

        return $this->findAll();
    }

    /**
     * Get constraint to search clubs by searchWord
     *
     * @param QueryInterface $query
     * @param string $searchWord
     * @return OrInterface
     */
    protected function getConstraintForSearchWord(QueryInterface $query, string $searchWord)
    {
        // strtolower is not UTF-8 compatible
        $longStreetSearch = $searchWord;
        $smallStreetSearch = $searchWord;

        // unify street search
        if (\strtolower(mb_substr($searchWord, -6)) === 'straße') {
            $smallStreetSearch = \str_ireplace('straße', 'str', $searchWord);
        }
        if (\strtolower(mb_substr($searchWord, -4)) === 'str.') {
            $longStreetSearch = \str_ireplace('str.', 'straße', $searchWord);
            $smallStreetSearch = \str_ireplace('str.', 'str', $searchWord);
        }
        if (\strtolower(mb_substr($searchWord, -3)) === 'str') {
            $longStreetSearch = \str_ireplace('str', 'straße', $searchWord);
        }

        $logicalOrConstraints = [
            $query->like('title', '%' . $searchWord . '%'),
            $query->like('street', '%' . $longStreetSearch . '%'),
            $query->like('street', '%' . $smallStreetSearch . '%'),
            $query->like('zip', '%' . $searchWord . '%'),
            $query->like('city', '%' . $searchWord . '%'),
            $query->like('contactPerson', '%' . $searchWord . '%'),
            $query->like('description', '%' . $searchWord . '%'),
            $query->like('tags', '%' . $searchWord . '%')
        ];

        return $query->logicalOr($logicalOrConstraints);
    }
}
