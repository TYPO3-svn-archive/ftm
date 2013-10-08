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
 * Generiert das TypoScript
 *
 * @package ftm
 * @subpackage Service
 * 
 * @author Thomas Deuling <typo3@coding.ms>
 * @since 1.0.0
 * @deprecated
 */
class TypoScript {

    /**
     * GridLayout Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\GridLayoutRepository
     */
    protected $gridLayoutRepository;

    /**
     * PluginCloud-Service
     *
     * @var \CodingMs\Ftm\Service\PluginService
     */
    protected $pluginService;

    /**
     * injectGridLayoutRepository
     *
     * @param \CodingMs\Ftm\Domain\Repository\GridLayoutRepository $gridLayoutRepository
     * @return void
     */
    public function injectGridLayoutRepository(\CodingMs\Ftm\Domain\Repository\GridLayoutRepository $gridLayoutRepository) {
        $this->gridLayoutRepository = $gridLayoutRepository;
    }


    /**
     * Backuped eine Datei
     *
     * @return  void
     */
    public function generate($fluidTemplate, $typoScriptFile) {
        

        // Benoetigte Daten sammeln
        $dataCheckFailed = false;
        $templateDataArray = $fluidTemplate->toArray();
        
                
        // Pruefen ob Templates vorhanden sind
        $tempFluid = unserialize($templateDataArray['fluid']);
        if(!is_array($tempFluid) || empty($tempFluid)) {
            $headline = 'TypoScript nicht re-/generiert!';
            $message  = 'Das '.$typoScriptFile.' TypoScript konnte nicht re-/generiert werden, da auf dieser Seite anscheinend noch keine Fluid-Templates existieren.';
            $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::WARNING);
            
            $dataCheckFailed = true;
        }
        
        
        // Grid-Layouts auslesen, damit TypoScript 
        // dafuer generiert werden kann
        $gridLayouts = $this->gridLayoutRepository->findAllWithoutPid();
        $gridLayoutsArray = array();
        foreach($gridLayouts as $gridLayout) {
            $gridLayoutsArray[$gridLayout->getUid()] = $gridLayout->getTitle();
        }
        $templateDataArray['gridLayouts'] = serialize($gridLayoutsArray);

        
        // TypoScript generieren
        if(!$dataCheckFailed) {
                     
            $result = $this->pluginService->executeAction("generateTypoScript", $templateDataArray);
            
            
            // Antwort auswerten
            if($result['status']=='success') {
                
                
                // Pfad ermitteln
                $typoScript = "";
                $filepath   = \CodingMs\Ftm\Utility\Tools::getDirectory("TypoScript", $fluidTemplate->getTemplateDir());
                $relPath    = $filepath.$typoScriptFile;
                $absPath    = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);


                // Relevantes TypoScript auslesen
                if($typoScriptFile=="setup.ts") {
                    $typoScript = $result['setup'];
                }
                else if($typoScriptFile=="constants.ts") {
                    $typoScript = $result['constants'];
                }
                else if($typoScriptFile=="tsConfig.ts") {
                    $typoScript = $result['tsConfig'];
                }


                // Versuche Datei zu aktualisieren
                \CodingMs\Ftm\Service\Backup::backupFile($fluidTemplate, $absPath);
                if(!file_put_contents($absPath, $typoScript)) {
                    
                    $headline = 'TypoScript wurde re-/generiert!';
                    $message  = 'Das '.$typoScriptFile.' TypoScript für dieses FTM-Template wurde re-/generiert, konnte aber nicht in der setup.ts abgespeichert werden.<br />';
                    $message .= 'Bitte prüfen die Datei/Pfad auf Korrektheit und Schreibrechte: '.$absPath;
                    $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
                    
                }
                else {
                    
                    // MD5-Hash merken
                    if($typoScriptFile=="setup.ts") {
                        $fluidTemplate->setMd5HashSetupTs(md5($typoScript));
                    }
                    else if($typoScriptFile=="constants.ts") {
                        $fluidTemplate->setMd5HashConstantsTs(md5($typoScript));
                    }
                    else if($typoScriptFile=="tsConfig.ts") {
                        $fluidTemplate->setMd5HashTsConfig(md5($typoScript));
                    }
                    
                    $this->flashMessageContainer->add('Das '.$typoScriptFile.' TypoScript für dieses FTM-Template wurde re-/generiert.', 'TypoScript wurde re-/generiert!', \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
                }
            }
        }

        return false;
    }
    
  

   
    
}

?>