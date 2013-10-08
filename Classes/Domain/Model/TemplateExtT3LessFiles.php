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
class TemplateExtT3LessFiles extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * hidden
     *
     * @var string
     * @since 1.0.0
     */
    protected $hidden;

    /**
     * File name
     *
     * @var string
     * @validate NotEmpty
     * @since 1.0.0
     */
    protected $name;

    /**
     * The media attribute. Like “screen”, “print” or media queries like “only screen and (max-device-width: 480px)”
     *
     * @var string
     * @since 1.0.0
     */
    protected $media;

    /**
     * The title attribute. A title for this stylesheet like “general” or “iehacks” or something else
     *
     * @var string
     * @since 1.0.0
     */
    protected $title;

    /**
     * Options are 1 (activated) or 0 (deactivated). This setting is for usage of page.config.compressCss
     *
     * @var boolean
     * @since 1.0.0
     */
    protected $compress = FALSE;

    /**
     * Options are 1 (activated) or 0 (deactivated). With this setting you can force to include this file at the top of your html-markup
     *
     * @var boolean
     * @since 1.0.0
     */
    protected $forceOnTop = FALSE;

    /**
     * If you want to wrap the included file, please use “allWrap”. Example: <!--[if IE]> | <![endif]-->
     *
     * @var string
     * @since 1.0.0
     */
    protected $allWrap;

    /**
     * Options are 1 (activated) or 0 (deactivated). This setting is for usage of page.config.concatenateCss
     *
     * @var boolean
     * @since 1.0.0
     */
    protected $excludeFromConcatenation = FALSE;

    /**
     * With this setting you can exclude this file from pagerenderer. If activated, the file will not be included to your page.
     *
     * @var string
     * @since 1.0.0
     */
    protected $excludeFromPageRenderer;

    /**
     * Sort order
     *
     * @var integer
     * @since 1.0.0
     */
    protected $sorting;

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
     * Returns the name
     *
     * @return string $name
     * @since 1.0.0
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     * @since 1.0.0
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Returns the media
     *
     * @return string $media
     * @since 1.0.0
     */
    public function getMedia() {
        return $this->media;
    }

    /**
     * Sets the media
     *
     * @param string $media
     * @return void
     * @since 1.0.0
     */
    public function setMedia($media) {
        $this->media = $media;
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
     * Returns the compress
     *
     * @return boolean $compress
     * @since 1.0.0
     */
    public function getCompress() {               
        return $this->compress;
    }

    /**
     * Sets the compress
     *
     * @param boolean $compress
     * @return void
     * @since 1.0.0
     */
    public function setCompress($compress) {
        $this->compress = $compress;
    }

    /**
     * Returns the boolean state of compress
     *
     * @return boolean
     * @since 1.0.0
     */
    public function isCompress() {
        return $this->getCompress();
    }

    /**
     * Returns the forceOnTop
     *
     * @return boolean $forceOnTop
     * @since 1.0.0
     */
    public function getForceOnTop() {
        return $this->forceOnTop;
    }

    /**
     * Sets the forceOnTop
     *
     * @param boolean $forceOnTop
     * @return void
     * @since 1.0.0
     */
    public function setForceOnTop($forceOnTop) {
        $this->forceOnTop = $forceOnTop;
    }

    /**
     * Returns the boolean state of forceOnTop
     *
     * @return boolean
     * @since 1.0.0
     */
    public function isForceOnTop() {
        return $this->getForceOnTop();
    }

    /**
     * Returns the allWrap
     *
     * @return string $allWrap
     * @since 1.0.0
     */
    public function getAllWrap() {
        return $this->allWrap;
    }

    /**
     * Sets the allWrap
     *
     * @param string $allWrap
     * @return void
     * @since 1.0.0
     */
    public function setAllWrap($allWrap) {
        $this->allWrap = $allWrap;
    }

    /**
     * Returns the excludeFromConcatenation
     *
     * @return boolean $excludeFromConcatenation
     * @since 1.0.0
     */
    public function getExcludeFromConcatenation() {
        return $this->excludeFromConcatenation;
    }

    /**
     * Sets the excludeFromConcatenation
     *
     * @param boolean $excludeFromConcatenation
     * @return void
     * @since 1.0.0
     */
    public function setExcludeFromConcatenation($excludeFromConcatenation) {
        $this->excludeFromConcatenation = $excludeFromConcatenation;
    }

    /**
     * Returns the boolean state of excludeFromConcatenation
     *
     * @return boolean
     * @since 1.0.0
     */
    public function isExcludeFromConcatenation() {
        return $this->getExcludeFromConcatenation();
    }

    /**
     * Returns the excludeFromPageRenderer
     *
     * @return string $excludeFromPageRenderer
     * @since 1.0.0
     */
    public function getExcludeFromPageRenderer() {
        return $this->excludeFromPageRenderer;
    }

    /**
     * Sets the excludeFromPageRenderer
     *
     * @param string $excludeFromPageRenderer
     * @return void
     * @since 1.0.0
     */
    public function setExcludeFromPageRenderer($excludeFromPageRenderer) {
        $this->excludeFromPageRenderer = $excludeFromPageRenderer;
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
     * Returns the data as array
     * @return array
     * @since 1.0.0
     */
    public function toArray() {
        
        $data = array();
        $data['hidden']     = $this->getHidden();
        $data['name']       = $this->getName();
        $data['media']      = $this->getMedia();
        $data['title']      = $this->getTitle();
        $data['compress']   = $this->getCompress();
        $data['forceOnTop'] = $this->getForceOnTop();
        $data['allWrap']    = $this->getAllWrap();
        $data['sortOrder']  = $this->getSorting();
        $data['excludeFromConcatenation'] = $this->getExcludeFromConcatenation();
        $data['excludeFromPageRenderer']  = $this->getExcludeFromPageRenderer();
        
        return $data;
    }

}
?>