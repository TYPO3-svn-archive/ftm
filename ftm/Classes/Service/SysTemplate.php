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
 * Managed alle Aktionen mit dem Sys-Template
 *
 * @package ftm
 * @subpackage Service
 */
class SysTemplate {

    /**
     * Pages Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\PagesRepository
     */
    protected $pagesRepository;

    /**
     * Sys-Template Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\SysTemplateRepository
     */
    protected $sysTemplateRepository;

    /**
     * Persistence-manager
     *
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     */
    protected $persistenceManager;

    /**
     * injectPagesRepository
     *
     * @param \CodingMs\Ftm\Domain\Repository\PagesRepository $pagesRepository
     * @return void
     */
    public function injectPagesRepository(\CodingMs\Ftm\Domain\Repository\PagesRepository $pagesRepository) {
        $this->pagesRepository = $pagesRepository;
    }

    /**
     * injectSysTemplateRepository
     *
     * @param \CodingMs\Ftm\Domain\Repository\SysTemplateRepository $sysTemplateRepository
     * @return void
     */
    public function injectSysTemplateRepository(\CodingMs\Ftm\Domain\Repository\SysTemplateRepository $sysTemplateRepository) {
        $this->sysTemplateRepository = $sysTemplateRepository;
    }

    /**
     * injectPersistenceManager
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager $persistenceManager
     * @return void
     */
    public function injectPersistenceManager(\TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager $persistenceManager) {
        $this->persistenceManager = $persistenceManager;
    }
    
    /**
     * Prueft ob das Sys-Template vorhanden ist, und
     * generiert es ggf. neu
     * Dies machen wir ohne Repository, weil wir noch nicht
     * mappen koennen.
     *
     * @author     Thomas Deuling <typo3@coding.ms>
     * @param      integer $pid Page-ID des Templates
     * @since      22.11.2013
     */
    public function checkSysTemplate($pid) {
        return "alreadyExist";
        
        /**
         * @ToDo: Hier muss auch geprueft werden ob ein fremdes Root-Template auf dieser Seite liegt!
         */
        
        // Template auslesen
        $result = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
            '*',
            'sys_template',
            'pid='.((int)$pid).' AND root=1 AND deleted=0 AND hidden=0',
            '',
            ''
        );
        
        
        // Template in Result!?
        $found = FALSE;
        $foundVersion = '';
        if($result) {
            
            // Alle gefundenen Template pruefen
            while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)) {

                // Schauen ob es ein FTM Sys-Template ist
                $titleParts = explode(" - ", $row["title"]);
                
                if(!empty($titleParts)) {
                    if(substr($titleParts[0], 0, 3)=='FTM') {
                        
                        // Merken das es ein FTM Sys-Template ist
                        // aber nur wenn noch keins gefunden wurde
                        if(!$found) {
                            $found = TRUE;
                            $foundRow = $row;
                            $foundVersion = trim(str_replace("FTM", "", $titleParts[0]));
                        }
                        else {
                            return "error";
                        }
                        
                    }
                }
                else {
                    return "error";
                }

            }
        }
        

        // Es gibt noch kein Template
        if(!$found) {
                
            // Erstellen wir eins
            $sysTemplateData = array();
            $sysTemplateData['pid']   = (int)$pid;
            $sysTemplateData['root']  = 1;
            $sysTemplateData['clear'] = 3;
            $sysTemplateData['title'] = 'FTM '.FTM_VERSION.' - Root-Template (Dont change this name!)';
            
            $includeStatics = array();
            $includeStatics[] = "EXT:css_styled_content/static/";
            $includeStatics[] = "EXT:ftm/Configuration/TypoScript";
            $includeStatics[] = "EXT:static_info_tables/static/static_info_tables/";
            $includeStatics[] = "EXT:gridelements/Configuration/TypoScript/";
            
            
            
            $sysTemplateData['include_static_file'] = implode(',', $includeStatics);
                                
            $res = $GLOBALS['TYPO3_DB']->exec_INSERTquery('sys_template', $sysTemplateData);
                        
            return "created";
        }

        // Template muss aktualisiert werden
        else if($foundVersion!=FTM_VERSION) {
            
            
            // Template auslesen
            $rootTemplate = $this->sysTemplateRepository->findOneRootTemplateByPidAndVersion($pid, $foundVersion);
            
            
            // Pruefen ob es ein Template gibt
            if($rootTemplate instanceof \CodingMs\Ftm\Domain\Model\SysTemplate) {
                    
                $rootTemplate->setTitle("FTM ".FTM_VERSION." - Root-Template (Dont change this name!)");
                //$sysTemplateData = $this->updateTypoScript($foundVersion, FTM_VERSION, $foundRow);
            
                // Aenderungen speichern
                $this->sysTemplateRepository->update($rootTemplate);
                
                // und persistieren
                $this->persistenceManager->persistAll();
                
                return "updated";
            }
            
        }
        
        return "alreadyExist";
    }
    
    /**
     * Setzt das Template-Verzeichnis
     *
     * @author     Thomas Deuling <typo3@coding.ms>
     * @param      integer $pid Page-ID des Templates
     * @param      string $templateDir Template-Verzeichnis des Templates
     * @since      22.11.2013
     */
    public function setTemplateDir($pid, $templateDir) {
        return array('ok'=>array(), 'error'=>array());
        
        // Template auslesen
        $rootTemplate = $this->sysTemplateRepository->findOneRootTemplateByPidAndVersion($pid, FTM_VERSION);
        
        
        // Pruefen ob es ein Template gibt
        if($rootTemplate instanceof \CodingMs\Ftm\Domain\Model\SysTemplate) {

            /**
             * @TODO: pruefen ob es das Verzeichnis wirklich gibt
             */
            
            
            /**
             * @ToDo: Hier muss auch geprueft werden ob schon TS/Konstanten enthalten sind
             * wenn ja muss versucht werden diese zu erhalten!
             */
            
            $relPath = \CodingMs\Ftm\Utility\Tools::getDirectory("TypoScript", $templateDir);
            $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
            $setupTsFile       = "setup.ts";
            $setupCustomTsFile = "setupCustom.ts";
            $constantsTsFile       = "constants.ts";
            $constantsCustomTsFile = "constantsCustom.ts";
            

            // NICHT MEHR SETZEN!!!
//            // Setup erstellen
//            $setup = "### FTM-START ###\n";
//            $setup.= "### Don't change this includes!\n";
//            $setup.= "### Please use the setupCustom.ts for adding own TypoScript.\n";
//            $setup.= "<INCLUDE_TYPOSCRIPT: source=\"FILE:".$relPath.$setupTsFile."\">\n";
//            $setup.= "<INCLUDE_TYPOSCRIPT: source=\"FILE:".$relPath.$setupCustomTsFile."\">\n";
//            $setup.= "### FTM-END ###\n";
//            $rootTemplate->setConfig($setup);
//
//            // Constants erstellen
//            $constants = "### FTM-START ###\n";
//            $constants.= "### Don't change this includes!\n";
//            $constants.= "### Please use the constantsCustom.ts for adding own constants.\n";
//            $constants.= "<INCLUDE_TYPOSCRIPT: source=\"FILE:".$relPath.$constantsTsFile."\">\n";
//            $constants.= "<INCLUDE_TYPOSCRIPT: source=\"FILE:".$relPath.$constantsCustomTsFile."\">\n";
//            $constants.= "### FTM-END ###\n";
//            $rootTemplate->setConstants($constants);
         
        
            // FTM-Seite bearbeiten
            // -------------------------------------------------
            $ftmPage = $this->pagesRepository->findOneByUid($pid);
            
            $tsConfigFile       = "tsConfig.ts";
            $tsConfigCustomFile = "tsConfigCustom.ts";
            
            // TS-Config erstellen 
            $tsConfig = "### FTM-START ###\n";
            $tsConfig.= "### Don't change this includes!\n";
            $tsConfig.= "### Please use the tsConfigCustom.ts for adding own TypoScript.\n";
            $tsConfig.= "<INCLUDE_TYPOSCRIPT: source=\"FILE:".$relPath.$tsConfigFile."\">\n";
            $tsConfig.= "<INCLUDE_TYPOSCRIPT: source=\"FILE:".$relPath.$tsConfigCustomFile."\">\n";
            $tsConfig.= "### FTM-END ###\n";
            $ftmPage->setTsConfig($tsConfig);
            // -------------------------------------------------
        
        
            // Aenderungen speichern
            $this->pagesRepository->update($ftmPage);
            $this->sysTemplateRepository->update($rootTemplate);
                      
            // und persistieren
            $this->persistenceManager->persistAll();
            
            
            $messagesOk = '';
            $messagesError = '';
            
            
            // TypoScript Dateien erstellen,
            // falls noch nicht vorhanden
            if(!file_exists($absPath.$setupTsFile)) {
                if(!file_put_contents($absPath.$setupTsFile, "")) {
                    $messagesOk.= $setupTsFile." wurde erstellt!<br/>\n";
                    chmod($absPath.$setupTsFile, 0777);
                }
                else {
                    $messagesError.= $absPath.$setupTsFile." konnte nicht erstellt werden!<br/>\n";
                }
            }
            if(!file_exists($absPath.$setupCustomTsFile)) {
                if(!file_put_contents($absPath.$setupCustomTsFile, "")) {
                    $messagesOk.= $setupCustomTsFile." wurde erstellt!<br/>\n";
                    chmod($absPath.$setupCustomTsFile, 0777);
                }
                else {
                    $messagesError.= $absPath.$setupCustomTsFile." konnte nicht erstellt werden!<br/>\n";
                }
            }
            if(!file_exists($absPath.$constantsTsFile)) {
                if(!file_put_contents($absPath.$constantsTsFile, "")) {
                    $messagesOk.= $constantsTsFile." wurde erstellt!<br/>\n";
                    chmod($absPath.$constantsTsFile, 0777);
                }
                else {
                    $messagesError.= $absPath.$constantsTsFile." konnte nicht erstellt werden!<br/>\n";
                }
            }
            if(!file_exists($absPath.$constantsCustomTsFile)) {
                if(!file_put_contents($absPath.$constantsCustomTsFile, "")) {
                    $messagesOk.= $constantsCustomTsFile." wurde erstellt!<br/>\n";
                    chmod($absPath.$constantsCustomTsFile, 0777);
                }
                else {
                    $messagesError.= $absPath.$constantsCustomTsFile." konnte nicht erstellt werden!<br/>\n";
                }
            }
            if(!file_exists($absPath.$tsConfigFile)) {
                if(!file_put_contents($absPath.$tsConfigFile, "")) {
                    $messagesOk.= $tsConfigFile." wurde erstellt!<br/>\n";
                    chmod($absPath.$tsConfigFile, 0777);
                }
                else {
                    $messagesError.= $absPath.$tsConfigFile." konnte nicht erstellt werden!<br/>\n";
                }
            }
            if(!file_exists($absPath.$tsConfigCustomFile)) {
                if(!file_put_contents($absPath.$tsConfigCustomFile, "")) {
                    $messagesOk.= $tsConfigCustomFile." wurde erstellt!<br/>\n";
                    chmod($absPath.$tsConfigCustomFile, 0777);
                }
                else {
                    $messagesError.= $absPath.$tsConfigCustomFile." konnte nicht erstellt werden!<br/>\n";
                }
            }
            
            return array('ok'=>$messagesOk, 'error'=>$messagesError);
        }
        
         return array();
    }

}

?>
