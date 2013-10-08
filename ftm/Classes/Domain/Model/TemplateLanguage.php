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
class TemplateLanguage extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * sys_languag_uid
     *
     * @var integer
     * @validate NotEmpty
     * @since 1.0.0
     */
    protected $languageUid;

    /**
     * language
     *
     * @var string
     * @since 1.0.0
     */
    protected $language;

    /**
     * localeAll
     *
     * @var string
     * @since 1.0.0
     */
    protected $localeAll;

    /**
     * Name der Sprache
     *
     * @var string
     * @since 1.0.0
     */
    protected $title;

    /**
     * Returns the languageUid
     *
     * @return integer $languageUid
     * @since 1.0.0
     */
    public function getLanguageUid() {
        return $this->languageUid;
    }

    /**
     * Sets the languageUid
     *
     * @param integer $languageUid
     * @return void
     * @since 1.0.0
     */
    public function setLanguageUid($languageUid) {
        $this->languageUid = $languageUid;
    }

    /**
     * Returns the language
     *
     * @return string $language
     * @since 1.0.0
     */
    public function getLanguage() {
        return $this->language;
    }

    /**
     * Sets the language
     *
     * @param string $language
     * @return void
     * @since 1.0.0
     */
    public function setLanguage($language) {
        $this->language = $language;
    }

    /**
     * Returns the localeAll
     *
     * @return string $localeAll
     * @since 1.0.0
     */
    public function getLocaleAll() {
        return $this->localeAll;
    }

    /**
     * Sets the localeAll
     *
     * @param string $localeAll
     * @return void
     * @since 1.0.0
     */
    public function setLocaleAll($localeAll) {
        $this->localeAll = $localeAll;
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
     * Returns the data as array
     * @return array
     * @since 1.0.0
     */
    public function toArray() {
        
        $data = array();
        $data['languageUid'] = $this->getLanguageUid();
        $data['language']    = $this->getLanguage();
        $data['localeAll']   = $this->getLocaleAll();
        $data['title']       = $this->getTitle();
        
        return $data;
    }

}
?>