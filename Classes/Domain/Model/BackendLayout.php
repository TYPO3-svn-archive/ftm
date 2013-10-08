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
class BackendLayout extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
    
    /**
     * Sorting
     * 
     * @var integer 
     * @since 1.0.0
     */
    protected $sorting;
    
    /**
     * Title
     * 
     * @var string 
     * @since 1.0.0
     */
    protected $title;
    
    /**
     * Beschreibung
     * 
     * @var string 
     * @since 1.0.0
     */
    protected $description;
    
    /**
     * Konfiguration
     * 
     * @var string 
     * @since 1.0.0
     */
    protected $config;
    
    /**
     * Icon-Dateiname
     * 
     * @var string 
     * @since 1.0.0
     */
    protected $icon;

    /**
     * Returns the sorting
     *
     * @return integer $sorting
     * @since 1.0.0
     */
    public function getSorting() {
        return $this->sorting;
    }

    /**
     * Sets the sorting
     *
     * @param integer $sorting
     * @return void
     * @since 1.0.0
     */
    public function setSorting($sorting) {
        $this->sorting = $sorting;
    }

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
     * Returns the description
     *
     * @return string $description
     * @since 1.0.0
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     * @since 1.0.0
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Returns the config
     *
     * @return string $config
     * @since 1.0.0
     */
    public function getConfig() {
        return $this->config;
    }

    /**
     * Sets the config
     *
     * @param string $config
     * @return void
     * @since 1.0.0
     */
    public function setConfig($config) {
        $this->config = $config;
    }

    /**
     * Returns the icon
     *
     * @return string $icon
     * @since 1.0.0
     */
    public function getIcon() {
        return $this->icon;
    }

    /**
     * Sets the icon
     *
     * @param string $icon
     * @return void
     * @since 1.0.0
     */
    public function setIcon($icon) {
        $this->icon = $icon;
    }

}
?>