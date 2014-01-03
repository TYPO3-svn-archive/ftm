<?php
namespace CodingMs\Ftm\Domain\Model;

/***************************************************************
*  Copyright notice
*
*  (c) 2013 Thomas Deuling <typo3@coding.ms>
*
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
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
 * StaticCountry
 *
 * @package ftm
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class StaticCountry extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
    
	/**
	 * @var string
	 */
	protected $shortName = '';

	/**
	 * @var string
	 */
	protected $shortNameLocal = '';

	/**
	 * @var string
	 */
	protected $officialName = '';

	/**
	 * @var string
	 */
	protected $officialNameLocal = '';

	/**
	 * @var string
	 */
	protected $capital = '';

	/**
	 * Country code as number (i.e. 40)
	 * @var integer ISO 3166-1 Nr Country code
	 */
	protected $isoCodeNumber = 0;

	/**
	 * Country code as two digit string (i.e. AT)
	 * @var string ISO 3166-1 A2 Country code
	 */
	protected $isoCodeA2 = '';

	/**
	 * Country code as three digit string (i.e. AUT)
	 * @var string ISO 3166-1 A3 Country code
	 */
	protected $isoCodeA3 = '';

	/**
	 * Currency code as number (i.e. 978)
	 * @var integer ISO 4217 Nr Currency code
	 */
	protected $currencyCodeNumber = 0;

	/**
	 * Currency code as three digit string (i.e. EUR)
	 * @var string ISO 4217 A3 Currency code
	 */
	protected $currencyCode = '';

	/**
	 * @var integer
	 */
	protected $parentTerritoryCode = 0;

	/**
	 * @var boolean
	 */
	protected $unMember = FALSE;

	/**
	 * @var boolean
	 */
	protected $euMember = FALSE;

	/**
	 * @var integer
	 */
	protected $phonePrefix = 0;

	/**
	 * @var string
	 */
	protected $topLevelDomain = '';

	/**
	 * @var string
	 */
	protected $addressFormat = '';

	/**
	 * @var boolean
	 */
	protected $zoneFlag = FALSE;


	/**
	 * @param string $addressFormat
	 */
	public function setAddressFormat($addressFormat) {
		$this->addressFormat = $addressFormat;
	}

	/**
	 * @return string
	 */
	public function getAddressFormat() {
		return $this->addressFormat;
	}

	/**
	 * @param string $capital
	 */
	public function setCapital($capital) {
		$this->capital = $capital;
	}

	/**
	 * @return string
	 */
	public function getCapital() {
		return $this->capital;
	}

	/**
	 * @param string $currencyCode
	 */
	public function setCurrencyCode($currencyCode) {
		$this->currencyCode = $currencyCode;
	}

	/**
	 * @return string
	 */
	public function getCurrencyCode() {
		return $this->currencyCode;
	}

	/**
	 * @param int $currencyCodeNumber
	 */
	public function setCurrencyCodeNumber($currencyCodeNumber) {
		$this->currencyCodeNumber = $currencyCodeNumber;
	}

	/**
	 * @return int
	 */
	public function getCurrencyCodeNumber() {
		return $this->currencyCodeNumber;
	}

	/**
	 * @param boolean $euMember
	 */
	public function setEuMember($euMember) {
		$this->euMember = $euMember;
	}

	/**
	 * @return boolean
	 */
	public function getEuMember() {
		return $this->euMember;
	}

	/**
	 * Synonym for getEuMember method
	 *
	 * @return boolean
	 */
	public function isEuMember() {
		return $this->getEuMember();
	}

	/**
	 * @param string $isoCodeA2
	 */
	public function setIsoCodeA2($isoCodeA2) {
		$this->isoCodeA2 = $isoCodeA2;
	}

	/**
	 * @return string
	 */
	public function getIsoCodeA2() {
		return $this->isoCodeA2;
	}

	/**
	 * @param string $isoCodeA3
	 */
	public function setIsoCodeA3($isoCodeA3) {
		$this->isoCodeA3 = $isoCodeA3;
	}

	/**
	 * @return string
	 */
	public function getIsoCodeA3() {
		return $this->isoCodeA3;
	}

	/**
	 * @param int $isoCodeNumber
	 */
	public function setIsoCodeNumber($isoCodeNumber) {
		$this->isoCodeNumber = $isoCodeNumber;
	}

	/**
	 * @return int
	 */
	public function getIsoCodeNumber() {
		return $this->isoCodeNumber;
	}

	/**
	 * @param string $officialName
	 */
	public function setOfficialName($officialName) {
		$this->officialName = $officialName;
	}

	/**
	 * @return string
	 */
	public function getOfficialName() {
		return $this->officialName;
	}

	/**
	 * @param string $officialNameLocal
	 */
	public function setOfficialNameLocal($officialNameLocal) {
		$this->officialNameLocal = $officialNameLocal;
	}

	/**
	 * @return string
	 */
	public function getOfficialNameLocal() {
		return $this->officialNameLocal;
	}

	/**
	 * @param int $parentTerritoryCode
	 */
	public function setParentTerritoryCode($parentTerritoryCode) {
		$this->parentTerritoryCode = $parentTerritoryCode;
	}

	/**
	 * @return int
	 */
	public function getParentTerritoryCode() {
		return $this->parentTerritoryCode;
	}

	/**
	 * @param int $phonePrefix
	 */
	public function setPhonePrefix($phonePrefix) {
		$this->phonePrefix = $phonePrefix;
	}

	/**
	 * @return int
	 */
	public function getPhonePrefix() {
		return $this->phonePrefix;
	}

	/**
	 * @param string $shortName
	 */
	public function setShortName($shortName) {
		$this->shortName = $shortName;
	}

	/**
	 * @return string
	 */
	public function getShortName() {
		return $this->shortName;
	}

	/**
	 * @param string $shortNameLocal
	 */
	public function setShortNameLocal($shortNameLocal) {
		$this->shortNameLocal = $shortNameLocal;
	}

	/**
	 * @return string
	 */
	public function getShortNameLocal() {
		return $this->shortNameLocal;
	}

	/**
	 * @param string $topLevelDomain
	 */
	public function setTopLevelDomain($topLevelDomain) {
		$this->topLevelDomain = $topLevelDomain;
	}

	/**
	 * @return string
	 */
	public function getTopLevelDomain() {
		return $this->topLevelDomain;
	}

	/**
	 * @param boolean $unMember
	 */
	public function setUnMember($unMember) {
		$this->unMember = $unMember;
	}

	/**
	 * @return boolean
	 */
	public function getUnMember() {
		return $this->unMember;
	}

	/**
	 * Synonym for getUnMember method
	 *
	 * @return boolean
	 */
	public function isUnMember() {
		return $this->getUnMember();
	}

	/**
	 * @param boolean $zoneFlag
	 */
	public function setZoneFlag($zoneFlag) {
		$this->zoneFlag = $zoneFlag;
	}

	/**
	 * @return boolean
	 */
	public function getZoneFlag() {
		return $this->zoneFlag;
	}
}
?>