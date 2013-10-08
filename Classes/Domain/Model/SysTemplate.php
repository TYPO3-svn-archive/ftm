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
class SysTemplate extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
    
    /**
     * Title
     * 
     * @var string 
     * @since 1.0.0
     */
    protected $title;
    
    /**
     * SeitenTitle
     * 
     * @var string 
     * @since 1.0.0
     */
    protected $sitetitle;
    
    /**
     * Root-Template!?
     * 
     * @var boolean 
     * @since 1.0.0
     */
    protected $root;
    
    /**
     * Clear constants and config!?
     * 
     * @var integer 
     * @since 1.0.0
     */
    protected $clear;
    
    /**
     * Include Static, durch Komma getrennt
     * 
     * @var string 
     * @since 1.0.0
     */
    protected $includeStaticFile;
    
    /**
     * Konstanten
     * 
     * @var string 
     * @since 1.0.0
     */
    protected $contants;
    
    /**
     * Setup
     * 
     * @var string 
     * @since 1.0.0
     */
    protected $config;

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
     * Returns the sitetitle
     *
     * @return string $sitetitle
     * @since 1.0.0
     */
    public function getSitetitle() {
        return $this->sitetitle;
    }

    /**
     * Sets the sitetitle
     *
     * @param string $sitetitle
     * @return void
     * @since 1.0.0
     */
    public function setSitetitle($sitetitle) {
        $this->sitetitle = $sitetitle;
    }

    /**
     * Returns the root
     *
     * @return boolean $root
     * @since 1.0.0
     */
    public function getRoot() {
        return $this->root;
    }

    /**
     * Sets the root
     *
     * @param boolean $root
     * @return void
     * @since 1.0.0
     */
    public function setRoot($root) {
        $this->root = $root;
    }

    /**
     * Returns the boolean state of root
     *
     * @return boolean
     * @since 1.0.0
     */
    public function isRoot() {
        return $this->getRoot();
    }

    /**
     * Sets the clear
     *
     * @param boolean $clear
     * @return void
     * @since 1.0.0
     */
    public function setClear($clear) {
        $this->clear = $clear;
    }

    /**
     * Returns the boolean state of clear
     *
     * @return boolean
     * @since 1.0.0
     */
    public function isClear() {
        return $this->getClear();
    }

    /**
     * Returns the includeStaticFile
     *
     * @return string $includeStaticFile
     * @since 1.0.0
     */
    public function getIncludeStaticFile() {
        return $this->includeStaticFile;
    }

    /**
     * Sets the includeStaticFile
     *
     * @param string $includeStaticFile
     * @return void
     * @since 1.0.0
     */
    public function setIncludeStaticFile($includeStaticFile) {
        $this->includeStaticFile = $includeStaticFile;
    }

    /**
     * Returns the constants
     *
     * @return string $constants
     * @since 1.0.0
     */
    public function getConstants() {
        return $this->constants;
    }

    /**
     * Sets the constants
     *
     * @param string $constants
     * @return void
     * @since 1.0.0
     */
    public function setConstants($constants) {
        $this->constants = $constants;
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

}
?>