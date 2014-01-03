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
class TemplateMenuState extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * hidden
     *
     * @var string
     * @since 1.0.0
     */
    protected $hidden;

    /**
     * Menu-Status
     *
     * @var string
     * @since 1.0.0
     */
    protected $menuState;

    /**
     * Basis wird kopirt von Menu-Status
     *
     * @var string
     * @since 1.0.0
     */
    protected $copyFromState;

    /**
     * Standard-Wrap für das gesamte Menue
     *
     * @var string
     * @since 1.0.0
     */
    protected $stdWrap;

    /**
     * Wenn aktiv htmlSpecialChars im stdWrap
     *
     * @var boolean
     * @since 1.0.0
     */
    protected $stdWrapHtmlSpecialChars;

    /**
     * Wrappt nur das gesamte Menue
     *
     * @var string
     * @since 1.0.0
     */
    protected $wrap;

    /**
     * Wenn aktiv htmlSpecialChars im wrap
     *
     * @var boolean
     * @since 1.0.0
     */
    protected $wrapHtmlSpecialChars;

    /**
     * Sort order
     *
     * @var integer
     * @since 1.0.0
     */
    protected $sorting;
    
    /**
     * appendBefore
     *
     * @var string
     * @since 1.1.1
     */
    protected $appendBefore;
    
    /**
     * appendAfter
     *
     * @var string
     * @since 1.1.1
     */
    protected $appendAfter;

    /**
     * Menupunkt nicht verlinken
     *
     * @var boolean
     * @since 1.1.1
     */
    protected $doNotLinkIt;
    

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
     * Returns the menuState
     *
     * @return string $menuState
     * @since 1.0.0
     */
    public function getMenuState() {
        return $this->menuState;
    }

    /**
     * Sets the menuState
     *
     * @param string $menuState
     * @return void
     * @since 1.0.0
     */
    public function setMenuState($menuState) {
        $this->menuState = $menuState;
    }

    /**
     * Returns the copyFromState
     *
     * @return string $copyFromState
     * @since 1.0.0
     */
    public function getCopyFromState() {
        return $this->copyFromState;
    }

    /**
     * Sets the copyFromState
     *
     * @param string $copyFromState
     * @return void
     * @since 1.0.0
     */
    public function setCopyFromState($copyFromState) {
        $this->copyFromState = $copyFromState;
    }

    /**
     * Returns the wrapHtmlSpecialChars
     *
     * @return boolean $wrapHtmlSpecialChars
     * @since 1.0.0
     */
    public function getWrapHtmlSpecialChars() {
        return $this->wrapHtmlSpecialChars;
    }

    /**
     * Sets the wrapHtmlSpecialChars
     *
     * @param boolean $wrapHtmlSpecialChars
     * @return void
     * @since 1.0.0
     */
    public function setWrapHtmlSpecialChars($wrapHtmlSpecialChars) {
        $this->wrapHtmlSpecialChars = $wrapHtmlSpecialChars;
    }

    /**
     * Returns the stdWrapHtmlSpecialChars
     *
     * @return boolean $stdWrapHtmlSpecialChars
     * @since 1.0.0
     */
    public function getStdWrapHtmlSpecialChars() {
        return $this->stdWrapHtmlSpecialChars;
    }

    /**
     * Sets the stdWrapHtmlSpecialChars
     *
     * @param boolean $stdWrapHtmlSpecialChars
     * @return void
     * @since 1.0.0
     */
    public function setStdWrapHtmlSpecialChars($stdWrapHtmlSpecialChars) {
        $this->stdWrapHtmlSpecialChars = $stdWrapHtmlSpecialChars;
    }

    /**
     * Returns the stdWrap
     *
     * @return string $stdWrap
     * @since 1.0.0
     */
    public function getStdWrap() {
        return $this->stdWrap;
    }

    /**
     * Sets the stdWrap
     *
     * @param string $stdWrap
     * @return void
     * @since 1.0.0
     */
    public function setStdWrap($stdWrap) {
        $this->stdWrap = $stdWrap;
    }

    /**
     * Returns the wrap
     *
     * @return string $wrap
     * @since 1.0.0
     */
    public function getWrap() {
        return $this->wrap;
    }

    /**
     * Sets the wrap
     *
     * @param string $wrap
     * @return void
     * @since 1.0.0
     */
    public function setWrap($wrap) {
        $this->wrap = $wrap;
    }

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
     * Returns the appendBefore
     *
     * @return string $appendBefore
     * @since 1.1.1
     */
    public function getAppendBefore() {
        return $this->appendBefore;
    }
    
    /**
     * Sets the appendBefore
     *
     * @param string $appendBefore
     * @return void
     * @since 1.1.1
     */
    public function setAppendBefore($appendBefore) {
        $this->appendBefore = $appendBefore;
    }
    
    /**
     * Returns the appendAfter
     *
     * @return string $appendAfter
     * @since 1.1.1
     */
    public function getAppendAfter() {
        return $this->appendAfter;
    }
    
    /**
     * Sets the appendAfter
     *
     * @param string $appendAfter
     * @return void
     * @since 1.1.1
     */
    public function setAppendAfter($appendAfter) {
        $this->appendAfter = $appendAfter;
    }
    
    /**
     * Returns the doNotLinkIt
     *
     * @return boolean $doNotLinkIt
     * @since 1.1.1
     */
    public function getDoNotLinkIt() {
        return $this->doNotLinkIt;
    }
    
    /**
     * Sets the doNotLinkIt
     *
     * @param boolean $doNotLinkIt
     * @return void
     * @since 1.1.1
     */
    public function setDoNotLinkIt($doNotLinkIt) {
        $this->doNotLinkIt = $doNotLinkIt;
    }
    
    /**
     * Returns the data as array
     * @return array
     * @since 1.0.0
     */
    public function toArray() {
        
        $data = array();
        $data['hidden']        = $this->getHidden();
        $data['sorting']       = $this->getSorting();
        $data['menuState']     = $this->getMenuState();
        $data['copyFromState'] = $this->getCopyFromState();
        $data['stdWrapHtmlSpecialChars'] = $this->getStdWrapHtmlSpecialChars();
        $data['wrapHtmlSpecialChars']    = $this->getWrapHtmlSpecialChars();
        $data['stdWrap']       = $this->getStdWrap();
        $data['wrap']          = $this->getWrap();
        $data['appendBefore']  = $this->getAppendBefore();
        $data['appendAfter']   = $this->getAppendAfter();
        $data['doNotLinkIt']   = $this->getDoNotLinkIt();
        
        return $data;
    }
    
}
?>