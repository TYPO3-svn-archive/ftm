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
class TemplateLessVariable extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
    
    /**
     * Sorting
     * 
     * @var integer 
     * @since 1.1.0
     */
    protected $sorting;

    /**
     * Variablen-Title/Beschreibung
     *
     * @var string
     * @since 1.0.0
     */
    protected $variableTitle;

    /**
     * Typ der Variable
     *
     * @var string
     * @validate NotEmpty
     * @since 1.0.0
     */
    protected $variableType;

    /**
     * Variablen-Name
     *
     * @var string
     * @since 1.0.0
     */
    protected $variableName;

    /**
     * Kategorie
     *
     * @var string
     * @since 1.1.0
     */
    protected $category;

    /**
     * Variablen-Wert
     *
     * @var string
     * @since 1.0.0
     */
    protected $variableValue;

    /**
     * Variablen-String
     *
     * @var string
     * @since 1.0.0
     */
    protected $variableString;

    /**
     * Variablen-Farbe
     *
     * @var string
     * @since 1.0.0
     */
    protected $variableColor;


    /**
     * Template
     * @var \CodingMs\Ftm\Domain\Model\Template
     * @since 1.1.0
     */
    protected $template;

    /**
     * Returns the sorting
     *
     * @return integer $sorting
     * @since 1.1.0
     */
    public function getSorting() {
        return $this->sorting;
    }

    /**
     * Sets the sorting
     *
     * @param integer $sorting
     * @return void
     * @since 1.1.0
     */
    public function setSorting($sorting) {
        $this->sorting = $sorting;
    }
    
    /**
     * Returns the variableTitle
     *
     * @return string $variableTitle
     * @since 1.0.0
     */
    public function getVariableTitle() {
        return $this->variableTitle;
    }

    /**
     * Sets the variableTitle
     *
     * @param string $variableTitle
     * @return void
     * @since 1.0.0
     */
    public function setVariableTitle($variableTitle) {
        $this->variableTitle = $variableTitle;
    }
    
    /**
     * Returns the variableType
     *
     * @return string $variableType
     * @since 1.0.0
     */
    public function getVariableType() {
        return $this->variableType;
    }

    /**
     * Sets the variableType
     *
     * @param string $variableType
     * @return void
     * @since 1.0.0
     */
    public function setVariableType($variableType) {
        $this->variableType = $variableType;
    }

    /**
     * Returns the variableName
     *
     * @return string $variableName
     * @since 1.0.0
     */
    public function getVariableName() {
        return $this->variableName;
    }

    /**
     * Sets the variableName
     *
     * @param string $variableName
     * @return void
     * @since 1.0.0
     */
    public function setVariableName($variableName) {
        $this->variableName = $variableName;
    }

    /**
     * Returns the category
     *
     * @return string $category
     * @since 1.1.0
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Sets the category
     *
     * @param string $category
     * @return void
     * @since 1.1.0
     */
    public function setCategory($category) {
        $this->category = $category;
    }

    /**
     * Returns the variableValue
     *
     * @return string $variableValue
     * @since 1.0.0
     */
    public function getVariableValue() {
        return $this->variableValue;
    }

    /**
     * Sets the variableValue
     *
     * @param string $variableValue
     * @return void
     * @since 1.0.0
     */
    public function setVariableValue($variableValue) {
        $this->variableValue = $variableValue;
    }

    /**
     * Returns the variableColor
     *
     * @return string $variableColor
     * @since 1.0.0
     */
    public function getVariableColor() {
        return $this->variableColor;
    }

    /**
     * Sets the variableColor
     *
     * @param string $variableColor
     * @return void
     * @since 1.0.0
     */
    public function setVariableColor($variableColor) {
        $this->variableColor = $variableColor;
    }

    /**
     * Returns the variableColor
     *
     * @return string $variableColor
     * @since 1.0.0
     */
    public function getVariableColorSquare() {
        return '<span class="ftmColorSquare" style="background-color: '.$this->variableColor.'">&nbsp;</span>';
    }
    
    /**
     * Returns the variableString
     *
     * @return string $variableString
     * @since 1.0.0
     */
    public function getVariableString() {
        return $this->variableString;
    }

    /**
     * Sets the variableString
     *
     * @param string $variableString
     * @return void
     * @since 1.0.0
     */
    public function setVariableString($variableString) {
        $this->variableString = $variableString;
    }

    /**
     * Returns the data as array
     * @return array
     * @since 1.0.0
     */
    public function toArray() {
        
        $data = array();
        $data['variableTitle']  = $this->getVariableTitle();
        $data['variableType']   = $this->getVariableType();
        $data['variableName']   = $this->getVariableName();
        $data['variableValue']  = $this->getVariableValue();
        $data['variableColor']  = $this->getVariableColor();
        $data['variableString'] = $this->getVariableString();
        
        return $data;
    }

    /**
     * Returns the template
     *
     * @return \CodingMs\Ftm\Domain\Model\Template $template
     * @since 1.1.0
     */
    public function getTemplate() {
        return $this->template;
    }

    /**
     * Sets the template
     *
     * @param \CodingMs\Ftm\Domain\Model\Template $template
     * @return void
     * @since 1.1.0
     */
    public function setTemplate($template) {
        $this->template = $template;
    }
    
}
?>