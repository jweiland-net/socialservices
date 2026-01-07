<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/socialservices.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Socialservices\Update;

use JWeiland\Socialservices\Helper\PathSegmentHelper;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

/**
 * Updater to fill empty slug columns of helpdesk records
 */
#[UpgradeWizard('socialservices_slugupdater')]
class Socialservices2SlugUpdater implements UpgradeWizardInterface
{
    protected string $tableName = 'tx_socialservices_domain_model_helpdesk';

    protected string $fieldName = 'path_segment';

    protected mixed $pathSegmentHelper;

    public function __construct(PathSegmentHelper $pathSegmentHelper = null)
    {
        $this->pathSegmentHelper = $pathSegmentHelper ?? GeneralUtility::makeInstance(PathSegmentHelper::class);
    }

    public function getTitle(): string
    {
        return '[socialservices] Update Slug of helpdesk records';
    }

    public function getDescription(): string
    {
        return 'Update empty slug column "path_segment" of helpdesk records with an URI compatible version of the title';
    }

    public function updateNecessary(): bool
    {
        $queryBuilder = $this->getConnectionPool()->getQueryBuilderForTable($this->tableName);
        $queryBuilder->getRestrictions()->removeAll();
        $queryBuilder->getRestrictions()->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        $amountOfRecordsWithEmptySlug = $queryBuilder
            ->count('*')
            ->from($this->tableName)->where($queryBuilder->expr()->or($queryBuilder->expr()->eq(
                $this->fieldName,
                $queryBuilder->createNamedParameter('', Connection::PARAM_STR),
            ), $queryBuilder->expr()->isNull(
                $this->fieldName,
            )))->executeQuery()
            ->fetchOne();

        return (bool)$amountOfRecordsWithEmptySlug;
    }

    /**
     * Performs the accordant updates.
     *
     * @return bool Whether everything went smoothly or not
     */
    public function executeUpdate(): bool
    {
        $queryBuilder = $this->getConnectionPool()->getQueryBuilderForTable($this->tableName);
        $queryBuilder->getRestrictions()->removeAll();
        $queryBuilder->getRestrictions()->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        $statement = $queryBuilder
            ->select('uid', 'pid', 'title')
            ->from($this->tableName)->where($queryBuilder->expr()->or($queryBuilder->expr()->eq(
                $this->fieldName,
                $queryBuilder->createNamedParameter('', Connection::PARAM_STR),
            ), $queryBuilder->expr()->isNull(
                $this->fieldName,
            )))->executeQuery();

        $connection = $this->getConnectionPool()->getConnectionForTable($this->tableName);
        while ($recordToUpdate = $statement->fetch()) {
            if ((string)$recordToUpdate['title'] !== '') {
                $connection->update(
                    $this->tableName,
                    [
                        $this->fieldName => $this->pathSegmentHelper->generatePathSegment(
                            $recordToUpdate,
                            (int)$recordToUpdate['pid'],
                        ),
                    ],
                    [
                        'uid' => (int)$recordToUpdate['uid'],
                    ],
                );
            }
        }

        return true;
    }

    /**
     * @return string[]
     */
    public function getPrerequisites(): array
    {
        return [
            DatabaseUpdatedPrerequisite::class,
        ];
    }

    protected function getConnectionPool(): ConnectionPool
    {
        return GeneralUtility::makeInstance(ConnectionPool::class);
    }
}
