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
 * StaticCountryZone
 *
 * @package ftm
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class StaticCountryZone extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
    
	/**
	 * @var string
	 */
	protected $localName = '';

	/**
	 * @var string
	 */
	protected $name = '';

	/**
	 * Country zone code as string
	 * @var string ISO 3166-2 Country Zone code
	 */
	protected $isoCode = '';

	/**
	 * Country code as number (i.e. 40)
	 * @var integer ISO 3166-1 Nr Country code
	 */
	protected $countryIsoCodeNumber = 0;

	/**
	 * Country code as two digit string (i.e. AT)
	 * @var string ISO 3166-1 A2 Country code
	 */
	protected $countryIsoCodeA2 = '';

	/**
	 * Country code as three digit string (i.e. AUT)
	 * @var string ISO 3166-1 A3 Country code
	 */
	protected $countryIsoCodeA3 = '';

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns name. If empty returns the localName
	 * @return string
	 */
	public function getName() {
		if ($this->name === '') {
			return $this->getLocalName();
		}
		return $this->name;
	}

	/**
	 * @param string $countryIsoCodeA2
	 */
	public function setCountryIsoCodeA2($countryIsoCodeA2) {
		$this->countryIsoCodeA2 = $countryIsoCodeA2;
	}

	/**
	 * @return string
	 */
	public function getCountryIsoCodeA2() {
		return $this->countryIsoCodeA2;
	}

	/**
	 * @param string $countryIsoCodeA3
	 */
	public function setCountryIsoCodeA3($countryIsoCodeA3) {
		$this->countryIsoCodeA3 = $countryIsoCodeA3;
	}

	/**
	 * @return string
	 */
	public function getCountryIsoCodeA3() {
		return $this->countryIsoCodeA3;
	}

	/**
	 * @param integer $countryIsoCodeNumber
	 */
	public function setCountryIsoCodeNumber($countryIsoCodeNumber) {
		$this->countryIsoCodeNumber = $countryIsoCodeNumber;
	}

	/**
	 * @return integer
	 */
	public function getCountryIsoCodeNumber() {
		return $this->countryIsoCodeNumber;
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
}
?>