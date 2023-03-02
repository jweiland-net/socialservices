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
    protected $orderBy = 'title';

    /**
     * @var string
     */
    protected $direction = QueryInterface::ORDER_ASCENDING;

    public function getLetter(): string
    {
        return $this->letter;
    }

    public function setLetter(string $letter): void
    {
        $this->letter = $letter;
    }

    public function getSearchWord(): string
    {
        return $this->searchWord;
    }

    public function setSearchWord(string $searchWord): void
    {
        $this->searchWord = $searchWord;
    }

    public function getCategory(): int
    {
        return $this->category;
    }

    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

    public function getSubCategory(): int
    {
        return $this->subCategory;
    }

    public function setSubCategory(int $subCategory): void
    {
        $this->subCategory = $subCategory;
    }

    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    public function setOrderBy(string $orderBy): void
    {
        $this->orderBy = $orderBy;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }

    public function setDirection(string $direction): void
    {
        $this->direction = $direction;
    }

    /**
     * Helper method to fill selectbox
     * Get fieldNames to sort by
     */
    public function getFieldNames(): array
    {
        return [
            0 => [
                'key' => 'title',
                'value' => LocalizationUtility::translate('tx_socialservices_domain_model_helpdesk.title', 'socialservices'),
            ],
        ];
    }

    /**
     * Helper method to fill selectbox
     * Get order directions
     */
    public function getDirections(): array
    {
        return [
            0 => [
                'key' => QueryInterface::ORDER_ASCENDING,
                'value' => LocalizationUtility::translate('ascending', 'socialservices'),
            ],
            1 => [
                'key' => QueryInterface::ORDER_DESCENDING,
                'value' => LocalizationUtility::translate('descending', 'socialservices'),
            ],
        ];
    }
}
