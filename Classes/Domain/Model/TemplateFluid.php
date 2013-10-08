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
class TemplateFluid extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * Typ des Templates: Layout, Partial, Template
     *
     * @var string
     * @validate NotEmpty
     * @since 1.0.0
     */
    protected $templateType;

    /**
     * Template-Code
     *
     * @var string
     * @since 1.0.0
     */
    protected $templateCode;

    /**
     * Template-Filename (ohne HTML-Endung)
     *
     * @var string
     * @since 1.0.0
     */
    protected $templateFile;

    /**
     * Backend-Layout
     * @var \CodingMs\Ftm\Domain\Model\BackendLayout
     * @since 1.0.0
     */
    protected $backendLayout;

    /**
     * Template-Title
     *
     * @var string
     * @since 1.0.0
     */
    protected $templateTitle;
    
    /**
     * Returns the templateType
     *
     * @return string $templateType
     * @since 1.0.0
     */
    public function getTemplateType() {
        return $this->templateType;
    }

    /**
     * Sets the templateType
     *
     * @param string $templateType
     * @return void
     * @since 1.0.0
     */
    public function setTemplateType($templateType) {
        $this->templateType = $templateType;
    }

    /**
     * Returns the templateCode
     *
     * @return string $templateCode
     * @since 1.0.0
     */
    public function getTemplateCode() {
        return $this->templateCode;
    }

    /**
     * Sets the templateCode
     *
     * @param string $templateCode
     * @return void
     * @since 1.0.0
     */
    public function setTemplateCode($templateCode) {
        $this->templateCode = $templateCode;
    }
    
    /**
     * Returns the templateFile
     *
     * @return string $templateFile
     * @since 1.0.0
     */
    public function getTemplateFile() {
        return $this->templateFile;
    }

    /**
     * Sets the templateFile
     *
     * @param string $templateFile
     * @return void
     * @since 1.0.0
     */
    public function setTemplateFile($templateFile) {
        $this->templateFile = $templateFile;
    }

    /**
     * Returns the backendLayout
     *
     * @return \CodingMs\Ftm\Domain\Model\BackendLayout $backendLayout
     * @since 1.0.0
     */
    public function getBackendLayout() {
        return $this->backendLayout;
    }

    /**
     * Sets the backendLayout
     *
     * @param \CodingMs\Ftm\Domain\Model\BackendLayout $backendLayout
     * @return void
     * @since 1.0.0
     */
    public function setBackendLayout($backendLayout) {
        $this->backendLayout = $backendLayout;
    }
    
    /**
     * Returns the templateTitle
     *
     * @return string $templateTitle
     * @since 1.0.0
     */
    public function getTemplateTitle() {
        return $this->templateTitle;
    }

    /**
     * Sets the templateTitle
     *
     * @param string $templateTitle
     * @return void
     * @since 1.0.0
     */
    public function setTemplateTitle($templateTitle) {
        $this->templateTitle = $templateTitle;
    }

    /**
     * Returns the data as array
     * @return array
     * @since 1.0.0
     */
    public function toArray() {
        
        $data = array();
        $data['templateFile']  = $this->getTemplateFile();
        $data['templateType']  = $this->getTemplateType();
        $data['templateCode']  = $this->getTemplateCode();
        
        $data['backendLayout'] = 0;
        if(($this->getBackendLayout() instanceof \CodingMs\Ftm\Domain\Model\BackendLayout)) {
            $data['backendLayout'] = $this->getBackendLayout()->getUid();
        }
        
        $data['templateTitle'] = $this->getTemplateTitle();
        
        return $data;
    }
    
}
?>