<?php
namespace JWeiland\Socialservices\Tca;

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

use JWeiland\Maps2\Domain\Model\Location;
use JWeiland\Maps2\Domain\Model\RadiusResult;
use JWeiland\Maps2\Utility\GeocodeUtility;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class CreateMap
{
    /**
     * Object Manager
     *
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * GeocodeUtility from maps2 extension
     *
     * @var GeocodeUtility
     */
    protected $geocodeUtility;

    /**
     * Current record
     *
     * @var array
     */
    protected $currentRecord = [];

    /**
     * initializes this object
     *
     * @return void
     */
    public function init()
    {
        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $this->geocodeUtility = $this->objectManager->get(GeocodeUtility::class);
    }

    /**
     * try to find a similar poiCollection. If found connect it with current record
     *
     * @param string $status "new" od something else to update the record
     * @param string $table The table name
     * @param int|string $uid The UID of the new or updated record. Can be prepended with NEW if record is new.
     * Use: $this->substNEWwithIDs to convert
     * @param array $fieldArray The fields of the current record
     * @param DataHandler $pObj
     * @return void
     */
    public function processDatamap_afterDatabaseOperations(
        string $status,
        string $table,
        $uid,
        array $fieldArray,
        DataHandler $pObj
    ) {
        // process this hook only on expected table
        if ($table !== 'tx_socialservices_domain_model_helpdesk') {
            return;
        }

        $this->init();

        if ($status === 'new') {
            $uid = current($pObj->substNEWwithIDs);
        }

        $this->currentRecord = $this->getFullRecord($table, $uid);

        if ($this->currentRecord['tx_maps2_uid']) {
            // sync categories
            $this->updateMmEntries();
        } else {
            $response = $this->geocodeUtility->findPositionByAddress($this->getAddress());
            if ($response instanceof ObjectStorage && $response->count()) {
                /** @var RadiusResult $firstResult */
                $firstResult = $response->current();
                $location = $firstResult->getGeometry()->getLocation();
                $address = $firstResult->getFormattedAddress();
                $poiUid = $this->createNewPoiCollection($location, $address);
                $this->updateCurrentRecord($poiUid);

                // sync categories
                $this->updateMmEntries();
            }
        }
    }

    /**
     * get full socialservices record
     * While updating a record only the changed fields will be in $fieldArray
     *
     * @param string $table
     * @param int $uid
     * @return array|NULL Returns the row if found, otherwise NULL
     */
    public function getFullRecord(string $table, int $uid)
    {
        return BackendUtility::getRecord($table, $uid);
    }

    /**
     * get address for google search
     *
     * @return string Prepared address for URI
     */
    public function getAddress(): string
    {
        $address = [];
        $address[] = $this->currentRecord['street'];
        $address[] = $this->currentRecord['house_number'];
        $address[] = $this->currentRecord['zip'];
        $address[] = $this->currentRecord['city'];

        return rawurlencode(implode(' ', $address));
    }

    /**
     * try to find a similar poiCollection
     *
     * @param array $location
     * @return int The UID of the PoiCollection. 0 if not found
     */
    public function findPoiByLocation(array $location): int
    {
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable(
            'tx_maps2_domain_model_poicollection'
        );
        $queryBuilder
            ->select('uid')
            ->where('latitude = ' . (float)$location['lat'])
            ->andWhere('longitude = ' . (float)$location['lng']);

        $poi = $queryBuilder->execute()->fetch();
        if ($poi) {
            return $poi['uid'];
        }
        return 0;
    }

    /**
     * update socialservices record
     *
     * @param int $poi
     * @return void
     */
    public function updateCurrentRecord(int $poi)
    {
        /** @var Connection $connection */
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable(
            'tx_socialservices_domain_model_helpdesk'
        );
        $connection->update(
            'tx_socialservices_domain_model_helpdesk',
            ['tx_maps2_uid' => $poi],
            ['uid' => (int)$this->currentRecord['uid']]
        );
        $this->currentRecord['tx_maps2_uid'] = $poi;
    }

    /**
     * Returns BackendUserAuthentication
     *
     * @return BackendUserAuthentication
     */
    protected function getBackendUserAuthentication(): BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }

    /**
     * creates a new poiCollection before updating the current socialservices record
     *
     * @param Location $location
     * @param string $address Formatted Address returned from Google
     * @return integer insert UID
     */
    public function createNewPoiCollection(Location $location, string $address): int
    {
        $tsConfig = $this->getTsConfig();
        $data['tx_maps2_domain_model_poicollection']['NEW9823be87'] = [
            'pid' => (int)$tsConfig['pid'],
            'tstamp' => time(),
            'crdate' => time(),
            'cruser_id' => $this->getBackendUserAuthentication()->user['uid'],
            'hidden' => 0,
            'deleted' => 0,
            'latitude' => $location->getLat(),
            'longitude' => $location->getLng(),
            'collection_type' => 'Point',
            'title' => $this->currentRecord['title'],
            'address' => $address
        ];
        /** @var DataHandler $dataHandler */
        $dataHandler = GeneralUtility::makeInstance(DataHandler::class);
        $dataHandler->start($data, []);
        $dataHandler->process_datamap();
        return $dataHandler->substNEWwithIDs['NEW9823be87'];
    }

    /**
     * get TSconfig
     *
     * @return array
     * @throws \Exception
     */
    public function getTsConfig(): array
    {
        $tsConfig = BackendUtility::getModTSconfig($this->currentRecord['uid'], 'ext.socialservices');
        if (is_array($tsConfig) && !empty($tsConfig['properties']['pid'])) {
            return $tsConfig['properties'];
        } else {
            throw new \Exception(
                'no PID for maps2 given. Please add this PID in extension configuration of ' .
                'socialservices or set it in page TSconfig',
                1364889195
            );
        }
    }

    /**
     * update mm table for poiCollections
     * All categories which are defined to helpdesk has also to be defined for related poiCollection
     *
     * @return void
     */
    public function updateMmEntries()
    {
        // delete all with poiCollection related categories
        /** @var Connection $connection */
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable(
            'sys_category_record_mm'
        );
        $connection->delete(
            'sys_category_record_mm',
            [
                'uid_foreign' => (int)$this->currentRecord['tx_maps2_uid'],
                'tablenames' => 'tx_maps2_domain_model_poicollection'
            ]
        );

        // get all with socialservices related categories
        $rows = $connection
            ->select(
                ['*'],
                'sys_category_record_mm',
                [
                    'uid_foreign' => $this->currentRecord['uid'],
                    'tablenames' => 'tx_socialservices_domain_model_helpdesk'
                ]
            )
            ->fetchAll();

        // we don't need to update any records as long as there are no relations with categories
        if (count($rows)) {
            // overwrite all rows as new data for poiCollection
            foreach ($rows as $key => $row) {
                $row['uid_foreign'] = (int)$this->currentRecord['tx_maps2_uid'];
                $row['tablenames'] = 'tx_maps2_domain_model_poicollection';
                $rows[$key] = $row;
            }

            // insert rows for with poiCollection related categories
            $connection->bulkInsert(
                'sys_category_record_mm',
                $rows,
                ['uid_local', 'uid_foreign', 'tablenames', 'sorting', 'sorting_foreign', 'fieldname']
            );

            // update field categories of maps2-record (amount of relations)
            $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable(
                'tx_maps2_domain_model_poicollection'
            );
            $connection->update(
                'tx_maps2_domain_model_poicollection',
                ['categories' => count($rows)],
                ['uid' => (int)$this->currentRecord['tx_maps2_uid']]
            );
        }
    }

}
