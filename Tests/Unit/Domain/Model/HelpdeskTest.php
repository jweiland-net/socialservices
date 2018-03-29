<?php

namespace JWeiland\Socialservices\Tests\Unit\Domain\Model;

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
use JWeiland\Socialservices\Domain\Model\Helpdesk;
use Nimut\TestingFramework\TestCase\UnitTestCase;

/**
 * Test case.
 *
 * @author Stefan Froemken <projects@jweiland.net>
 */
class HelpdeskTest extends UnitTestCase
{
    /**
     * @var \JWeiland\Socialservices\Domain\Model\Helpdesk
     */
    protected $subject;

    /**
     * set up.
     */
    public function setUp()
    {
        $this->subject = new Helpdesk();
    }

    /**
     * tear down.
     */
    public function tearDown()
    {
        unset($this->subject);
    }

    /**
     * @test
     */
    public function getTitleInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleSetsTitle() {
        $this->subject->setTitle('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleWithIntegerResultsInString() {
        $this->subject->setTitle(123);
        $this->assertSame('123', $this->subject->getTitle());
    }

    /**
     * @test
     */
    public function setTitleWithBooleanResultsInString() {
        $this->subject->setTitle(TRUE);
        $this->assertSame('1', $this->subject->getTitle());
    }

    /**
     * @test
     */
    public function getStreetInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getStreet()
        );
    }

    /**
     * @test
     */
    public function setStreetSetsStreet() {
        $this->subject->setStreet('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getStreet()
        );
    }

    /**
     * @test
     */
    public function setStreetWithIntegerResultsInString() {
        $this->subject->setStreet(123);
        $this->assertSame('123', $this->subject->getStreet());
    }

    /**
     * @test
     */
    public function setStreetWithBooleanResultsInString() {
        $this->subject->setStreet(TRUE);
        $this->assertSame('1', $this->subject->getStreet());
    }

    /**
     * @test
     */
    public function getHouseNumberInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getHouseNumber()
        );
    }

    /**
     * @test
     */
    public function setHouseNumberSetsHouseNumber() {
        $this->subject->setHouseNumber('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getHouseNumber()
        );
    }

    /**
     * @test
     */
    public function setHouseNumberWithIntegerResultsInString() {
        $this->subject->setHouseNumber(123);
        $this->assertSame('123', $this->subject->getHouseNumber());
    }

    /**
     * @test
     */
    public function setHouseNumberWithBooleanResultsInString() {
        $this->subject->setHouseNumber(TRUE);
        $this->assertSame('1', $this->subject->getHouseNumber());
    }

    /**
     * @test
     */
    public function getZipInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getZip()
        );
    }

    /**
     * @test
     */
    public function setZipSetsZip() {
        $this->subject->setZip('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getZip()
        );
    }

    /**
     * @test
     */
    public function setZipWithIntegerResultsInString() {
        $this->subject->setZip(123);
        $this->assertSame('123', $this->subject->getZip());
    }

    /**
     * @test
     */
    public function setZipWithBooleanResultsInString() {
        $this->subject->setZip(TRUE);
        $this->assertSame('1', $this->subject->getZip());
    }

    /**
     * @test
     */
    public function getCityInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getCity()
        );
    }

    /**
     * @test
     */
    public function setCitySetsCity() {
        $this->subject->setCity('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getCity()
        );
    }

    /**
     * @test
     */
    public function setCityWithIntegerResultsInString() {
        $this->subject->setCity(123);
        $this->assertSame('123', $this->subject->getCity());
    }

    /**
     * @test
     */
    public function setCityWithBooleanResultsInString() {
        $this->subject->setCity(TRUE);
        $this->assertSame('1', $this->subject->getCity());
    }

    /**
     * @test
     */
    public function getTelephoneInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getTelephone()
        );
    }

    /**
     * @test
     */
    public function setTelephoneSetsTelephone() {
        $this->subject->setTelephone('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getTelephone()
        );
    }

    /**
     * @test
     */
    public function setTelephoneWithIntegerResultsInString() {
        $this->subject->setTelephone(123);
        $this->assertSame('123', $this->subject->getTelephone());
    }

    /**
     * @test
     */
    public function setTelephoneWithBooleanResultsInString() {
        $this->subject->setTelephone(TRUE);
        $this->assertSame('1', $this->subject->getTelephone());
    }

    /**
     * @test
     */
    public function getFaxInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getFax()
        );
    }

    /**
     * @test
     */
    public function setFaxSetsFax() {
        $this->subject->setFax('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getFax()
        );
    }

    /**
     * @test
     */
    public function setFaxWithIntegerResultsInString() {
        $this->subject->setFax(123);
        $this->assertSame('123', $this->subject->getFax());
    }

    /**
     * @test
     */
    public function setFaxWithBooleanResultsInString() {
        $this->subject->setFax(TRUE);
        $this->assertSame('1', $this->subject->getFax());
    }

    /**
     * @test
     */
    public function getContactPersonInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getContactPerson()
        );
    }

    /**
     * @test
     */
    public function setContactPersonSetsContactPerson() {
        $this->subject->setContactPerson('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getContactPerson()
        );
    }

    /**
     * @test
     */
    public function setContactPersonWithIntegerResultsInString() {
        $this->subject->setContactPerson(123);
        $this->assertSame('123', $this->subject->getContactPerson());
    }

    /**
     * @test
     */
    public function setContactPersonWithBooleanResultsInString() {
        $this->subject->setContactPerson(TRUE);
        $this->assertSame('1', $this->subject->getContactPerson());
    }

    /**
     * @test
     */
    public function getContactTimesInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getContactTimes()
        );
    }

    /**
     * @test
     */
    public function setContactTimesSetsContactTimes() {
        $this->subject->setContactTimes('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getContactTimes()
        );
    }

    /**
     * @test
     */
    public function setContactTimesWithIntegerResultsInString() {
        $this->subject->setContactTimes(123);
        $this->assertSame('123', $this->subject->getContactTimes());
    }

    /**
     * @test
     */
    public function setContactTimesWithBooleanResultsInString() {
        $this->subject->setContactTimes(TRUE);
        $this->assertSame('1', $this->subject->getContactTimes());
    }

    /**
     * @test
     */
    public function getEmailInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getEmail()
        );
    }

    /**
     * @test
     */
    public function setEmailSetsEmail() {
        $this->subject->setEmail('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getEmail()
        );
    }

    /**
     * @test
     */
    public function setEmailWithIntegerResultsInString() {
        $this->subject->setEmail(123);
        $this->assertSame('123', $this->subject->getEmail());
    }

    /**
     * @test
     */
    public function setEmailWithBooleanResultsInString() {
        $this->subject->setEmail(TRUE);
        $this->assertSame('1', $this->subject->getEmail());
    }

    /**
     * @test
     */
    public function getWebsiteInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getWebsite()
        );
    }

    /**
     * @test
     */
    public function setWebsiteSetsWebsite() {
        $this->subject->setWebsite('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getWebsite()
        );
    }

    /**
     * @test
     */
    public function setWebsiteWithIntegerResultsInString() {
        $this->subject->setWebsite(123);
        $this->assertSame('123', $this->subject->getWebsite());
    }

    /**
     * @test
     */
    public function setWebsiteWithBooleanResultsInString() {
        $this->subject->setWebsite(TRUE);
        $this->assertSame('1', $this->subject->getWebsite());
    }

    /**
     * @test
     */
    public function getBarrierFreeInitiallyReturnsFalse() {
        $this->assertSame(
            FALSE,
            $this->subject->getBarrierFree()
        );
    }

    /**
     * @test
     */
    public function setBarrierFreeSetsBarrierFree() {
        $this->subject->setBarrierFree(TRUE);
        $this->assertSame(
            TRUE,
            $this->subject->getBarrierFree()
        );
    }

    /**
     * @test
     */
    public function setBarrierFreeWithStringReturnsTrue() {
        $this->subject->setBarrierFree('foo bar');
        $this->assertTrue($this->subject->getBarrierFree());
    }

    /**
     * @test
     */
    public function setBarrierFreeWithZeroReturnsFalse() {
        $this->subject->setBarrierFree(0);
        $this->assertFalse($this->subject->getBarrierFree());
    }

    /**
     * @test
     */
    public function getDescriptionInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getDescription()
        );
    }

    /**
     * @test
     */
    public function setDescriptionSetsDescription() {
        $this->subject->setDescription('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getDescription()
        );
    }

    /**
     * @test
     */
    public function setDescriptionWithIntegerResultsInString() {
        $this->subject->setDescription(123);
        $this->assertSame('123', $this->subject->getDescription());
    }

    /**
     * @test
     */
    public function setDescriptionWithBooleanResultsInString() {
        $this->subject->setDescription(TRUE);
        $this->assertSame('1', $this->subject->getDescription());
    }

    /**
     * @test
     */
    public function getTxMaps2UidInitiallyReturnsZero() {
        $this->assertSame(
            0,
            $this->subject->getTxMaps2Uid()
        );
    }

    /**
     * @test
     */
    public function setTxMaps2UidSetsTxMaps2Uid() {
        $this->subject->setTxMaps2Uid(123456);

        $this->assertSame(
            123456,
            $this->subject->getTxMaps2Uid()
        );
    }

    /**
     * @test
     */
    public function setTxMaps2UidWithStringResultsInInteger() {
        $this->subject->setTxMaps2Uid('123Test');

        $this->assertSame(
            123,
            $this->subject->getTxMaps2Uid()
        );
    }

    /**
     * @test
     */
    public function setTxMaps2UidWithBooleanResultsInInteger() {
        $this->subject->setTxMaps2Uid(TRUE);

        $this->assertSame(
            1,
            $this->subject->getTxMaps2Uid()
        );
    }

    /**
     * @test
     */
    public function getDistrictInitiallyReturnsNull() {
        $this->assertNull($this->subject->getDistrict());
    }

    /**
     * @test
     */
    public function setDistrictSetsDistrict() {
        $instance = new \JWeiland\Socialservices\Domain\Model\District();
        $this->subject->setDistrict($instance);

        $this->assertSame(
            $instance,
            $this->subject->getDistrict()
        );
    }

    /**
     * @test
     */
    public function getFacebookInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getFacebook()
        );
    }

    /**
     * @test
     */
    public function setFacebookSetsFacebook() {
        $this->subject->setFacebook('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getFacebook()
        );
    }

    /**
     * @test
     */
    public function setFacebookWithIntegerResultsInString() {
        $this->subject->setFacebook(123);
        $this->assertSame('123', $this->subject->getFacebook());
    }

    /**
     * @test
     */
    public function setFacebookWithBooleanResultsInString() {
        $this->subject->setFacebook(TRUE);
        $this->assertSame('1', $this->subject->getFacebook());
    }

    /**
     * @test
     */
    public function getTwitterInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getTwitter()
        );
    }

    /**
     * @test
     */
    public function setTwitterSetsTwitter() {
        $this->subject->setTwitter('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getTwitter()
        );
    }

    /**
     * @test
     */
    public function setTwitterWithIntegerResultsInString() {
        $this->subject->setTwitter(123);
        $this->assertSame('123', $this->subject->getTwitter());
    }

    /**
     * @test
     */
    public function setTwitterWithBooleanResultsInString() {
        $this->subject->setTwitter(TRUE);
        $this->assertSame('1', $this->subject->getTwitter());
    }

    /**
     * @test
     */
    public function getGoogleInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getGoogle()
        );
    }

    /**
     * @test
     */
    public function setGoogleSetsGoogle() {
        $this->subject->setGoogle('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getGoogle()
        );
    }

    /**
     * @test
     */
    public function setGoogleWithIntegerResultsInString() {
        $this->subject->setGoogle(123);
        $this->assertSame('123', $this->subject->getGoogle());
    }

    /**
     * @test
     */
    public function setGoogleWithBooleanResultsInString() {
        $this->subject->setGoogle(TRUE);
        $this->assertSame('1', $this->subject->getGoogle());
    }

    /**
     * @test
     */
    public function getTagsInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getTags()
        );
    }

    /**
     * @test
     */
    public function setTagsSetsTags() {
        $this->subject->setTags('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getTags()
        );
    }

    /**
     * @test
     */
    public function setTagsWithIntegerResultsInString() {
        $this->subject->setTags(123);
        $this->assertSame('123', $this->subject->getTags());
    }

    /**
     * @test
     */
    public function setTagsWithBooleanResultsInString() {
        $this->subject->setTags(TRUE);
        $this->assertSame('1', $this->subject->getTags());
    }

    /**
     * @test
     */
    public function getCategoriesInitiallyReturnsObjectStorage() {
        $this->assertEquals(
            new \TYPO3\CMS\Extbase\Persistence\ObjectStorage(),
            $this->subject->getCategories()
        );
    }

    /**
     * @test
     */
    public function setCategoriesSetsCategories() {
        $object = new \JWeiland\Maps2\Domain\Model\Category();
        $objectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorage->attach($object);
        $this->subject->setCategories($objectStorage);

        $this->assertSame(
            $objectStorage,
            $this->subject->getCategories()
        );
    }

    /**
     * @test
     */
    public function addCategoryAddsOneCategory() {
        $objectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->subject->setCategories($objectStorage);

        $object = new \JWeiland\Maps2\Domain\Model\Category();
        $this->subject->addCategory($object);

        $objectStorage->attach($object);

        $this->assertSame(
            $objectStorage,
            $this->subject->getCategories()
        );
    }

    /**
     * @test
     */
    public function removeCategoryRemovesOneCategory() {
        $object = new \JWeiland\Maps2\Domain\Model\Category();
        $objectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorage->attach($object);
        $this->subject->setCategories($objectStorage);

        $this->subject->removeCategory($object);
        $objectStorage->detach($object);

        $this->assertSame(
            $objectStorage,
            $this->subject->getCategories()
        );
    }
}
