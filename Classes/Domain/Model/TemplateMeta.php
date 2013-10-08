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
class TemplateMeta extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject {

    /**
     * abstract
     *
     * @var string
     * @since 1.1.0
     */
    protected $abstract;

    /**
     * keywords
     *
     * @var string
     * @since 1.1.0
     */
    protected $keywords;

    /**
     * description
     *
     * @var string
     * @since 1.1.0
     */
    protected $description;

    /**
     * author
     *
     * @var string
     * @since 1.0.0
     */
    protected $author;

    /**
     * authorEmail
     *
     * @var string
     * @since 1.1.0
     */
    protected $authorEmail;

    /**
     * copyright
     *
     * @var string
     * @since 1.0.0
     */
    protected $copyright;

    /**
     * robots
     *
     * @var string
     * @since 1.0.0
     */
    protected $robots;

    /**
     * revisit
     *
     * @var string
     * @since 1.1.0
     */
    protected $revisit;

    /**
     * useCanonical
     *
     * @var boolean
     * @since 1.1.0
     */
    protected $useCanonical;

    /**
     * Returns the abstract
     *
     * @return string $abstract
     * @since 1.1.0
     */
    public function getAbstract() {
        return $this->abstract;
    }

    /**
     * Sets the abstract
     *
     * @param string $abstract
     * @return void
     * @since 1.1.0
     */
    public function setAbstract($abstract) {
        $this->abstract = $abstract;
    }

    /**
     * Returns the keywords
     *
     * @return string $keywords
     * @since 1.1.0
     */
    public function getKeywords() {
        return $this->keywords;
    }

    /**
     * Sets the keywords
     *
     * @param string $keywords
     * @return void
     * @since 1.1.0
     */
    public function setKeywords($keywords) {
        $this->keywords = $keywords;
    }

    /**
     * Returns the description
     *
     * @return string $description
     * @since 1.1.0
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     * @since 1.1.0
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Returns the author
     *
     * @return string $author
     * @since 1.0.0
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * Sets the author
     *
     * @param string $author
     * @return void
     * @since 1.0.0
     */
    public function setAuthor($author) {
        $this->author = $author;
    }

    /**
     * Returns the authorEmail
     *
     * @return string $authorEmail
     * @since 1.1.0
     */
    public function getAuthorEmail() {
        return $this->authorEmail;
    }

    /**
     * Sets the authorEmail
     *
     * @param string $authorEmail
     * @return void
     * @since 1.1.0
     */
    public function setAuthorEmail($authorEmail) {
        $this->authorEmail = $authorEmail;
    }

    /**
     * Returns the copyright
     *
     * @return string $copyright
     * @since 1.0.0
     */
    public function getCopyright() {
        return $this->copyright;
    }

    /**
     * Sets the copyright
     *
     * @param string $copyright
     * @return void
     * @since 1.0.0
     */
    public function setCopyright($copyright) {
        $this->copyright = $copyright;
    }

    /**
     * Returns the robots
     *
     * @return string $robots
     * @since 1.0.0
     */
    public function getRobots() {
        return $this->robots;
    }

    /**
     * Sets the robots
     *
     * @param string $robots
     * @return void
     * @since 1.0.0
     */
    public function setRobots($robots) {
        $this->robots = $robots;
    }

    /**
     * Returns the revisit
     *
     * @return string $revisit
     * @since 1.1.0
     */
    public function getRevisit() {
        return $this->revisit;
    }

    /**
     * Sets the revisit
     *
     * @param string $revisit
     * @return void
     * @since 1.1.0
     */
    public function setRevisit($revisit) {
        $this->revisit = $revisit;
    }

    /**
     * Returns the useCanonical
     *
     * @return boolean $useCanonical
     * @since 1.1.0
     */
    public function getUseCanonical() {
        return $this->useCanonical;
    }

    /**
     * Sets the useCanonical
     *
     * @param boolean $useCanonical
     * @return void
     * @since 1.1.0
     */
    public function setUseCanonical($useCanonical) {
        $this->useCanonical = $useCanonical;
    }

    /**
     * Sets the default values
     *
     * @return void
     * @since 1.0.0
     */
    public function setDefaults() {
        
    } 

    /**
     * Returns the data as array
     * @return array
     * @since 1.0.0
     */
    public function toArray() {
        
        $data = array();
        $data['abstract']     = $this->getAbstract();
        $data['keywords']     = $this->getKeywords();
        $data['description']  = $this->getDescription();
        $data['author']       = $this->getAuthor();
        $data['authorEmail']  = $this->getAuthorEmail();
        $data['copyright']    = $this->getCopyright();
        $data['robots']       = $this->getRobots();
        $data['revisit']      = $this->getRevisit();
        $data['useCanonical'] = $this->getUseCanonical();
        
        return $data;
    }

}
?>