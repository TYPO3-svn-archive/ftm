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
class TtContent extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * uid
     * 
     * @var int
     * @validate NotEmpty
     * @since 1.1.0
     */
    protected $uid;
    
    /**
     * pid
     * 
     * @var int
     * @validate NotEmpty
     * @since 1.1.0
     */
    protected $pid;
    
    /**
     * sorting
     * 
     * @var int
     * @validate NotEmpty
     * @since 1.1.0
     */
    protected $sorting;
    
    /**
     * hidden=1
     *
     * @var boolean
     */
    protected $hidden=1;
    
    
    /**
     * contentType
     *
     * @var string
     */
    protected $contentType;
    
    /**
     * header
     * 
     * @var string
     * @since 1.1.0
     */
    protected $header;
    
    /**
     * headerLink
     * 
     * @var string
     * @since 1.1.0
     */
    protected $headerLink;
    
    /**
     * subHeader
     *
     * @var string
     */
    protected $subHeader;
    
    /**
     * bodyText
     * 
     * @var string
     * @since 1.1.0
     */
    protected $bodyText;
    
    /**
     * image
     * 
     * @var string
     * @since 1.1.0
     */
    protected $image;
    
    /**
     * imageLink
     * 
     * @var string
     * @since 1.1.0
     */
    protected $imageLink;
    
    /**
     * colPos
     * 
     * @var int
     * @since 1.1.0
     */
    protected $colPos;
    
    /**
     * listType
     *
     * @var string
     */
    protected $listType;
    
    /**
     * imageCols
     *
     * @var int
     */
    protected $imageCols;
    
    /**
     * sectionIndex
     *
     * @var int
     */
    protected $sectionIndex;
    
    /**
     * piFlexForm
     *
     * @var string
     */
    protected $piFlexForm;
    
    /**
     * layout
     *
     * @var int
     */
    protected $layout;
    
    
    /**
     * Returns the pid
     *
     * @return int $pid
     * @since 1.1.0
     */
    public function getPid() {
        return $this->pid;
    }
    
    /**
     * Sets the pid
     *
     * @param int $pid
     * @return void
     */
    public function setPid($pid) {
        $this->pid = $pid;
    }
    

    /**
     * Returns the sorting
     *
     * @return int $sorting
     * @since 1.1.0
     */
    public function getSorting() {
        return $this->sorting;
    }
    
    /**
     * Sets the sorting
     *
     * @param int $sorting
     * @return void
     */
    public function setSorting($sorting) {
        $this->sorting = $sorting;
    }
    
    /**
     * Returns the hidden
     *
     * @return boolean $hidden
     */
    public function getHidden() {
        return $this->hidden;
    }
    
    /**
     * Sets the hidden
     *
     * @param boolean $hidden
     * @return void
     */
    public function setHidden($hidden) {
        $this->hidden = $hidden;
    }
    
    
    /**
     * Returns the contentType
     *
     * @return string $contentType
     */
    public function getContentType() {
        return $this->contentType;
    }
    
    /**
     * Sets the contentType
     *
     * @param string $contentType
     * @return void
     */
    public function setContentType($contentType) {
        $this->contentType = $contentType;
    }
    

    /**
     * Returns the header
     *
     * @return string $header
     * @since 1.1.0
     */
    public function getHeader() {
        return $this->header;
    }
    
    /**
     * Sets the header
     *
     * @param string $header
     * @return void
     */
    public function setHeader($header) {
        $this->header = $header;
    }
    

    /**
     * Returns the headerLink
     *
     * @return string $headerLink
     * @since 1.1.0
     */
    public function getHeaderLink() {
        return $this->headerLink;
    }
    
    /**
     * Sets the headerLink
     *
     * @param string $headerLink
     * @return void
     */
    public function setHeaderLink($headerLink) {
        $this->headerLink = $headerLink;
    }
    
    /**
     * Returns the subHeader
     *
     * @return string $subHeader
     */
    public function getSubheader() {
        return $this->subHeader;
    }
    
    /**
     * Sets the subHeader
     *
     * @param string $subHeader
     * @return void
     */
    public function setSubheader($subHeader) {
        $this->subHeader = $subHeader;
    }
    

    /**
     * Returns the bodyText
     *
     * @return string $bodyText
     * @since 1.1.0
     */
    public function getBodyText() {
        return $this->bodyText;
    }

    /**
     * Sets the bodyText
     *
     * @param string $bodyText
     * @return void
     */
    public function setBodyText($bodyText) {
        $this->bodyText = $bodyText;
    }
    
    /**
     * Returns the image
     *
     * @return string $image
     * @since 1.1.0
     */
    public function getImage() {
        return $this->image;
    }
    
    /**
     * Sets the image
     *
     * @param string $image
     * @return void
     */
    public function setImage($image) {
        $this->image = $image;
    }
    

    /**
     * Returns the imageLink
     *
     * @return string $imageLink
     * @since 1.1.0
     */
    public function getImageLink() {
        return $this->imageLink;
    }
    
    /**
     * Sets the imageLink
     *
     * @param string $imageLink
     * @return void
     */
    public function setImageLink($imageLink) {
        $this->imageLink = $imageLink;
    }
    

    /**
     * Returns the colPos
     *
     * @return int $colPos
     * @since 1.1.0
     */
    public function getColPos() {
        return $this->colPos;
    }

    /**
     * Sets the colPos
     *
     * @param int $colPos
     * @return void
     */
    public function setColPos($colPos) {
        $this->colPos = $colPos;
    }
    
    /**
     * Returns the listType
     *
     * @return string $listType
     */
    public function getListType() {
        return $this->listType;
    }
    
    /**
     * Sets the listType
     *
     * @param string $listType
     * @return void
     */
    public function setListType($listType) {
        $this->listType = $listType;
    }
    
    /**
     * Returns the imageCols
     *
     * @return int $imageCols
     */
    public function getImageCols() {
        return $this->imageCols;
    }
    
    /**
     * Sets the imageCols
     *
     * @param int $imageCols
     * @return void
     */
    public function setImageCols($imageCols) {
        $this->imageCols = $imageCols;
    }
    
    /**
     * Returns the sectionIndex
     *
     * @return int $sectionIndex
     */
    public function getSectionIndex() {
        return $this->sectionIndex;
    }
    
    /**
     * Sets the sectionIndex
     *
     * @param int $sectionIndex
     * @return void
     */
    public function setSectionIndex($sectionIndex) {
        $this->sectionIndex = $sectionIndex;
    }
    
    /**
     * Returns the piFlexForm
     *
     * @return string $piFlexForm
     */
    public function getPiFlexForm() {
        return $this->piFlexForm;
    }
    
    /**
     * Sets the piFlexForm
     *
     * @param string $piFlexForm
     * @return void
     */
    public function setPiFlexForm($piFlexForm) {
        $this->piFlexForm = $piFlexForm;
    }
    
    /**
     * Returns the layout
     *
     * @return int $layout
     */
    public function getLayout() {
        return $this->layout;
    }
    
    /**
     * Sets the layout
     *
     * @param int $layout
     * @return void
     */
    public function setLayout($layout) {
        $this->layout = $layout;
    }
    
}
?>