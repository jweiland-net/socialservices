<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/socialservices.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Socialservices\Tests\Unit\Domain\Model;

use JWeiland\Socialservices\Domain\Model\District;
use JWeiland\Socialservices\Domain\Model\Helpdesk;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Extbase\Domain\Model\Category;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case.
 */
class HelpdeskTest extends UnitTestCase
{
    protected Helpdesk $subject;

    public function setUp(): void
    {
        $this->subject = new Helpdesk();
    }

    public function tearDown(): void
    {
        unset($this->subject);
    }

    #[Test]
    public function getTitleInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTitle(),
        );
    }

    #[Test]
    public function setTitleSetsTitle(): void
    {
        $this->subject->setTitle('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getTitle(),
        );
    }

    #[Test]
    public function getStreetInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getStreet(),
        );
    }

    #[Test]
    public function setStreetSetsStreet(): void
    {
        $this->subject->setStreet('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getStreet(),
        );
    }

    #[Test]
    public function getHouseNumberInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getHouseNumber(),
        );
    }

    #[Test]
    public function setHouseNumberSetsHouseNumber(): void
    {
        $this->subject->setHouseNumber('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getHouseNumber(),
        );
    }

    #[Test]
    public function getZipInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getZip(),
        );
    }

    #[Test]
    public function setZipSetsZip(): void
    {
        $this->subject->setZip('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getZip(),
        );
    }

    #[Test]
    public function getCityInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getCity(),
        );
    }

    #[Test]
    public function setCitySetsCity(): void
    {
        $this->subject->setCity('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getCity(),
        );
    }

    #[Test]
    public function getTelephoneInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTelephone(),
        );
    }

    #[Test]
    public function setTelephoneSetsTelephone(): void
    {
        $this->subject->setTelephone('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getTelephone(),
        );
    }

    #[Test]
    public function getFaxInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getFax(),
        );
    }

    #[Test]
    public function setFaxSetsFax(): void
    {
        $this->subject->setFax('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getFax(),
        );
    }

    #[Test]
    public function getContactPersonInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getContactPerson(),
        );
    }

    #[Test]
    public function setContactPersonSetsContactPerson(): void
    {
        $this->subject->setContactPerson('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getContactPerson(),
        );
    }

    #[Test]
    public function getContactTimesInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getContactTimes(),
        );
    }

    #[Test]
    public function setContactTimesSetsContactTimes(): void
    {
        $this->subject->setContactTimes('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getContactTimes(),
        );
    }

    #[Test]
    public function getEmailInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getEmail(),
        );
    }

    #[Test]
    public function setEmailSetsEmail(): void
    {
        $this->subject->setEmail('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getEmail(),
        );
    }

    #[Test]
    public function getWebsiteInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getWebsite(),
        );
    }

    #[Test]
    public function setWebsiteSetsWebsite(): void
    {
        $this->subject->setWebsite('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getWebsite(),
        );
    }

    #[Test]
    public function getBarrierFreeInitiallyReturnsFalse(): void
    {
        self::assertFalse(
            $this->subject->getBarrierFree(),
        );
    }

    #[Test]
    public function setBarrierFreeSetsBarrierFree(): void
    {
        $this->subject->setBarrierFree(true);
        self::assertTrue(
            $this->subject->getBarrierFree(),
        );
    }

    #[Test]
    public function getDescriptionInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getDescription(),
        );
    }

    #[Test]
    public function setDescriptionSetsDescription(): void
    {
        $this->subject->setDescription('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getDescription(),
        );
    }

    #[Test]
    public function getTxMaps2UidInitiallyReturnsZero(): void
    {
        self::assertSame(
            0,
            $this->subject->getTxMaps2Uid(),
        );
    }

    #[Test]
    public function setTxMaps2UidSetsTxMaps2Uid(): void
    {
        $this->subject->setTxMaps2Uid(123456);

        self::assertSame(
            123456,
            $this->subject->getTxMaps2Uid(),
        );
    }

    #[Test]
    public function setDistrictSetsDistrict(): void
    {
        $instance = new District();
        $this->subject->setDistrict($instance);

        self::assertSame(
            $instance,
            $this->subject->getDistrict(),
        );
    }

    #[Test]
    public function getFacebookInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getFacebook(),
        );
    }

    #[Test]
    public function setFacebookSetsFacebook(): void
    {
        $this->subject->setFacebook('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getFacebook(),
        );
    }

    #[Test]
    public function getTwitterInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTwitter(),
        );
    }

    #[Test]
    public function setTwitterSetsTwitter(): void
    {
        $this->subject->setTwitter('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getTwitter(),
        );
    }

    #[Test]
    public function getInstagramInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getInstagram(),
        );
    }

    #[Test]
    public function setInstagramSetsInstagram(): void
    {
        $this->subject->setInstagram('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getInstagram(),
        );
    }

    #[Test]
    public function getTagsInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTags(),
        );
    }

    #[Test]
    public function setTagsSetsTags(): void
    {
        $this->subject->setTags('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getTags(),
        );
    }

    #[Test]
    public function getCategoriesInitiallyReturnsObjectStorage(): void
    {
        self::assertEquals(
            new ObjectStorage(),
            $this->subject->getCategories(),
        );
    }

    #[Test]
    public function setCategoriesSetsCategories(): void
    {
        $object = new Category();
        $objectStorage = new ObjectStorage();
        $objectStorage->attach($object);
        $this->subject->setCategories($objectStorage);

        self::assertSame(
            $objectStorage,
            $this->subject->getCategories(),
        );
    }

    #[Test]
    public function addCategoryAddsOneCategory(): void
    {
        $objectStorage = new ObjectStorage();
        $this->subject->setCategories($objectStorage);

        $object = new Category();
        $this->subject->addCategory($object);

        $objectStorage->attach($object);

        self::assertSame(
            $objectStorage,
            $this->subject->getCategories(),
        );
    }

    #[Test]
    public function removeCategoryRemovesOneCategory(): void
    {
        $object = new Category();
        $objectStorage = new ObjectStorage();
        $objectStorage->attach($object);
        $this->subject->setCategories($objectStorage);

        $this->subject->removeCategory($object);
        $objectStorage->detach($object);

        self::assertSame(
            $objectStorage,
            $this->subject->getCategories(),
        );
    }
}
