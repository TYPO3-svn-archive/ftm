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
class TemplateMarker extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * Typ des Markers
     *
     * @var string
     * @validate NotEmpty
     * @since 1.0.0
     */
    protected $markerType;

    /**
     * Name des Markers
     *
     * @var string
     * @since 1.0.0
     */
    protected $markerName;

    /**
     * TypoScript-Code des Markers
     *
     * @var string
     * @since 1.0.0
     */
    protected $markerTypoScript;

    /**
     * Marker-Beschreibung
     *
     * @var string
     * @since 1.0.0
     */
    protected $markerDescription;  
      
    /**
     * Returns the markerType
     *
     * @return string $markerType
     * @since 1.0.0
     */
    public function getMarkerType() {
        return $this->markerType;
    }

    /**
     * Sets the markerType
     *
     * @param string $markerType
     * @return void
     * @since 1.0.0
     */
    public function setMarkerType($markerType) {
        $this->markerType = $markerType;
    }
    
    /**
     * Returns the markerName
     *
     * @return string $markerName
     * @since 1.0.0
     */
    public function getMarkerName() {
        return $this->markerName;
    }

    /**
     * Sets the markerName
     *
     * @param string $markerName
     * @return void
     * @since 1.0.0
     */
    public function setMarkerName($markerName) {
        $this->markerName = $markerName;
    }
    
    /**
     * Returns the markerTypoScript
     *
     * @return string $markerTypoScript
     * @since 1.0.0
     */
    public function getMarkerTypoScript() {
        return $this->markerTypoScript;
    }

    /**
     * Sets the markerTypoScript
     *
     * @param string $markerTypoScript
     * @return void
     * @since 1.0.0
     */
    public function setMarkerTypoScript($markerTypoScript) {
        $this->markerTypoScript = $markerTypoScript;
    }
    
    /**
     * Returns the markerDescription
     *
     * @return string $markerDescription
     * @since 1.0.0
     */
    public function getMarkerDescription() {
        return $this->markerDescription;
    }

    /**
     * Sets the markerDescription
     *
     * @param string $markerDescription
     * @return void
     * @since 1.0.0
     */
    public function setMarkerDescription($markerDescription) {
        $this->markerDescription = $markerDescription;
    }

    /**
     * Returns the data as array
     * @return array
     * @since 1.0.0
     */
    public function toArray() {
        
        $data = array();
        $data['markerType']        = $this->getMarkerType();
        $data['markerName']        = $this->getMarkerName();
        $data['markerTypoScript']  = $this->getMarkerTypoScript();
        $data['markerDescription'] = $this->getMarkerDescription();
        
        return $data;
    }
    
}
?>