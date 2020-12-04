<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/socialservices.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Socialservices\Domain\Repository;

use JWeiland\Glossary2\Service\GlossaryService;
use JWeiland\Socialservices\Domain\Model\Search;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Database\Query\Restriction\FrontendRestrictionContainer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Qom\ConstraintInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Main repository to retrieve helpdesk records
 */
class HelpdeskRepository extends Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = [
        'title' => QueryInterface::ORDER_ASCENDING
    ];

    /**
     * Find all records starting with given letter
     *
     * @param string $letter
     * @return QueryResultInterface
     */
    public function findByLetter(string $letter): QueryResultInterface
    {
        /** @var Query $query */
        $query = $this->createQuery();
        $queryBuilder = $this->getQueryBuilderForHelpdesk($query);

        if ($letter) {
            $glossaryService = GeneralUtility::makeInstance(GlossaryService::class);
            $queryBuilder
                ->where(
                    $glossaryService->getLetterConstraintForDoctrineQuery(
                        $queryBuilder,
                        'h.title',
                        $letter
                    )
                );
        }

        return $query->statement($queryBuilder)->execute();
    }

    /**
     * Search records
     *
     * @param Search $search
     * @return QueryResultInterface
     */
    public function searchHelpdesks(Search $search): QueryResultInterface
    {
        $query = $this->createQuery();
        $constraints = [];

        // if a searchWord is set, do not process other filtering methods
        if ($search->getSearchWord()) {
            $constraints[] = $this->getConstraintForSearchWord($query, $search->getSearchWord());
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
     * Get constraint to search helpdesks by searchWord
     *
     * @param QueryInterface $query
     * @param string $searchWord
     * @return ConstraintInterface
     */
    protected function getConstraintForSearchWord(QueryInterface $query, string $searchWord): ConstraintInterface
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

    protected function getQueryBuilderForHelpdesk(QueryInterface $extbaseQuery): QueryBuilder
    {
        $queryBuilder = $this->getConnectionPool()->getQueryBuilderForTable('tx_socialservices_domain_model_helpdesk');
        $queryBuilder->setRestrictions(GeneralUtility::makeInstance(FrontendRestrictionContainer::class));
        return $queryBuilder
            ->select('*')
            ->from('tx_socialservices_domain_model_helpdesk', 'h')
            ->where(
                $queryBuilder->expr()->in(
                    'h.pid',
                    $queryBuilder->createNamedParameter(
                        $extbaseQuery->getQuerySettings()->getStoragePageIds(),
                        Connection::PARAM_INT_ARRAY
                    )
                )
            )
            ->orderBy('h.title', 'ASC');
    }

    public function getQueryBuilderToFindAllEntries(): QueryBuilder
    {
        return $this->getQueryBuilderForHelpdesk($this->createQuery());
    }

    protected function getConnectionPool(): ConnectionPool
    {
        return GeneralUtility::makeInstance(ConnectionPool::class);
    }
}
