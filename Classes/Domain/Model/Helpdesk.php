<?php
namespace JWeiland\Socialservices\Domain\Model;

/*
 * This file is part of the TYPO3 CMS project.
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

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class Helpdesk
 *
 * @package socialservices
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Helpdesk extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Title
     *
     * @var string
     * @validate NotEmpty
     */
    protected $title = '';

    /**
     * Street
     *
     * @var string
     */
    protected $street = '';

    /**
     * House number
     *
     * @var string
     */
    protected $houseNumber = '';

    /**
     * Zip
     *
     * @var string
     */
    protected $zip = '';

    /**
     * City
     *
     * @var string
     */
    protected $city = '';

    /**
     * Telephone
     *
     * @var string
     */
    protected $telephone = '';

    /**
     * Fax
     *
     * @var string
     */
    protected $fax = '';

    /**
     * Contact person
     *
     * @var string
     */
    protected $contactPerson = '';

    /**
     * Contact times
     *
     * @var string
     */
    protected $contactTimes = '';

    /**
     * Email
     *
     * @var string
     */
    protected $email = '';

    /**
     * Website
     *
     * @var string
     */
    protected $website = '';

    /**
     * Barrier-free
     * @var bool
     */
    protected $barrierFree = false;

    /**
     * Description
     *
     * @var string
     */
    protected $description = '';

    /**
     * Maps
     *
     * @var int
     */
    protected $txMaps2Uid = 0;

    /**
     * District
     *
     * @var \JWeiland\Socialservices\Domain\Model\District
     * @lazy
     */
    protected $district;

    /**
     * Facebook
     *
     * @var string
     */
    protected $facebook = '';

    /**
     * Twitter
     *
     * @var string
     */
    protected $twitter = '';

    /**
     * Google+
     *
     * @var string
     */
    protected $google = '';

    /**
     * Tags
     *
     * @var string
     */
    protected $tags = '';

    /**
     * categories
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
     */
    protected $categories;

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Returns the street
     *
     * @return string $street
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * Sets the street
     *
     * @param string $street
     * @return void
     */
    public function setStreet(string $street)
    {
        $this->street = $street;
    }

    /**
     * Returns the house_number
     *
     * @return string $houseNumber
     */
    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    /**
     * Sets the house_number
     *
     * @param string $houseNumber
     * @return void
     */
    public function setHouseNumber(string $houseNumber)
    {
        $this->houseNumber = $houseNumber;
    }

    /**
     * Returns the zip
     *
     * @return string $zip
     */
    public function getZip(): string
    {
        return $this->zip;
    }

    /**
     * Sets the zip
     *
     * @param string $zip
     * @return void
     */
    public function setZip(string $zip)
    {
        $this->zip = $zip;
    }

    /**
     * Returns the city
     *
     * @return string $city
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * Sets the city
     *
     * @param string $city
     * @return void
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }

    /**
     * Returns the telephone
     *
     * @return string $telephone
     */
    public function getTelephone(): string
    {
        return $this->telephone;
    }

    /**
     * Sets the telephone
     *
     * @param string $telephone
     * @return void
     */
    public function setTelephone(string $telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * Returns the fax
     *
     * @return string $fax
     */
    public function getFax(): string
    {
        return $this->fax;
    }

    /**
     * Sets the fax
     *
     * @param string $fax
     * @return void
     */
    public function setFax(string $fax)
    {
        $this->fax = $fax;
    }

    /**
     * Returns the contactPerson
     *
     * @return string $contactPerson
     */
    public function getContactPerson(): string
    {
        return $this->contactPerson;
    }

    /**
     * Sets the contactPerson
     *
     * @param string $contactPerson
     * @return void
     */
    public function setContactPerson(string $contactPerson)
    {
        $this->contactPerson = $contactPerson;
    }

    /**
     * Returns the contactTimes
     *
     * @return string $contactTimes
     */
    public function getContactTimes(): string
    {
        return $this->contactTimes;
    }

    /**
     * Sets the contactTimes
     *
     * @param string $contactTimes
     * @return void
     */
    public function setContactTimes(string $contactTimes)
    {
        $this->contactTimes = $contactTimes;
    }

    /**
     * Returns the email
     *
     * @return string $email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Sets the email
     *
     * @param string $email
     * @return void
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * Returns the website
     *
     * @return string $website
     */
    public function getWebsite(): string
    {
        return $this->website;
    }

    /**
     * Sets the website
     *
     * @param string $website
     * @return void
     */
    public function setWebsite(string $website)
    {
        $this->website = $website;
    }

    /**
     * Returns the barrierFree
     *
     * @return bool $barrierFree
     */
    public function getBarrierFree(): bool
    {
        return $this->barrierFree;
    }

    /**
     * Sets the barrierFree
     *
     * @param boolean $barrierFree
     * @return void
     */
    public function setBarrierFree(bool $barrierFree)
    {
        $this->barrierFree = $barrierFree;
    }

    /**
     * Returns the boolean state of barrierFree
     *
     * @return bool
     */
    public function isBarrierFree(): bool
    {
        return $this->getBarrierFree();
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Returns the txMaps2Uid
     *
     * @return int $txMaps2Uid
     */
    public function getTxMaps2Uid(): int
    {
        return $this->txMaps2Uid;
    }

    /**
     * Sets the txMaps2Uid
     *
     * @param int $txMaps2Uid
     * @return void
     */
    public function setTxMaps2Uid(int $txMaps2Uid)
    {
        $this->txMaps2Uid = $txMaps2Uid;
    }

    /**
     * Returns the district
     *
     * @return District $district
     */
    public function getDistrict(): District
    {
        return $this->district;
    }

    /**
     * Sets the district
     *
     * @param District $district
     * @return void
     */
    public function setDistrict(District $district)
    {
        $this->district = $district;
    }

    /**
     * Returns the facebook
     *
     * @return string $facebook
     */
    public function getFacebook(): string
    {
        return $this->facebook;
    }

    /**
     * Sets the facebook
     *
     * @param string $facebook
     * @return void
     */
    public function setFacebook(string $facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * Returns the twitter
     *
     * @return string $twitter
     */
    public function getTwitter(): string
    {
        return $this->twitter;
    }

    /**
     * Sets the twitter
     *
     * @param string $twitter
     * @return void
     */
    public function setTwitter(string $twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * Returns the google
     *
     * @return string $google
     */
    public function getGoogle(): string
    {
        return $this->google;
    }

    /**
     * Sets the google
     *
     * @param string $google
     * @return void
     */
    public function setGoogle(string $google)
    {
        $this->google = $google;
    }

    /**
     * Returns the tags
     *
     * @return string $tags
     */
    public function getTags(): string
    {
        return $this->tags;
    }

    /**
     * Sets the tags
     *
     * @param string $tags
     * @return void
     */
    public function setTags(string $tags)
    {
        $this->tags = $tags;
    }

    /**
     * Returns the categories
     *
     * @return ObjectStorage $categories
     */
    public function getCategories(): ObjectStorage
    {
        return $this->categories;
    }

    /**
     * Sets the categories
     *
     * @param ObjectStorage $categories
     * @return void
     */
    public function setCategories(ObjectStorage $categories)
    {
        $this->categories = $categories;
    }

}
