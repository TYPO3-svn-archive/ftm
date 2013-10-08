<?php
namespace CodingMs\Ftm\Service;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Thomas Deuling <typo3@coding.ms>, coding.ms
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Prueft ob es Updates gibt
 *
 * @package ftm
 * @subpackage Service
 * 
 * @author Thomas Deuling <typo3@coding.ms>
 * @since 1.1.0
 */
class Updates {

    /**
     * Backuped eine Datei
     *
     * @return  void
     */
    public static function check($extension='ftm', $thisVersionParts) {
        
        
        // Aktuelle Versions-Info ermitteln
        $context = array('http' => array('header' => 'Referer: http://'.$_SERVER['HTTP_HOST']));
        $xcontext = stream_context_create($context);
        $currentVersionJson  = @file_get_contents('http://fluid-template-manager.de/updates/'.$extension.'.json', false, $xcontext);
        if(!$currentVersionJson) {
            return \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_version_not_detected", "Ftm"); //Version konnte nicht ermittelt werden. Eventuell darf file_get_contents keine remote-URLs abrufen!
        }
        $currentVersionArray = json_decode($currentVersionJson, true);
        $currentVersionParts = explode('.', $currentVersionArray['version']);
        
        
        // Major-Release kleiner
        if($thisVersionParts[0]<$currentVersionParts[0]) {
            $updateMessage = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.major_release_available", "Ftm") . "<br />";
        }
        // Ansonsten kann nur ein Minor-Release oder Patch vorhanden sein 
        else {
            
            // Minor-Release kleiner
            if($thisVersionParts[1]<$currentVersionParts[1]) {
                $updateMessage = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.major_release_available", "Ftm") . "<br />";
            }
            // Ansonsten kann nur ein Patch vorhanden sein
            else {
                
                // Patch kleiner
                if($thisVersionParts[2]<$currentVersionParts[2]) {
                    $updateMessage = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.patch_available", "Ftm") . "<br />";
                }
                // Alles aktuell! :)
                else {
                    return false;
                }
            }
        }
        
        $updateMessage.= "<br />";
        $updateMessage.= \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.update_message", "Ftm");
        
        return $updateMessage;
    }
    
}

?>