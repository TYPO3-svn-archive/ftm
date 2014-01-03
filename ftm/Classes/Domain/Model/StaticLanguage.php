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
 * StaticCurrency
 *
 * @package ftm
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class StaticLanguage extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
    
	/**
	 * @var string
	 */
	protected $localName = '';

	/**
	 * @var string
	 */
	protected $name = '';

	/**
	 * @var string ISO 639-1 A2 Language code
	 */
	protected $countryIsoCode = '';

	/**
	 * @var string
	 */
	protected $typo3Code = '';

	/**
	 * @var string
	 */
	protected $isoCode = '';

	/**
	 * @var string
	 */
	protected $collatingLocale = '';

	/**
	 * @var boolean
	 */
	protected $sacredLanguage = FALSE;

	/**
	 * @var boolean
	 */
	protected $constructedLanguage = FALSE;

	/**
	 * @param string $typo3Code
	 */
	public function setTypo3Code($typo3Code) {
		$this->typo3Code = $typo3Code;
	}

	/**
	 * @return string
	 */
	public function getTypo3Code() {
		return $this->typo3Code;
	}

	/**
	 * @param string $collatingLocale
	 */
	public function setCollatingLocale($collatingLocale) {
		$this->collatingLocale = $collatingLocale;
	}

	/**
	 * @return string
	 */
	public function getCollatingLocale() {
		return $this->collatingLocale;
	}

	/**
	 * @param boolean $constructedLanguage
	 */
	public function setConstructedLanguage($constructedLanguage) {
		$this->constructedLanguage = $constructedLanguage;
	}

	/**
	 * @return boolean
	 */
	public function getConstructedLanguage() {
		return $this->constructedLanguage;
	}

	/**
	 * Synonym for getConstructedLanguage method
	 * @return boolean
	 */
	public function isConstructedLanguage() {
		return $this->getConstructedLanguage();
	}

	/**
	 * @param string $isoCode
	 */
	public function setIsoCode($isoCode) {
		$this->isoCode = $isoCode;
	}

	/**
	 * @return string
	 */
	public function getIsoCode() {
		return $this->isoCode;
	}

	/**
	 * @param string $countryIsoCode
	 */
	public function setCountryIsoCode($countryIsoCode) {
		$this->countryIsoCode = $countryIsoCode;
	}

	/**
	 * @return string
	 */
	public function getCountryIsoCode() {
		return $this->countryIsoCode;
	}

	/**
	 * @param string $localName
	 */
	public function setLocalName($localName) {
		$this->localName = $localName;
	}

	/**
	 * @return string
	 */
	public function getLocalName() {
		return $this->localName;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param boolean $sacredLanguage
	 */
	public function setSacredLanguage($sacredLanguage) {
		$this->sacredLanguage = $sacredLanguage;
	}

	/**
	 * @return boolean
	 */
	public function getSacredLanguage() {
		return $this->sacredLanguage;
	}

	/**
	 * Synonym for getSacredLanguage method
	 * @return boolean
	 */
	public function isSacredLanguage() {
		return $this->getSacredLanguage();
	}
}
?>