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
     * Benoetigte Verzeichnis Struktur
     * @var array
     * @since 1.0.0
     */
    public static $directories = array(
    
        'Configuration'               => 'Hier liegt das gesamte Template',
        'Configuration/TCA'           => 'Hier liegt das gesamte Template',
        'Configuration/TypoScript'    => 'Hier liegt das gesamte Template',
        'Documentation'               => 'Hier liegt das gesamte Template',
        'Initialisation'              => 'Hier liegt das gesamte Template',
        'Initialisation/Files'        => 'Hier liegt das gesamte Template',
        'Initialisation/Extensions'   => 'Hier liegt das gesamte Template',
        'Meta'                        => 'Hier liegt das gesamte Template',
        'Resources'                   => 'Hier liegt das gesamte Template',
        'Resources/Private'           => 'Hier liegt das gesamte Template',
        'Resources/Private/Language'  => 'Hier liegt das gesamte Template',
        'Resources/Private/Layouts'   => 'Hier liegt das gesamte Template',
        'Resources/Private/Partials'  => 'Hier liegt das gesamte Template',
        'Resources/Private/Templates' => 'Hier liegt das gesamte Template',
        
        'Resources/Public'             => 'Hier liegt das gesamte Template',
        'Resources/Public/Fonts'       => 'Hier liegt das gesamte Template',
        'Resources/Public/Icons'       => 'Hier liegt das gesamte Template',
        'Resources/Public/Images'      => 'Hier liegt das gesamte Template',
        'Resources/Public/JavaScript'  => 'Hier liegt das gesamte Template',
        'Resources/Public/Less'        => 'Hier liegt das gesamte Template',
        'Resources/Public/Less/BasicLess'     => 'Hier liegt das gesamte Template',
        'Resources/Public/Less/BasicLess/ContentLayouts' => 'Hier liegt das gesamte Template',
        'Resources/Public/Less/BasicLess/GridElementLayouts' => 'Hier liegt das gesamte Template',
        'Resources/Public/Less/BasicLayout'   => 'Hier liegt das gesamte Template',
        'Resources/Public/Less/Modifications' => 'Hier liegt das gesamte Template',
        'Resources/Public/Less/Areas'         => 'Hier liegt das gesamte Template',
        'Resources/Public/Less/Navigations'   => 'Hier liegt das gesamte Template',
        'Resources/Public/Less/Layouts'       => 'Hier liegt das gesamte Template',
        'Resources/Public/Less/Templates'     => 'Hier liegt das gesamte Template',
        'Resources/Public/Less/Partials'      => 'Hier liegt das gesamte Template',
        'Resources/Public/Stylesheets' => 'Hier liegt das gesamte Template',
        'Resources/Public/Contrib'     => 'Hier liegt das gesamte Template',
        'Resources/Public/Extensions'  => 'Hier liegt das gesamte Template',
    
    );
    
    /**
     * @ToDo: auch das 0_lessBasics etc erstellen und die Dateien reinkopieren
     */
    
         
    /**
     * Prueft die Template Verzeichnisstruktur
     * 
     * @author     Thomas Deuling <typo3@coding.ms>
     * @param      string Verzeichnis-Name im Ext-Verzeichnis
     * @return     mixed true wenn alle Verzeichnisse vorhanden sind, ansonsten ein Array mit den vermissten Verzeichnissen
     * @since      1.0.0
     */
    public static function checkDirectories($templateName) {
        
        $success = true;
        $missingDirectories = array();
        
        
        // Zuerst pruefen ob es das Projekt-Verzeichnis gibt
        $relPath = "typo3conf/ext/".$templateName;
        $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
        if(!is_dir($absPath)) {
            $success = false;
            $directory = 'root';
            $missingDirectories[$directory] = 'Hier liegen alle Website-Daten';
        }
        
        
        // Dann alle anderen Verzeichnisse pruefen 
        if(!empty(self::$directories) && $success) {
            foreach(self::$directories as $directory => $description) {
                
                $relPath = "typo3conf/ext/".$templateName."/".$directory;
                $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
                
                if(!is_dir($absPath)) {
                    $success = false;
                    $missingDirectories[$directory] = $description;
                }
                
            }
        }
        
        if($success) {
            return true;
        }
        else {
            return $missingDirectories;
        }
    }
    
         
    /**
     * Erstellt die Template Verzeichnisstruktur
     * 
     * @author     Thomas Deuling <typo3@coding.ms>
     * @param      string Verzeichnis-Name im Ext-Verzeichnis
     * @return     mixed true wenn alle Verzeichnisse vorhanden sind bzw. erstellt wurden, ansonsten ein Array mit den vermissten/nicht erstellten Verzeichnissen
     * @since      1.0.0
     */
    public static function createDirectories($templateName) {
        
        $success = true;
        $missingDirectories = array();
        
        
        // Zuerst pruefen ob es das Projekt-Verzeichnis gibt
        $relPath = "typo3conf/ext/".$templateName;
        $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
        if(!is_dir($absPath)) {
            if(!mkdir($absPath)) {
                $success = false;
                $directory = 'root';
                $missingDirectories[$directory] = 'Hier liegen alle Website-Daten';
            }
            else {
                chmod($absPath, 0777);
            }
        }
        
        
        // Dann alle anderen Verzeichnisse pruefen 
        if(!empty(self::$directories) && $success) {
            foreach(self::$directories as $directory => $description) {
                
                $relPath = "typo3conf/ext/".$templateName."/".$directory;
                $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
                
                if(!is_dir($absPath)) {
                    if(!mkdir($absPath)) {
                        $success = false;
                        $missingDirectories[$directory] = $description;
                    }
                    else {
                        chmod($absPath, 0777);
                    }
                }
                
            }
        }
        
        if($success) {
            return true;
        }
        else {
            return $missingDirectories;
        }
    }
    
    
}

?>
