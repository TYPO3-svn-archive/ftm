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
class TemplateMenuContainer extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * Hier wird der Menu-Name gespeichert
     *
     * @var string
     * @since 1.0.0
     */
    protected $menuName;

    /**
     * Hier wird der Menu-Typ gespeichert
     *
     * @var string
     * @since 1.0.0
     */
    protected $special;
    
    /**
     * Einstiegs-Ebene fuer das Menu
     * Als SelectBox (mögliche Wert -10 bis 10)
     * Hier kann eingestellt werden auf welcher Ebene der Rootline das Menue beginnen soll.
     * Dabei hat die Root-Seite die Ebene 0.
     * Wird ein negativer Wert verwendet, wird das entryLevel relative zur aktuellen Seite.
     * -1 waere somit die Ebene der aktuellen Seite, -2 die Ebene der darunterliegenden Seite
     *
     * @var string
     * @validate NotEmpty
     * @since 1.0.0
     */
    protected $entryLevel;

    /**
     * Hier wird angegeben welche Seiten nicht im Menue erscheinen sollen
     * Diese Einstellung wird mit einem Pages-Selector realisiert
     *
     * @var string
     * @since 1.0.0
     */
    protected $excludeUidList;

    /**
     * Hier wird angegeben welche Seiten im Special-List-Menue erscheinen sollen
     * Diese Einstellung wird mit einem Pages-Selector realisiert
     *
     * @var string
     * @since 1.0.0
     */
    protected $specialValueList;

    /**
     * Wenn aktiv werden auch Seiten im Menue angezeigt, die HideInMenu markiert sind
     *
     * @var boolean
     * @since 1.0.0
     */
    protected $includeNotInMenu;

    /**
     * Maximale Anzahl an Eintraege im Menue
     *
     * @var int
     * @since 1.0.0
     */
    protected $maxItems;

    /**
     * Minimale Anzahl an Eintraegen. Wenn weniger Eintraege als das Minimum vorhanden sind, wird mit leeren Eintraegen aufgefuellt
     *
     * @var int
     * @since 1.0.0
     */
    protected $minItems;

    /**
     * Standard-Wrap für das gesamte Menue
     *
     * @var string
     * @since 1.0.0
     */
    protected $stdWrap;

    /**
     * Wrappt nur das gesamte Menue
     *
     * @var string
     * @since 1.0.0
     */
    protected $wrap;

    /**
     * menuObjects
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateMenuObject>
     * @since 1.0.0
     */
    protected $menuObjects;

    /**
     * __construct
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct() {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all \TYPO3\CMS\Extbase\Persistence\ObjectStorage properties.
     *
     * @return void
     * @since 1.0.0
     */
    protected function initStorageObjects() {
        /**
         * Do not modify this method!
         * It will be rewritten on each save in the extension builder
         * You may modify the constructor of this class instead
         */
        $this->menuObjects = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a TemplateMenuObject
     *
     * @param \CodingMs\Ftm\Domain\Model\TemplateMenuObject $menuObject
     * @return void
     * @since 1.0.0
     */
    public function addMenuObject(\CodingMs\Ftm\Domain\Model\TemplateMenuObject $menuObject) {
        $this->menuObjects->attach($menuObject);
    }

    /**
     * Removes a TemplateMenuObject
     *
     * @param \CodingMs\Ftm\Domain\Model\TemplateMenuObject $menuObjectToRemove The TemplateMenuObject to be removed
     * @return void
     * @since 1.0.0
     */
    public function removeMenuObject(\CodingMs\Ftm\Domain\Model\TemplateMenuObject $menuObjectToRemove) {
        $this->menuObjects->detach($menuObjectToRemove);
    }

    /**
     * Returns the menuObjects
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateMenuObject> $menuObjects
     * @since 1.0.0
     */
    public function getMenuObjects() {
        return $this->menuObjects;
    }

    /**
     * Sets the menuObjects
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateMenuObject> $menuObjects
     * @return void
     * @since 1.0.0
     */
    public function setMenuObjects(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $menuObjects) {
        $this->menuObjects = $menuObjects;
    }

    /**
     * Returns the menuName
     *
     * @return string $menuName
     * @since 1.0.0
     */
    public function getMenuName() {
        return $this->menuName;
    }

    /**
     * Sets the menuName
     *
     * @param string $menuName
     * @return void
     * @since 1.0.0
     */
    public function setMenuName($menuName) {
        $this->menuName = $menuName;
    }

    /**
     * Returns the special
     *
     * @return string $special
     * @since 1.0.0
     */
    public function getSpecial() {
        return $this->special;
    }

    /**
     * Sets the special
     *
     * @param string $special
     * @return void
     * @since 1.0.0
     */
    public function setSpecial($special) {
        $this->special = $special;
    }

    /**
     * Returns the specialValueList
     *
     * @return string $specialValueList
     * @since 1.0.0
     */
    public function getSpecialValueList() {
        return $this->specialValueList;
    }

    /**
     * Sets the specialValueList
     *
     * @param string $specialValueList
     * @return void
     * @since 1.0.0
     */
    public function setSpecialValueList($specialValueList) {
        $this->specialValueList = $specialValueList;
    }

    /**
     * Returns the entryLevel
     *
     * @return string $entryLevel
     * @since 1.0.0
     */
    public function getEntryLevel() {
        return $this->entryLevel;
    }

    /**
     * Sets the entryLevel
     *
     * @param string $entryLevel
     * @return void
     * @since 1.0.0
     */
    public function setEntryLevel($entryLevel) {
        $this->entryLevel = $entryLevel;
    }

    /**
     * Returns the excludeUidList
     *
     * @return string $excludeUidList
     * @since 1.0.0
     */
    public function getExcludeUidList() {
        return $this->excludeUidList;
    }

    /**
     * Sets the excludeUidList
     *
     * @param string $excludeUidList
     * @return void
     * @since 1.0.0
     */
    public function setExcludeUidList($excludeUidList) {
        $this->excludeUidList = $excludeUidList;
    }

    /**
     * Returns the includeNotInMenu
     *
     * @return boolean $includeNotInMenu
     * @since 1.0.0
     */
    public function getIncludeNotInMenu() {
        return $this->includeNotInMenu;
    }

    /**
     * Sets the includeNotInMenu
     *
     * @param boolean $includeNotInMenu
     * @return void
     * @since 1.0.0
     */
    public function setIncludeNotInMenu($includeNotInMenu) {
        $this->includeNotInMenu = $includeNotInMenu;
    }

    /**
     * Returns the maxItems
     *
     * @return int $maxItems
     * @since 1.0.0
     */
    public function getMaxItems() {
        return $this->maxItems;
    }

    /**
     * Sets the maxItems
     *
     * @param int $maxItems
     * @return void
     * @since 1.0.0
     */
    public function setMaxItems($maxItems) {
        $this->maxItems = $maxItems;
    }

    /**
     * Returns the minItems
     *
     * @return int $minItems
     * @since 1.0.0
     */
    public function getMinItems() {
        return $this->minItems;
    }

    /**
     * Sets the minItems
     *
     * @param int $minItems
     * @return void
     * @since 1.0.0
     */
    public function setMinItems($minItems) {
        $this->minItems = $minItems;
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
     * Returns the data as array
     * @return array
     * @since 1.0.0
     */
    public function toArray() {
        
        $data = array();
        $data['menuName']         = $this->getMenuName();
        $data['special']          = $this->getSpecial();
        $data['specialValueList'] = $this->getSpecialValueList();
        $data['entryLevel']       = $this->getEntryLevel();
        $data['excludeUidList']   = $this->getExcludeUidList();
        $data['includeNotInMenu'] = $this->getIncludeNotInMenu();
        $data['maxItems']         = $this->getMaxItems();
        $data['minItems']         = $this->getMinItems();
        $data['stdWrap']          = $this->getStdWrap();
        $data['wrap']             = $this->getWrap();
        
        // Menu-Objekte
        $menuObjectsArray = array();
        $menuObjects = $this->getMenuObjects();
        if($menuObjects->count()>0) {
            foreach($menuObjects as $menuObject) {
                $menuObjectsArray[$menuObject->getSorting()] = $menuObject->toArray();
            }
        }
        $data['menuObjects'] = $menuObjectsArray;
        
        return $data;
    }
    
}
?>