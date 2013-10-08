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
class Pages extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
    
    /**
     * Title
     * 
     * @var string 
     * @since 1.0.0
     */
    protected $title;
    
    /**
     * Doktype, bspw. 254 fuer einen Container
     * 
     * @var string 
     * @since 1.0.0
     */
    protected $doktype;
    
    /**
     * Module, leer oder bspw. fe_users
     * 
     * @var string 
     * @since 1.0.0
     */
    protected $module;
    
    /**
     * TS-Config
     * 
     * @var string 
     * @since 1.0.4
     */
    protected $tsConfig;

    /**
     * Returns the title
     *
     * @return string $title
     * @since 1.0.0
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     * @since 1.0.0
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Returns the doktype
     *
     * @return string $doktype
     * @since 1.0.0
     */
    public function getDoktype() {
        return $this->doktype;
    }

    /**
     * Sets the doktype
     *
     * @param string $doktype
     * @return void
     * @since 1.0.0
     */
    public function setDoktype($doktype) {
        $this->doktype = $doktype;
    }

    /**
     * Returns the module
     *
     * @return string $module
     * @since 1.0.0
     */
    public function getModule() {
        return $this->module;
    }

    /**
     * Sets the module
     *
     * @param string $module
     * @return void
     * @since 1.0.0
     */
    public function setModule($module) {
        $this->module = $module;
    }

    /**
     * Returns the tsConfig
     *
     * @return string $tsConfig
     * @since 1.0.4
     */
    public function getTsConfig() {
        return $this->tsConfig;
    }

    /**
     * Sets the tsConfig
     *
     * @param string $tsConfig
     * @return void
     * @since 1.0.4
     */
    public function setTsConfig($tsConfig) {
        $this->tsConfig = $tsConfig;
    }

}
?>