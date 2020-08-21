<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/socialservices.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Socialservices\Domain\Model;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Domain model which will be used to start a search against helpdesks
 */
class Search
{
    /**
     * @var string
     */
    protected $letter = '';

    /**
     * @var string
     */
    protected $searchWord = '';

    /**
     * @var int
     */
    protected $category = 0;

    /**
     * @var int
     */
    protected $subCategory = 0;

    /**
     * @var string
     */
    protected $orderBy = '';

    /**
     * @var string
     */
    protected $direction = QueryInterface::ORDER_ASCENDING;

    /**
     * @return string
     */
    public function getLetter(): string
    {
        return $this->letter;
    }

    /**
     * @param string $letter
     */
    public function setLetter(string $letter): void
    {
        $this->letter = $letter;
    }

    /**
     * @return string
     */
    public function getSearchWord(): string
    {
        return $this->searchWord;
    }

    /**
     * @param string $searchWord
     */
    public function setSearchWord(string $searchWord): void
    {
        $this->searchWord = $searchWord;
    }

    /**
     * @return int
     */
    public function getCategory(): int
    {
        return $this->category;
    }

    /**
     * @param int $category
     */
    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

    /**
     * @return int
     */
    public function getSubCategory(): int
    {
        return $this->subCategory;
    }

    /**
     * @param int $subCategory
     */
    public function setSubCategory(int $subCategory): void
    {
        $this->subCategory = $subCategory;
    }

    /**
     * @return string
     */
    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    /**
     * @param string $orderBy
     */
    public function setOrderBy(string $orderBy): void
    {
        $this->orderBy = $orderBy;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @param string $direction
     */
    public function setDirection(string $direction): void
    {
        $this->direction = $direction;
    }

    /**
     * Helper method to fill selectbox
     * Get fieldNames to sort by
     *
     * @return array
     */
    public function getFieldNames(): array
    {
        return [
            0 => [
                'key' => 'title',
                'value' => LocalizationUtility::translate('tx_socialservices_domain_model_helpdesk.title', 'socialservices')
            ]
        ];
    }

    /**
     * Helper method to fill selectbox
     * Get order directions
     *
     * @return array
     */
    public function getDirections(): array
    {
        return [
            0 => [
                'key' => QueryInterface::ORDER_ASCENDING,
                'value' => LocalizationUtility::translate('ascending', 'socialservices')
            ],
            1 => [
                'key' => QueryInterface::ORDER_DESCENDING,
                'value' => LocalizationUtility::translate('descending', 'socialservices')
            ],
        ];
    }
}
