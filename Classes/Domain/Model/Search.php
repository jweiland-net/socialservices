<?php
declare(strict_types=1);
namespace JWeiland\Socialservices\Domain\Model;

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

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Class Search
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
     * Returns the letter
     *
     * @return string $letter
     */
    public function getLetter(): string
    {
        return $this->letter;
    }

    /**
     * Sets the letter
     *
     * @param string $letter
     *
     * @return void
     */
    public function setLetter(string $letter)
    {
        $this->letter = (string)$letter;
    }

    /**
     * Returns the searchWord
     *
     * @return string $searchWord
     */
    public function getSearchWord(): string
    {
        return $this->searchWord;
    }

    /**
     * Sets the searchWord
     *
     * @param string $searchWord
     *
     * @return void
     */
    public function setSearchWord(string $searchWord)
    {
        $this->searchWord = (string)$searchWord;
    }

    /**
     * Returns the category
     *
     * @return int $category
     */
    public function getCategory(): int
    {
        return $this->category;
    }

    /**
     * Sets the category
     *
     * @param int $category
     *
     * @return void
     */
    public function setCategory(int $category)
    {
        $this->category = $category;
    }

    /**
     * Returns the subCategory
     *
     * @return int $subCategory
     */
    public function getSubCategory(): int
    {
        return $this->subCategory;
    }

    /**
     * Sets the subCategory
     *
     * @param int $subCategory
     *
     * @return void
     */
    public function setSubCategory(int $subCategory)
    {
        $this->subCategory = $subCategory;
    }

    /**
     * Returns the orderBy
     *
     * @return string $orderBy
     */
    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    /**
     * Sets the orderBy
     *
     * @param string $orderBy
     *
     * @return void
     */
    public function setOrderBy(string $orderBy)
    {
        $this->orderBy = $orderBy;
    }

    /**
     * Returns the direction
     *
     * @return string $direction
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * Sets the direction
     *
     * @param string $direction
     *
     * @return void
     */
    public function setDirection(string $direction)
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
    public function getDirections()
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
