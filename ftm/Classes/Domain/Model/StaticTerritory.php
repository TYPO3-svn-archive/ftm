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
 * StaticTerritory
 *
 * @package ftm
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class StaticTerritory extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
    
	/**
	 * @var string
	 */
	protected $name = '';

	/**
	 * @var integer ISO nr territory code
	 */
	protected $isoCode = 0;

	/**
	 * @var integer
	 */
	protected $parentTerritoryCode = 0;

	/**
	 * @param integer $parentTerritoryCode
	 */
	public function setParentTerritoryCode($parentTerritoryCode) {
		$this->parentTerritoryCode = $parentTerritoryCode;
	}

	/**
	 * @return integer
	 */
	public function getParentTerritoryCode() {
		return $this->parentTerritoryCode;
	}

	/**
	 * @param integer $isoCode
	 */
	public function setIsoCode($isoCode) {
		$this->isoCode = $isoCode;
	}

	/**
	 * @return integer
	 */
	public function getIsoCode() {
		return $this->isoCode;
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
}
?>