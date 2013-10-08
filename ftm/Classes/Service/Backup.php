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
 * Backuped eine Datei
 *
 * @package ftm
 * @subpackage Service
 * 
 * @author Thomas Deuling <typo3@coding.ms>
 * @since 1.0.0
 */
class Backup {


    /**
     * Backuped eine Datei
     *
     * @return  void
     */
    public static function backupFile($template, $file) {
        
        // Backup-Inhalt
        $fileContent = file_get_contents($file);
       
        // Pfad ermitteln
        $relPath = \CodingMs\Ftm\Utility\Tools::getDirectory("Backup", '');
        $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
        
        // Alternativer-Pfad aus uploads
        $relPathAlt = "uploads/tx_ftm/";
        $absPathAlt = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPathAlt);
        
        // Dateinamen fuer Backup-Datei erstellen
        $fileName = str_replace($absPath, '', $file);
        $fileName = str_replace($absPathAlt, '', $fileName);
        $fileName = str_replace('/', '-', $fileName);
        $fileName = date('Y-m-d_H-i-s_').$fileName;
        
        // Backup-Datei schreiben
        $fileContent = file_put_contents($absPath.$fileName, $fileContent);
        
    }
    
}

?>