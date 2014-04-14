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
class FrontendUser extends \TYPO3\CMS\Extbase\Domain\Model\FrontendUser {

    /**
     * E-Mail/Benutzername mit dem sich der Benutzer anmeldet
     * 
     * @var string
     */
    protected $email;

    /**
     * Vorname
     *
     * @var string
     */
    protected $firstName;

    /**
     * Aktions-Hash
     *
     * @var string
     */
    protected $actionHash;
    
    /**
     * Nachname
     * 
     * @var string 
     */
    protected $lastName;
    
    /**
     * Telefonnummer
     * 
     * @var string 
     */
    protected $telephone;
    
    /**
     * Faxnummer
     * 
     * @var string 
     */
    protected $fax;
    
    /**
     * Homepage
     * 
     * @var string 
     */
    protected $www;
    
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
     * Adresse
     * 
     * @var string 
     */
    protected $address;
    
    /**
     * Profilbild
     * 
     * @var string 
     */
    protected $image;

    /**
     * Passwort mit dem sich der Benutzer anmeldet
     * 
     * @var string 
     */
    protected $password;
    
    /**
     * Paswortwiederholung bei der Registrierung
     * 
     * @var string 
     */
    protected $passwordRepeat;
    
    /**
     * Extbase Type für die Datenbank
     * 
     * @var string 
     */
    protected $txExtbaseType;

    /**
     * Gets the disable-Flag
     *
     * @return void
     */
    public function getDisable() {
        return $this->disable;
    }

    /**
     * Sets the disable-Flag
     *
     * @param int $disable
     * @return void
     */
    public function setDisable($disable) {
        $this->disable = $disable;
    }

    /**
     * Gets the Page-Id
     * 
     * @return int
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
     * Gets the Usergroup
     * 
     * @return string
     */
    public function getUsergroup() {
        return $this->usergroup;
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

    /**
     * Gets the ActionHash
     *
     * @return string
     */
    public function getActionHash() {
        return $this->actionHash;
    }

    /**
     * Sets the ActionHash
     *
     * @param string $actionHash
     * @return void
     */
    public function setActionHash($actionHash) {
        $this->actionHash = $actionHash;
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
     * Gets the Image
     * 
     * @return string
     */
    public function getImage() {
        $imageArray = explode(',', $this->image);
        return $imageArray;
    }

    /**
     * Sets the Image
     *
     * @param string $image
     * @return void
     */
    public function setImage($image) {
        $this->image = $image;
    }

    /**
     * Gets the Telephone
     * 
     * @return string
     */
    public function getTelephone() {
        return $this->telephone;
    }

    /**
     * Sets the Telephone
     *
     * @param string $telephone
     * @return void
     */
    public function setTelephone($telephone) {
        $this->telephone = $telephone;
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
     * Gets the WWW
     * 
     * @return string
     */
    public function getWww() {
        return $this->www;
    }

    /**
     * Gets the Password
     * 
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Sets the Password
     *
     * @param string $password
     * @return void
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * Gets the password repeating
     * 
     * @return string
     */
    public function getPasswordRepeat() {
        return $this->passwordRepeat;
    }

    /**
     * Sets the password repeating
     *
     * @param string $passwordRepeat
     * @return void
     */
    public function setPasswordRepeat($passwordRepeat) {
        $this->passwordRepeat = $passwordRepeat;
    }

    /**
     * Gets the extbase type
     * 
     * @return string
     */
    public function getTxExtbaseType() {
        return $this->txExtbaseType;
    }

    /**
     * Sets the extbase type
     *
     * @param string $txExtbaseType
     * @return void
     */
    public function setTxExtbaseType($txExtbaseType) {
        $this->txExtbaseType = $txExtbaseType;
    }

    /**
     * Returns TRUE if both entered passwords are equal
     *
     * @return boolean
     */
    public function passwordEqual() {
        if($this->getPassword() == $this->getPasswordRepeat()) return TRUE;
        else return FALSE;
    }
}
?>