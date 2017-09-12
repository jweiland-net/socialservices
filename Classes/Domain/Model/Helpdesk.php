<?php
namespace JWeiland\Socialservices\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Stefan Frömken <sfroemken@jweiland.net>, jweiland.net
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * @package socialservices
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Helpdesk extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * Street
	 *
	 * @var string
	 */
	protected $street;

	/**
	 * House number
	 *
	 * @var string
	 */
	protected $houseNumber;

	/**
	 * Zip
	 *
	 * @var string
	 */
	protected $zip;

	/**
	 * City
	 *
	 * @var string
	 */
	protected $city;

	/**
	 * Telephone
	 *
	 * @var string
	 */
	protected $telephone;

	/**
	 * Fax
	 *
	 * @var string
	 */
	protected $fax;

	/**
	 * Contact person
	 *
	 * @var string
	 */
	protected $contactPerson;

	/**
	 * Contact times
	 *
	 * @var string
	 */
	protected $contactTimes;

	/**
	 * Email
	 *
	 * @var string
	 */
	protected $email;

	/**
	 * Website
	 *
	 * @var string
	 */
	protected $website;

	/**
	 * Barrier-free
	 *
	 * @var boolean
	 */
	protected $barrierFree = FALSE;

	/**
	 * Description
	 *
	 * @var string
	 */
	protected $description;

	/**
	 * Maps
	 *
	 * @var string
	 */
	protected $txMaps2Uid;

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
	protected $facebook;

	/**
	 * Twitter
	 *
	 * @var string
	 */
	protected $twitter;

	/**
	 * Google+
	 *
	 * @var string
	 */
	protected $google;

	/**
	 * Tags
	 *
	 * @var string
	 */
	protected $tags;

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
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the street
	 *
	 * @return string $street
	 */
	public function getStreet() {
		return $this->street;
	}

	/**
	 * Sets the street
	 *
	 * @param string $street
	 * @return void
	 */
	public function setStreet($street) {
		$this->street = $street;
	}

	/**
	 * Returns the house_number
	 *
	 * @return string $houseNumber
	 */
	public function getHouseNumber() {
		return $this->houseNumber;
	}

	/**
	 * Sets the house_number
	 *
	 * @param string $houseNumber
	 * @return void
	 */
	public function setHouseNumber($houseNumber) {
		$this->houseNumber = $houseNumber;
	}

	/**
	 * Returns the zip
	 *
	 * @return string $zip
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * Sets the zip
	 *
	 * @param string $zip
	 * @return void
	 */
	public function setZip($zip) {
		$this->zip = $zip;
	}

	/**
	 * Returns the city
	 *
	 * @return string $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param string $city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * Returns the telephone
	 *
	 * @return string $telephone
	 */
	public function getTelephone() {
		return $this->telephone;
	}

	/**
	 * Sets the telephone
	 *
	 * @param string $telephone
	 * @return void
	 */
	public function setTelephone($telephone) {
		$this->telephone = $telephone;
	}

	/**
	 * Returns the fax
	 *
	 * @return string $fax
	 */
	public function getFax() {
		return $this->fax;
	}

	/**
	 * Sets the fax
	 *
	 * @param string $fax
	 * @return void
	 */
	public function setFax($fax) {
		$this->fax = $fax;
	}

	/**
	 * Returns the contactPerson
	 *
	 * @return string $contactPerson
	 */
	public function getContactPerson() {
		return $this->contactPerson;
	}

	/**
	 * Sets the contactPerson
	 *
	 * @param string $contactPerson
	 * @return void
	 */
	public function setContactPerson($contactPerson) {
		$this->contactPerson = $contactPerson;
	}

	/**
	 * Returns the contactTimes
	 *
	 * @return string $contactTimes
	 */
	public function getContactTimes() {
		return $this->contactTimes;
	}

	/**
	 * Sets the contactTimes
	 *
	 * @param string $contactTimes
	 * @return void
	 */
	public function setContactTimes($contactTimes) {
		$this->contactTimes = $contactTimes;
	}

	/**
	 * Returns the email
	 *
	 * @return string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Returns the website
	 *
	 * @return string $website
	 */
	public function getWebsite() {
		return $this->website;
	}

	/**
	 * Sets the website
	 *
	 * @param string $website
	 * @return void
	 */
	public function setWebsite($website) {
		$this->website = $website;
	}

	/**
	 * Returns the barrierFree
	 *
	 * @return boolean $barrierFree
	 */
	public function getBarrierFree() {
		return $this->barrierFree;
	}

	/**
	 * Sets the barrierFree
	 *
	 * @param boolean $barrierFree
	 * @return void
	 */
	public function setBarrierFree($barrierFree) {
		$this->barrierFree = $barrierFree;
	}

	/**
	 * Returns the boolean state of barrierFree
	 *
	 * @return boolean
	 */
	public function isBarrierFree() {
		return $this->getBarrierFree();
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the txMaps2Uid
	 *
	 * @return string $txMaps2Uid
	 */
	public function getTxMaps2Uid() {
		return $this->txMaps2Uid;
	}

	/**
	 * Sets the txMaps2Uid
	 *
	 * @param string $txMaps2Uid
	 * @return void
	 */
	public function setTxMaps2Uid($txMaps2Uid) {
		$this->txMaps2Uid = $txMaps2Uid;
	}

	/**
	 * Returns the district
	 *
	 * @return \JWeiland\Socialservices\Domain\Model\District $district
	 */
	public function getDistrict() {
		return $this->district;
	}

	/**
	 * Sets the district
	 *
	 * @param \JWeiland\Socialservices\Domain\Model\District $district
	 * @return void
	 */
	public function setDistrict(\JWeiland\Socialservices\Domain\Model\District $district) {
		$this->district = $district;
	}

	/**
	 * Returns the facebook
	 *
	 * @return string $facebook
	 */
	public function getFacebook() {
		return $this->facebook;
	}

	/**
	 * Sets the facebook
	 *
	 * @param string $facebook
	 * @return void
	 */
	public function setFacebook($facebook) {
		$this->facebook = $facebook;
	}

	/**
	 * Returns the twitter
	 *
	 * @return string $twitter
	 */
	public function getTwitter() {
		return $this->twitter;
	}

	/**
	 * Sets the twitter
	 *
	 * @param string $twitter
	 * @return void
	 */
	public function setTwitter($twitter) {
		$this->twitter = $twitter;
	}

	/**
	 * Returns the google
	 *
	 * @return string $google
	 */
	public function getGoogle() {
		return $this->google;
	}

	/**
	 * Sets the google
	 *
	 * @param string $google
	 * @return void
	 */
	public function setGoogle($google) {
		$this->google = $google;
	}

	/**
	 * Returns the tags
	 *
	 * @return string $tags
	 */
	public function getTags() {
		return $this->tags;
	}

	/**
	 * Sets the tags
	 *
	 * @param string $tags
	 * @return void
	 */
	public function setTags($tags) {
		$this->tags = $tags;
	}

	/**
	 * Returns the categories
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories
	 */
	public function getCategories() {
		return $this->categories;
	}

	/**
	 * Sets the categories
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories
	 * @return void
	 */
	public function setCategories($categories) {
		$this->categories = $categories;
	}

}