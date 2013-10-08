<?php
namespace CodingMs\Ftm\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Thomas Deuling <typo3@coding.ms>, coding.ms
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
class TemplateExt extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * extKey
     *
     * @var string
     * @validate NotEmpty
     * @since 1.0.0
     */
    protected $extKey;

    /**
     * hidden
     *
     * @var string
     * @since 1.0.0
     */
    protected $hidden;

    /**
     * extName
     *
     * @var string
     * @since 1.0.0
     */
    protected $extName;

    /**
     * extVersion
     *
     * @var string
     * @since 1.0.0
     */
    protected $extVersion;

    /**
     * extConfT3Less
     *
     * @var \CodingMs\Ftm\Domain\Model\TemplateExtT3Less
     * @since 1.0.0
     */
    protected $extConfT3Less;

    /**
     * Returns the hidden
     *
     * @return boolean $hidden
     * @since 1.0.0
     */
    public function getHidden() {
        return $this->hidden;
    }

    /**
     * Sets the hidden
     *
     * @param boolean $hidden
     * @return void
     * @since 1.0.0
     */
    public function setHidden($hidden) {
        $this->hidden = $hidden;
    }

    /**
     * Returns the boolean state of hidden
     *
     * @return boolean
     * @since 1.0.0
     */
    public function isHidden() {
        return $this->getHidden();
    }

    /**
     * Returns the extKey
     *
     * @return string $extKey
     * @since 1.0.0
     */
    public function getExtKey() {
        return $this->extKey;
    }

    /**
     * Sets the extKey
     *
     * @param string $extKey
     * @return void
     * @since 1.0.0
     */
    public function setExtKey($extKey) {
        $this->extKey = $extKey;
    }

    /**
     * Returns the extName
     *
     * @return string $extName
     * @since 1.0.0
     */
    public function getExtName() {
        return $this->extName;
    }

    /**
     * Sets the extName
     *
     * @param string $extName
     * @return void
     * @since 1.0.0
     */
    public function setExtName($extName) {
        $this->extName = $extName;
    }

    /**
     * Returns the extVersion
     *
     * @return string $extVersion
     * @since 1.0.0
     */
    public function getExtVersion() {
        return $this->extVersion;
    }

    /**
     * Sets the extVersion
     *
     * @param string $extVersion
     * @return void
     * @since 1.0.0
     */
    public function setExtVersion($extVersion) {
        $this->extVersion = $extVersion;
    }

    /**
     * Returns the extConfT3Less
     *
     * @return \CodingMs\Ftm\Domain\Model\TemplateExtT3Less $extConfT3Less
     * @since 1.0.0
     */
    public function getExtConfT3Less() {
        return $this->extConfT3Less;
    }

    /**
     * Sets the extConfT3Less
     *
     * @param \CodingMs\Ftm\Domain\Model\TemplateExtT3Less $extConfT3Less
     * @return void
     * @since 1.0.0
     */
    public function setExtConfT3Less(\CodingMs\Ftm\Domain\Model\TemplateExtT3Less $extConfT3Less) {
        $this->extConfT3Less = $extConfT3Less;
    }

    /**
     * Returns the data as array
     * @return array
     * @since 1.0.0
     */
    public function toArray() {
        
        $data = array();
        $data['hidden']      = $this->getHidden();
        $data['extKey']      = $this->getExtKey();
        $data['extName']     = $this->getExtName();
        $data['extVersion']  = $this->getExtVersion();
        
        // Nur die Konfiguration nehmen,
        // die zur Extension gehoert
        if($data['extKey'] == "t3_less") {
            $data['extConf'] = $this->getExtConfT3Less()->toArray();
        }
        
        return $data;
    }

}
?>