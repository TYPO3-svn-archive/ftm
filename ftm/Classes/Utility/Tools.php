<?php
namespace CodingMs\Ftm\Utility;

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
 * Kleine Tools
 *
 * @package ftm
 * @subpackage Utility
 */
class Tools {

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected static $objectManager;

    /**
     * Template Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\TemplateRepository
     */
    protected static $fluidTemplateRepository;


    /**
     * Ermittelt Seiten auf der Rootline
     * 
     * @param array $array Array mit Page-Ids
     */
    public static function getRootlineFtms(array $pids=array()) {
        
        $ftmTemplateDirs = array();
        
        
        // Schauen ob der Objekt-Manager schon vorhanden ist
        if(!(self::$objectManager instanceof \TYPO3\CMS\Extbase\Object\ObjectManager)) {
            self::$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
        }

        
        // Schauen ob das Repository schon vorhanden ist
        if(!(self::$fluidTemplateRepository instanceof \CodingMs\Ftm\Domain\Repository\TemplateRepository)) {
            self::$fluidTemplateRepository = self::$objectManager->get('\CodingMs\Ftm\Domain\Repository\TemplateRepository');
        }
        
        
        if(!empty($pids)) {
            foreach($pids as $pid) {
                $tempTemplate = self::$fluidTemplateRepository->findOneByPid($pid);
                if($tempTemplate instanceof \CodingMs\Ftm\Domain\Model\Template) {
                    $ftmTemplateDirs[] = $tempTemplate->getTemplateDir();
                }
            }
        }
        
        return $ftmTemplateDirs;
    }
    
    /**
     * Ermittelt Seiten auf der Rootline
     * 
     * @param array $array Array mit Page-Ids
     */
    public static function getRootlinePids($pid) {
        $sysPage  = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Frontend\Page\PageRepository');
        $rootline = $sysPage->getRootLine($pid);
        $rootlinePages   = array();
        $rootlinePages[] = $pid;
        if(!empty($rootline)) {
            foreach($rootline as $tempPage) {
                $rootlinePages[] = $tempPage['pid'];
            }
        }
        return $rootlinePages;
    }

    /**
     * Ermittelt die TYPO3-Version
     * 
     * @param float TYPO3-Version
     */
    public static function getTypo3Version() {
        
        /**
         * TYPO3_version als Constant vorhanden?! Testen!
         */
        
        $compatVersion = explode('.', $GLOBALS['TYPO3_CONF_VARS']['SYS']['compat_version']);
        return (float)($compatVersion[0].'.'.$compatVersion[1]);
    }
    
    
    
    
    /**
     * Ermittelt Pfade
     * 
     * Usage: \CodingMs\Ftm\Utility\Tools::getDirectory("Less", $fluidTemplate->getTemplateDir());
     * 
     * @param string Verzeichnis-Typ
     * @param string Name des Themes/Theme-Verzeichnis, falls noetig
     */
    public static function getDirectory($type, $themeName='') {

        if($type=="TypoScript") {
            return "typo3conf/ext/".$themeName."/Configuration/TypoScript/";
        }
        if($type=="Stylesheets") {
            return "typo3conf/ext/".$themeName."/Resources/Public/Stylesheets/";
        }
        if($type=="Icons") {
            return "typo3conf/ext/".$themeName."/Resources/Public/Icons/";
        }
        if($type=="Sass") {
            return "typo3conf/ext/".$themeName."/Resources/Private/DynCss/Files/";
        }
        if($type=="Less") {
            return "typo3conf/ext/".$themeName."/Resources/Private/DynCss/Files/";
        }
        if($type=="LessBasic") {
            return "typo3conf/ext/".$themeName."/Resources/Private/DynCss/Files/";
        }
        if($type=="LessGridElementLayouts") {
            return "typo3conf/ext/".$themeName."/Resources/Private/DynCss/Files/GridElementLayouts/";
        }
        if($type=="LessContentLayouts") {
            return "typo3conf/ext/".$themeName."/Resources/Private/DynCss/Files//ContentLayouts/";
        }
        if($type=="LessImageHoverEffects") {
            return "typo3conf/ext/".$themeName."/Resources/Private/DynCss/Files/ImageHoverEffects/";
        }
        if($type=="FluidTemplates") {
            return "typo3conf/ext/".$themeName."/Resources/Private/";
        }
        if($type=="TemplateStructureBootstrap") {
            return "typo3conf/ext/ftm/Resources/Private/Theme/Bootstrap/";
        }
        if($type=="TemplateStructureYaml") {
            return "typo3conf/ext/ftm/Resources/Private/Theme/Yaml/";
        }
        if($type=="Backup") {
            
            // ggf. noch schnell erstellen
            $relPath = "uploads/tx_ftm/backup/";
            $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
            if(!file_exists($absPath)) {
                mkdir($absPath);
            }
            
            return $relPath;
        }

    }
    
    /**
     * Schreibt eine Log-Zeile
     * 
     * Usage: \CodingMs\Ftm\Utility\Tools::writeLog("some text");
     * 
     * @param string Zeile zum Loggen
     */
    public static function writeLog($logString) {
        $relPath = "uploads/tx_ftm/";
        $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
        return file_put_contents($absPath."log.txt", $logString."\n", FILE_APPEND);
    }

}
?>