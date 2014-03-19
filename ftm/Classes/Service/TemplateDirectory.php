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
 * Template-Verzeichnis Funktionen
 * Sorgt z.B. dafuer, das die Template-Verzeichnisstruktur
 * immer aktuell vorhanden ist
 *
 * @package ftm
 * @subpackage Service
 * 
 * @author Thomas Deuling <typo3@coding.ms>
 * @since 1.0.0
 */
class TemplateDirectory {
    
    /**
     * Prüft die Template Verzeichnisstruktur
     * 
     * @author     Thomas Deuling <typo3@coding.ms>
     * @param      string $templateName Template/Verzeichnis-Name im Ext-Verzeichnis
     * @return     mixed TRUE wenn alle Verzeichnisse vorhanden sind, ansonsten ein Array mit den vermissten Verzeichnissen
     * @since      1.0.0
     */
    public static function checkDirectories($templateName='', array $directories=array()) {
        
        $success = TRUE;
        $missingDirectories = array();
        $directoryBase = 'typo3conf/ext/';

        // Zuerst pruefen ob es das Projekt-Verzeichnis gibt
        $relPath = $directoryBase.$templateName;
        $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
        if(!is_dir($absPath)) {
            $success = FALSE;
            $missingDirectories[$absPath] = $templateName;
        }
        
        // Dann alle anderen Verzeichnisse pruefen 
        if(!empty($directories) && $success) {
            foreach($directories as $tempDirectory) {
                
                $relPath = $directoryBase.$templateName."/".$tempDirectory;
                $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
                
                if(!is_dir($absPath)) {
                    $success = FALSE;
                    $missingDirectories[$absPath] = $tempDirectory;
                }
                
            }
        }
        
        if($success) {
            return TRUE;
        }
        else {
            return $missingDirectories;
        }
    }
    
    /**
     * Erstellt die Template Verzeichnisstruktur
     * 
     * @todo Hier muss auch der dcncss-Typ berücksichtigt werden
     * @author     Thomas Deuling <typo3@coding.ms>
     * @param      string $templateName Verzeichnis-Name im Ext-Verzeichnis
     * @return     mixed TRUE wenn alle Verzeichnisse vorhanden sind bzw. erstellt wurden, ansonsten ein Array mit den vermissten/nicht erstellten Verzeichnissen
     * @since      1.0.0
     */
    public static function createDirectories($templateName='', array $directories=array()) {
        
        $success = TRUE;
        $missingDirectories = array();
        $directoryBase = 'typo3conf/ext/';
        
        // Zuerst pruefen ob es das Projekt-Verzeichnis gibt
        $relPath = $directoryBase.$templateName;
        $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
        if(!is_dir($absPath)) {
            if(!mkdir($absPath)) {
                $success = FALSE;
                $missingDirectories[$absPath] = $templateName;
            }
            else {
                chmod($absPath, 0777);
            }
        }
        
        // Dann alle anderen Verzeichnisse pruefen 
        if(!empty($directories) && $success) {
            foreach($directories as $tempDirectory) {
                
                $relPath = $directoryBase.$templateName."/".$tempDirectory;
                $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
                
                if(!is_dir($absPath)) {
                    if(!mkdir($absPath)) {
                        $success = FALSE;
                        $missingDirectories[$absPath] = $tempDirectory;
                    }
                    else {
                        chmod($absPath, 0777);
                    }
                }
                
            }
        }
        
        if($success) {
            return TRUE;
        }
        else {
            return $missingDirectories;
        }
    }
    
}

?>
