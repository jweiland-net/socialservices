<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/socialservices.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Socialservices\Tests\Unit\Domain\Model;

use JWeiland\Socialservices\Domain\Model\Search;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case.
 */
class SearchTest extends UnitTestCase
{
    protected Search $subject;

    public function setUp(): void
    {
        $this->subject = new Search();
    }

    public function tearDown(): void
    {
        unset($this->subject);
    }

    #[Test]
    public function getLetterInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getLetter(),
        );
    }

    #[Test]
    public function setLetterSetsLetter(): void
    {
        $this->subject->setLetter('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getLetter(),
        );
    }

    #[Test]
    public function getSearchWordInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getSearchWord(),
        );
    }

    #[Test]
    public function setSearchWordSetsSearchWord(): void
    {
        $this->subject->setSearchWord('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getSearchWord(),
        );
    }

    #[Test]
    public function getCategoryInitiallyReturnsZero(): void
    {
        self::assertSame(
            0,
            $this->subject->getCategory(),
        );
    }

    #[Test]
    public function setCategorySetsCategory(): void
    {
        $this->subject->setCategory(123456);

        self::assertSame(
            123456,
            $this->subject->getCategory(),
        );
    }

    #[Test]
    public function getSubCategoryInitiallyReturnsZero(): void
    {
        self::assertSame(
            0,
            $this->subject->getSubCategory(),
        );
    }

    #[Test]
    public function setSubCategorySetsSubCategory(): void
    {
        $this->subject->setSubCategory(123456);

        self::assertSame(
            123456,
            $this->subject->getSubCategory(),
        );
    }

    #[Test]
    public function getOrderByInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            'title',
            $this->subject->getOrderBy(),
        );
    }

    #[Test]
    public function setOrderBySetsOrderBy(): void
    {
        $this->subject->setOrderBy('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getOrderBy(),
        );
    }

    #[Test]
    public function getDirectionInitiallyReturnsAscending(): void
    {
        self::assertSame(
            QueryInterface::ORDER_ASCENDING,
            $this->subject->getDirection(),
        );
    }

    #[Test]
    public function setDirectionSetsDirection(): void
    {
        $this->subject->setDirection('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getDirection(),
        );
    }
}
