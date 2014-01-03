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
class StaticCurrency extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
    
	/**
	 * @var string
	 */
	protected $name = '';

	/**
	 * Currency code as number
	 * @var integer ISO 4217 Nr Currency code
	 */
	protected $isoCodeNumber = 0;

	/**
	 * Currency code as three digit string (i.e. EUR)
	 * @var string ISO 4217 A3 Currency code
	 */
	protected $isoCodeA3 = '';

	/**
	 * @var string
	 */
	protected $symbolLeft = '';

	/**
	 * @var string
	 */
	protected $symbolRight = '';

	/**
	 * @var string
	 */
	protected $thousandsPoint = '';

	/**
	 * @var string
	 */
	protected $decimalPoint = '';

	/**
	 * @var string
	 */
	protected $subName = '';

	/**
	 * @var string
	 */
	protected $subSymbolLeft = '';

	/**
	 * @var string
	 */
	protected $subSymbolRight = '';

	/**
	 * @var integer
	 */
	protected $decimalDigits = 0;

	/**
	 * @var integer
	 */
	protected $divisor = 0;

	/**
	 * @param string $thousandsPoint
	 */
	public function setThousandsPoint($thousandsPoint) {
		$this->thousandsPoint = $thousandsPoint;
	}

	/**
	 * @return string
	 */
	public function getThousandsPoint() {
		return $this->thousandsPoint;
	}

	/**
	 * @param int $divisor
	 */
	public function setDivisor($divisor) {
		$this->divisor = $divisor;
	}

	/**
	 * @return int
	 */
	public function getDivisor() {
		return $this->divisor;
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
	 * @param string $subName
	 */
	public function setSubName($subName) {
		$this->subName = $subName;
	}

	/**
	 * @return string
	 */
	public function getSubName() {
		return $this->subName;
	}

	/**
	 * @param string $subSymbolLeft
	 */
	public function setSubSymbolLeft($subSymbolLeft) {
		$this->subSymbolLeft = $subSymbolLeft;
	}

	/**
	 * @return string
	 */
	public function getSubSymbolLeft() {
		return $this->subSymbolLeft;
	}

	/**
	 * @param string $subSymbolRight
	 */
	public function setSubSymbolRight($subSymbolRight) {
		$this->subSymbolRight = $subSymbolRight;
	}

	/**
	 * @return string
	 */
	public function getSubSymbolRight() {
		return $this->subSymbolRight;
	}

	/**
	 * @param string $symbolLeft
	 */
	public function setSymbolLeft($symbolLeft) {
		$this->symbolLeft = $symbolLeft;
	}

	/**
	 * @return string
	 */
	public function getSymbolLeft() {
		return $this->symbolLeft;
	}

	/**
	 * @param string $symbolRight
	 */
	public function setSymbolRight($symbolRight) {
		$this->symbolRight = $symbolRight;
	}

	/**
	 * @return string
	 */
	public function getSymbolRight() {
		return $this->symbolRight;
	}

	/**
	 * @param int $decimalDigits
	 */
	public function setDecimalDigits($decimalDigits) {
		$this->decimalDigits = $decimalDigits;
	}

	/**
	 * @return int
	 */
	public function getDecimalDigits() {
		return $this->decimalDigits;
	}

	/**
	 * @param string $decimalPoint
	 */
	public function setDecimalPoint($decimalPoint) {
		$this->decimalPoint = $decimalPoint;
	}

	/**
	 * @return string
	 */
	public function getDecimalPoint() {
		return $this->decimalPoint;
	}
}
?>