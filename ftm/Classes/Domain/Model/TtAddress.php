<?php
namespace CodingMs\Ftm\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Thomas Deuling <typo3@coding.ms>, coding.ms
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
 *
 *
 * @package ftm
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class TtAddress extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
    
    /**
     * Name
     * 
     * @var string 
     */
    protected $name;
    
    /**
     * Gender
     * 
     * @var string 
     */
    protected $gender;
    
    /**
     * Vorname
     * 
     * @var string 
     */
    protected $firstName;
    
    /**
     * Middlename
     * 
     * @var string 
     */
    protected $middleName;
    
    /**
     * Nachname
     * 
     * @var string 
     */
    protected $lastName;
    
// -------------------------------------------------------------------

    /**
     * Geburtsdatum
     *
     * @var DateTime
     * @since 1.1.0
     */
    protected $birthday;
    
    /**
     * Title
     * 
     * @var string 
     */
    protected $title;

    /**
     * E-Mail
     * 
     * @var string
     * @validate Tx_Extbase_Validation_Validator_EmailAddressValidator
     */
    protected $email;
    
    /**
     * Telefonnummer
     * 
     * @var string 
     */
    protected $phone;
    
    /**
     * Mobile
     * 
     * @var string 
     */
    protected $mobile;
    
// -------------------------------------------------------------------
    
    /**
     * Homepage
     * 
     * @var string 
     */
    protected $www;
    
    /**
     * Adresse
     * 
     * @var string 
     */
    protected $address;
    
    /**
     * Building
     * 
     * @var string 
     */
    protected $building;
    
    /**
     * Room
     * 
     * @var string 
     */
    protected $room;
    
    /**
     * Company
     * 
     * @var string 
     */
    protected $company;
    
// -------------------------------------------------------------------
    
    /**
     * City
     * 
     * @var string 
     */
    protected $city;
    
    /**
     * Zip
     * 
     * @var string 
     */
    protected $zip;
    
    /**
     * Region
     * 
     * @var string 
     */
    protected $region;
    
    /**
     * Country
     * 
     * @var string 
     */
    protected $country;
    
    /**
     * Adress-Bilder
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @lazy
     */
    protected $image;
    
    /**
     * Fax
     * 
     * @var string 
     */
    protected $fax;
    
    /**
     * Description
     * 
     * @var string 
     */
    protected $description;

    /**
     * addressgroup
     *
     * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Ftm_Domain_Model_TtAddressGroup>
     */
    protected $addressgroup;
    
    /**
     * mapLatitude
     *
     * @var string
     */
    protected $mapLatitude;
    
    /**
     * mapLongitude
     *
     * @var string
     */
    protected $mapLongitude;
    
    /**
     * mapZoom
     *
     * @var integer
     */
    protected $mapZoom;
    
    /**
     * mapTooltip
     *
     * @var string
     */
    protected $mapTooltip;
    
    /**
     * mapLink
     *
     * @var string
     */
    protected $mapLink;
    
    /**
     * directions
     *
     * @var string
     */
    protected $directions;
    

    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
     *
     * @return void
     */
    protected function initStorageObjects() {
        /**
         * Do not modify this method!
         * It will be rewritten on each save in the extension builder
         * You may modify the constructor of this class instead
         */
        $this->addressgroup = new Tx_Extbase_Persistence_ObjectStorage();
    }

    /**
     * Gets the hidden-Flag
     *
     * @return void
     */
    public function getHidden() {
        return $this->hidden;
    }

    /**
     * Sets the hidden-Flag
     *
     * @param int $hidden
     * @return void
     */
    public function setHidden($hidden) {
        $this->hidden = $hidden;
    }

    /**
     * Gets the Page-Id
     * 
     * @return void
     */
    public function getPid() {
        return $this->pid;
    }

    /**
     * Sets the Page-Id
     *
     * @param int $pid
     * @return void
     */
    public function setPid($pid) {
        $this->pid = $pid;
    }

    /**
     * Gets the Unique-Id
     * 
     * @return void
     */
    public function getUid() {
        return $this->uid;
    }

    /**
     * Sets the Unique-Id
     *
     * @param int $pid
     * @return void
     */
    public function setUid($uid) {
        $this->uid = $uid;
    }

    /**
     * Gets the full name
     * 
     * @return string
     */
    public function getFullname() {
        return $this->getName();
    }

    /**
     * Gets the Name
     * 
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Sets the Name
     *
     * @param string $name
     * @return void
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Gets the Gender
     * 
     * @return string
     */
    public function getGender() {
        return $this->gender;
    }

    /**
     * Sets the Gender
     *
     * @param string $gender
     * @return void
     */
    public function setGender($gender) {
        $this->gender = $gender;
    }

    /**
     * Gets the FirstName
     * 
     * @return string
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * Sets the FirstName
     *
     * @param string $firstName
     * @return void
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    /**
     * Gets the MiddleName
     * 
     * @return string
     */
    public function getMiddleName() {
        return $this->middleName;
    }

    /**
     * Sets the MiddleName
     *
     * @param string $middleName
     * @return void
     */
    public function setMiddleName($middleName) {
        $this->middleName = $middleName;
    }

    /**
     * Gets the LastName
     * 
     * @return string
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * Sets the LastName
     *
     * @param string $lastName
     * @return void
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

// -------------------------------------------------------------------

    /**
     * Returns the birthday
     *
     * @return DateTime $birthday
     */
    public function getBirthday() {
        return $this->birthday;
    }

    /**
     * Sets the Birthday
     *
     * @param DateTime $birthday
     * @return void
     */
    public function setBirthday($birthday) {
        $this->birthday = $birthday;
    }

    /**
     * Gets the Title
     * 
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Sets the Title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Gets the Email
     * 
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Sets the Email
     *
     * @param string $email
     * @return void
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * Gets the Phone
     * 
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Sets the Telephone
     *
     * @param string $phone
     * @return void
     */
    public function setPhone($phone) {
        $this->phone = $phone;
    }
    
    /**
     * Gets the Mobile
     * 
     * @return string
     */
    public function getMobile() {
        return $this->mobile;
    }

    /**
     * Sets the Mobile
     *
     * @param string $mobile
     * @return void
     */
    public function setMobile($mobile) {
        $this->mobile = $mobile;
    }

// -------------------------------------------------------------------
    
    /**
     * Gets the Www
     * 
     * @return string
     */
    public function getWww() {
        return $this->www;
    }

    /**
     * Sets the Www
     *
     * @param string $www
     * @return void
     */
    public function setWww($www) {
        $this->www = $www;
    }

    /**
     * Gets the Address
     * 
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Sets the Address
     *
     * @param string $address
     * @return void
     */
    public function setAddress($address) {
        $this->address = $address;
    }
    
    /**
     * Gets the Building
     * 
     * @return string
     */
    public function getBuilding() {
        return $this->building;
    }

    /**
     * Sets the Building
     *
     * @param string $building
     * @return void
     */
    public function setBuilding($building) {
        $this->building = $building;
    }
    
    /**
     * Gets the Room
     * 
     * @return string
     */
    public function getRoom() {
        return $this->room;
    }

    /**
     * Sets the Room
     *
     * @param string $room
     * @return void
     */
    public function setRoom($room) {
        $this->room = $room;
    }
    
    /**
     * Gets the Company
     * 
     * @return string
     */
    public function getCompany() {
        return $this->company;
    }

    /**
     * Sets the Company
     *
     * @param string $company
     * @return void
     */
    public function setCompany($company) {
        $this->company = $company;
    }

// -------------------------------------------------------------------
    
    /**
     * Gets the City
     * 
     * @return string
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Sets the City
     *
     * @param string $city
     * @return void
     */
    public function setCity($city) {
        $this->city = $city;
    }
    
    /**
     * Gets the Zip
     * 
     * @return string
     */
    public function getZip() {
        return $this->zip;
    }

    /**
     * Sets the Zip
     *
     * @param string $zip
     * @return void
     */
    public function setZip($zip) {
        $this->zip = $zip;
    }
    
    /**
     * Gets the Region
     * 
     * @return string
     */
    public function getRegion() {
        return $this->region;
    }

    /**
     * Sets the Region
     *
     * @param string $region
     * @return void
     */
    public function setRegion($region) {
        $this->region = $region;
    }
    
    /**
     * Gets the Country
     * 
     * @return string
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * Sets the Country
     *
     * @param string $country
     * @return void
     */
    public function setCountry($country) {
        $this->country = $country;
    }

    /**
     * Adds a image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function addImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image) {
        $this->image->attach($image);
    }

    /**
     * Removes a image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $imageToRemove The image to be removed
     * @return void
     */
    public function removeImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $imageToRemove) {
        $this->image->detach($imageToRemove);
    }

    /**
     * Returns the images as array
     *
     * @return \Array $images
    public function getImagesArray() {
        $imagesArray = array();
        $images = $this->getImages();
        if(!empty($images)) {
            foreach($images as $image) {
                if (!is_object($image)) {
                    // nichts tun
                    // return null;
                    \CodingMs\Ftm\Utility\Console::log('continue');
                    continue;
                }
                else if($image instanceof \TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy) {
                    $image->_loadRealInstance();
                }
                $imagesArray[] = $image->getOriginalResource();
            } 
        }
        return $imagesArray;
    }
     */

    /**
     * Returns the images
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $image
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Sets the images
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $image
     * @return void
     */
    public function setImage(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $image) {
        $this->image = $image;
    }
    
    /**
     * Gets the Fax
     * 
     * @return string
     */
    public function getFax() {
        return $this->fax;
    }

    /**
     * Sets the Fax
     *
     * @param string $fax
     * @return void
     */
    public function setFax($fax) {
        $this->fax = $fax;
    }
    
    /**
     * Gets the Description
     * 
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Sets the Description
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Adds a Addressgroup
     *
     * @param \CodingMs\Ftm\Domain\Model\TtAddressGroup $addressgroup
     * @return void
     */
    public function addAddressgroup(\CodingMs\Ftm\Domain\Model\TtAddressGroup $addressgroup) {
        $this->addressgroup->attach($addressgroup);
    }

    /**
     * Removes a Addressgroup
     *
     * @param \CodingMs\Ftm\Domain\Model\TtAddressGroup $addressgroupToRemove The Addressgroup to be removed
     * @return void
     */
    public function removeAddressgroup(\CodingMs\Ftm\Domain\Model\TtAddressGroup $addressgroupToRemove) {
        $this->addressgroup->detach($addressgroupToRemove);
    }

    /**
     * Returns the addressgroup
     *
     * @return Tx_Extbase_Persistence_ObjectStorage<\CodingMs\Ftm\Domain\Model\TtAddressGroup> $addressgroup
     */
    public function getAddressgroup() {
        return $this->addressgroup;
    }

    /**
     * Sets the addressgroup
     *
     * @param Tx_Extbase_Persistence_ObjectStorage<\CodingMs\Ftm\Domain\Model\TtAddressGroup> $addressgroup
     * @return void
     */
    public function setAddressgroup(Tx_Extbase_Persistence_ObjectStorage $addressgroup) {
        $this->addressgroup = $addressgroup;
    }
    
    /**
     * Returns the mapLatitude
     *
     * @return string $mapLatitude
     */
    public function getMapLatitude() {
        return $this->mapLatitude;
    }
    
    /**
     * Sets the mapLatitude
     *
     * @param string $mapLatitude
     * @return void
     */
    public function setMapLatitude($mapLatitude) {
        $this->mapLatitude = $mapLatitude;
    }
    
    /**
     * Returns the mapLongitude
     *
     * @return string $mapLongitude
     */
    public function getMapLongitude() {
        return $this->mapLongitude;
    }
    
    /**
     * Sets the mapLongitude
     *
     * @param string $mapLongitude
     * @return void
     */
    public function setMapLongitude($mapLongitude) {
        $this->mapLongitude = $mapLongitude;
    }
    
    /**
     * Returns the mapZoom
     *
     * @return integer $mapZoom
     */
    public function getMapZoom() {
        return $this->mapZoom;
    }
    
    /**
     * Sets the mapZoom
     *
     * @param integer $mapZoom
     * @return void
     */
    public function setMapZoom($mapZoom) {
        $this->mapZoom = $mapZoom;
    }
    
    /**
     * Returns the mapTooltip
     *
     * @return string $mapTooltip
     */
    public function getMapTooltip() {
        return $this->mapTooltip;
    }
    
    /**
     * Sets the mapTooltip
     *
     * @param string $mapTooltip
     * @return void
     */
    public function setMapTooltip($mapTooltip) {
        $this->mapTooltip = $mapTooltip;
    }
    
    /**
     * Returns the mapLink
     *
     * @return string $mapLink
     */
    public function getMapLink() {
        return $this->mapLink;
    }
    
    /**
     * Sets the mapLink
     *
     * @param string $mapLink
     * @return void
     */
    public function setMapLink($mapLink) {
        $this->mapLink = $mapLink;
    }
    
    /**
     * Returns the directions
     *
     * @return string $directions
     */
    public function getDirections() {
        return $this->directions;
    }
    
    /**
     * Sets the directions
     *
     * @param string $directions
     * @return void
     */
    public function setDirections($directions) {
        $this->directions = $directions;
    }

}
?>