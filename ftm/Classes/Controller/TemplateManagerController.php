<?php
namespace CodingMs\Ftm\Controller;

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
class TemplateManagerController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     * Page-Id auf der das FTM-Template liegt
     *
     * @var integer
     */
    protected $pid = 0;

    /**
     * Template Model
     *
     * @var \CodingMs\Ftm\Domain\Model\Template
     */
    protected $fluidTemplate = NULL;

    /**
     * Template Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\TemplateRepository
     */
    protected $fluidTemplateRepository;

    /**
     * Template-Marker Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\TemplateMarkerRepository
     */
    protected $fluidTemplateMarkerRepository;

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
     * Fluid-Service
     *
     * @var \CodingMs\Ftm\Service\Fluid
     */
    protected $fluidService;

    /**
     * Pages-Service
     *
     * @var \CodingMs\Ftm\Service\Pages
     */
    protected $pagesService;

    /**
     * TemplateStructure-Service
     *
     * @var \CodingMs\Ftm\Service\TemplateStructure
     */
    protected $templateStructureService;
    
    /**
     * Extension-Konfiguration
     *
     * @var array
     */
    protected $extConf;

    /**
     * TYPO3-Version
     * @var float
     */
    protected $typo3Version = 0.0;

    /**
     * Debugging
     * @var string
     */
    protected $debug = "";

    /**
     * SysTemplate-Service
     *
     * @var \CodingMs\Ftm\Service\SysTemplate
     */
    protected $sysTemplateService;

    /**
     * Session-Handler
     *
     * @var \CodingMs\Ftm\Domain\Session\SessionHandler
     */
    protected $sessionHandler = null;

    /**
     * injectTemplateRepository
     *
     * @param \CodingMs\Ftm\Domain\Repository\TemplateRepository $fluidTemplateRepository
     * @return void
     */
    public function injectTemplateRepository(\CodingMs\Ftm\Domain\Repository\TemplateRepository $fluidTemplateRepository) {
        $this->fluidTemplateRepository = $fluidTemplateRepository;
    }

    /**
     * injectTemplateMarkerRepository
     *
     * @param \CodingMs\Ftm\Domain\Repository\TemplateMarkerRepository $fluidTemplateMarkerRepository
     * @return void
     */
    public function injectTemplateMarkerRepository(\CodingMs\Ftm\Domain\Repository\TemplateMarkerRepository $fluidTemplateMarkerRepository) {
        $this->fluidTemplateMarkerRepository = $fluidTemplateMarkerRepository;
    }

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
     * injectFluidService
     *
     * @param \CodingMs\Ftm\Service\Fluid $fluidService
     * @return void
     */
    public function injectFluidService(\CodingMs\Ftm\Service\Fluid $fluidService) {
        $this->fluidService = $fluidService;
    }

    /**
     * injectPagesService
     *
     * @param \CodingMs\Ftm\Service\Pages $pagesService
     * @return void
     */
    public function injectPagesService(\CodingMs\Ftm\Service\Pages $pagesService) {
        $this->pagesService = $pagesService;
    }

    /**
     * injectSysTemplate
     *
     * @param \CodingMs\Ftm\Service\SysTemplate $sysTemplateService
     * @return void
     */
    public function injectSysTemplate(\CodingMs\Ftm\Service\SysTemplate $sysTemplateService) {
        $this->sysTemplateService = $sysTemplateService;
    }
    
    /**
     * Action initialisieren
     * Wird immer aufgerufen wenn irgendeine Action ausgefuehrt wird
     */
    public function initializeAction() {
        
        // Sicherstellen das hier nur ein Admin arbeitet!
        if(!$GLOBALS['BE_USER']->isAdmin()) {
            throw new \Exception("Admin-Authorisation required", 1);
        }
        
        
        $this->typo3Version = \CodingMs\Ftm\Utility\Tools::getTypo3Version();
        
        // Extension-Konfiguration auslesen
        $this->extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['ftm']);
        $this->validateExtConf();
        
        // Aktuelle Page auslesen
        $this->pid = intval($_GET['id']);
        if($this->pid==0) {
            if($this->typo3Version>=6) {
                die("Please select a first-level page in order to create or edit a FTM-Template.");
            }
            else {
                $this->flashMessageContainer->add("Please select a first-level page in order to create or edit a FTM-Template.", 'Please select a page!', \TYPO3\CMS\Core\Messaging\FlashMessage::WARNING);
            }
            return;
        }
        
            
    
        // Fluid Template auslesen, falls noch nicht geschehen
        if(!($this->fluidTemplate instanceof \CodingMs\Ftm\Domain\Model\Template)) {
            
            /**
             * @var \CodingMs\Ftm\Domain\Model\Template
             */
            $this->fluidTemplate = $this->getTemplate();
            
            
            // Strukture-Service
            if($this->fluidTemplate instanceof \CodingMs\Ftm\Domain\Model\Template) {
                if($this->fluidTemplate->getTemplateType()=='yaml') {
                    $this->templateStructureService = $this->objectManager->create('CodingMs\Ftm\Service\TemplateStructureYaml');
                }
                elseif($this->fluidTemplate->getTemplateType()=='bootstrap') {
                    $this->templateStructureService = $this->objectManager->create('CodingMs\Ftm\Service\TemplateStructureBootstrap');
                }
                else {
                    $this->templateStructureService = $this->objectManager->create('CodingMs\Ftm\Service\TemplateStructure');
                }
            }
            
        }
        
        // SysTemplate-Service erstellen, falls noch nicht geschehen
        if(!($this->sysTemplateService instanceof \CodingMs\Ftm\Service\SysTemplate)) {
            $this->sysTemplateService = $this->objectManager->create('CodingMs\Ftm\Service\SysTemplate');
        }
        
        // Fluid-Service erstellen, falls noch nicht geschehen
        if(!($this->fluidService instanceof \CodingMs\Ftm\Service\Fluid)) {
            $this->fluidService = $this->objectManager->create('CodingMs\Ftm\Service\Fluid');
        }
        
        // Pages-Service erstellen, falls noch nicht geschehen
        if(!($this->pagesService instanceof \CodingMs\Ftm\Service\Pages)) {
            $this->pagesService = $this->objectManager->create('CodingMs\Ftm\Service\Pages');
        }
               
        
        // PluginCloud-Service initiieren
        $this->pluginService = $this->objectManager->create(
            'CodingMs\Ftm\Service\PluginService', 
            $this->extConf['pluginCloudHost'],
            $this->extConf['pcKey'],
            $this->extConf['user'],
            $this->extConf['password']
        );
        
    }
    

    /**
     * action list
     *
     * @return void
     */
    public function listAction() {
        
        
        // Auf Root-Seite nichts machen
        // Meldung wurde bereits in initializeAction generiert
        if($this->pid==0) {
            return;
        }
        
        
        $this->checkRequiredExtenstions();
        
        // Preufen ob Updates verfuegbar sind
        $updateMessage = \CodingMs\Ftm\Service\Updates::check('ftm', explode('.', FTM_VERSION));
        if(is_string($updateMessage)) {
            $this->flashMessageContainer->add($updateMessage, \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.ftm_update_available", "Ftm"), \TYPO3\CMS\Core\Messaging\FlashMessage::WARNING);
        } //'FTM Update verfügbar!'

       
        $buttons = array();
        $options = array();
        $options['ftmVersion'] = FTM_VERSION;
        $options['pid']        = $this->pid;
        $options['wikiUrl']    = 'http://fluid-template-manager.de/documentation/';
        $options['twitterUrl'] = 'http://if-20.com/iframes/IF-20-Twitter-Stream/';
        $options['disclaimerNotAccepted'] = true;
        
        
        // Pruefen ob es auf der aktuelle Seite schon ein
        // Template-Datensatz gibt
        if($this->fluidTemplate===null) {
            $options['templateOnCurrentPage'] = false;
            
            /**
             * @ToDo: Hier muss geprueft werden, ob ein Template auf einer
             * hoeheren Ebene/Seite existiert!
             * Ein neues Template zu erstellen sollte dann verboten werden!
             */
            $this->debug.="no template on this pid: ".$this->pid."<br>";
           
        }
        else {
            
            // Merken das es ein Template gibt
            // und pruefen ob Meldung noch angezeigt wird
            // -------------------------------------------------
            $options['templateOnCurrentPage'] = true;
            $options['disclaimerNotAccepted'] = !$this->fluidTemplate->isDisclaimerAccepted();
            $this->debug.="template on this pid: ".$this->pid."<br>";
        
        
            // Buttons im Header
            // -------------------------------------------------
            $buttons = $this->getButtons($this->fluidTemplate->getConfig()->getBaseUrl());
            
            
            // Pruefen ob das Sys-Template vorhanden ist
            // und erstellt es ggf.
            // -------------------------------------------------
            $sysTemplateStatus = $this->sysTemplateService->checkSysTemplate($this->pid);
            if($sysTemplateStatus=='error') {
                $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.ftm_root_template_error_headline", "Ftm"); //FTM Root-Template Fehler!
                $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.ftm_root_template_error_message1", "Ftm") . '<br />'; //Es wurde ein Problem mit dem Root-Template auf dieser Seite festgestellt!
                $message .= \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.ftm_root_template_error_message2", "Ftm"); //Bitte stellen Sie sicher das es nur ein Root-Template auf dieser Seite gibt!
                $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
            }
            else if($sysTemplateStatus=='updated') {
                $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.ftm_root_template_update_headline", "Ftm"); //FTM Root-Template aktualisiert!
                $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.ftm_root_template_update_message", "Ftm"); //Das FTM Root-Template auf dieser Seite wurde aktualisiert!
                $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
                
                // Seite neu laden
                $this->redirect('list', 'TemplateManager', NULL, array());
            }
            else if($sysTemplateStatus=='created') {
                
                $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.ftm_root_template_generated_headline", "Ftm"); //FTM Root-Template erstellt!
                $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.ftm_root_template_generated_message", "Ftm"); //Es wurde ein FTM Root-Template auf dieser Seite erstellt!
                $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
                
                // Seite neu laden
                $this->redirect('list', 'TemplateManager', NULL, array());
            }
            // -------------------------------------------------
            
            
            
            // Sys-Template gefunden
            // -------------------------------------------------
            else if($sysTemplateStatus=='alreadyExist') {
                
                
                // Hash neu setzen um zu identifizieren ob 
                // sich die Konfiguration geaendert hat
                $templateDataArray = $this->getTemplateDataArray();
                $this->fluidTemplate->setMd5HashTemplateData(md5(serialize($templateDataArray)));
                $this->fluidTemplateRepository->update($this->fluidTemplate);
                
                
                // Template-Verzeichnis bereits vorhanden
                $templateName = $this->fluidTemplate->getTemplateDir();
                if($templateName!="") {
            
            
                    // Pruefen ob die erforderlichen Pages vorhanden
                    // sind und erstelle Sie ggf.
                    // -------------------------------------------------
                    $pagesMessages = $this->pagesService->checkPages($this->pid);
                    
                    // Meldungen von erstellten Seiten ausgeben
                    if(trim($pagesMessages)!="" && $pagesMessages!==true) {
                        $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.ftm_pages_generated_headline", "Ftm"); //FTM Seiten erstellt!
                        $this->flashMessageContainer->add($pagesMessages, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
                    }
                    // -------------------------------------------------
                    
                    
                    
                    // Pruefen ob die Template-Verzeichnisstruktur
                    // vorhanden und korrekt ist
                    // -------------------------------------------------
                    $directoryCheck = \CodingMs\Ftm\Service\TemplateDirectory::checkDirectories($templateName);
                    if($directoryCheck===true) {
                        $this->debug.= "directory check: true<br>";
                    }
                    else {
                        if(!empty($directoryCreate)) {
                            foreach($directoryCreate as $directory => $description) {
                                $this->debug.= "directory '".$directory."' not found<br>";
                            }
                        }
                    }
                    
                    $directoryCreate = \CodingMs\Ftm\Service\TemplateDirectory::createDirectories($templateName);
                    if($directoryCreate===true) {
                        $this->debug.= "directory create: true<br>";
                    }
                    else {
                        if(!empty($directoryCreate)) {
                            foreach($directoryCreate as $directory => $description) {
                                $this->debug.= "couldnt create directory '".$directory."'. Please check permissions for directory /typo3conf/ext/".$templateName."/<br>";
                            }
                        }
                    }
                    // -------------------------------------------------
                    
                    
                    
                    // Template-Dir ggf nochmal in Sys-
                    // Template etc. setzen/aktualisieren
                    // -------------------------------------------------
                    $options['templateDirFound'] = true;
                    $this->setTemplateDir($templateName);
                    // -------------------------------------------------
                    
                    
                    
                    // Template Strukture pruefen
                    // -------------------------------------------------
                    if($this->templateStructureService->checkStructure($this->pid, $this->fluidTemplate)) {
                        // checkStructure returns true wenn etwas erstellt wurde
                        
                        $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.ftm_template_structure_generated_headline", "Ftm"); //FTM Template-Struktur erstellt!
                        $messages = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.ftm_template_structure_generated_message", "Ftm"); //FTM Template-Struktur wurde erstellt bzw. aktualisiert.
                        $this->flashMessageContainer->add($messages, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
                        
                        // daher nochmal ein Redirect
                        $this->redirect('list', 'TemplateManager', NULL, array());
                    }
                    
                    
                    
                    // Pruefen ob alle Fluid-Templates vorhanden sind
                    // -------------------------------------------------
                    $tempMessages = "";
                    // Pruefen ob alle Layout-Datensaetze vorhanden sind
                    $fluidLayoutFiles   = $this->fluidService->checkFiles($this->fluidTemplate, 'layout');
                    if($fluidLayoutFiles===true) {
                        $this->debug.= "fluid layout files: true<br>";
                    }
                    else {
                        $tempMessages.= $this->fluidService->createFiles($this->fluidTemplate, 'layout', $fluidLayoutFiles);
                    }
                    
                    // Pruefen ob alle Partial-Datensaetze vorhanden sind
                    $fluidPartialFiles  = $this->fluidService->checkFiles($this->fluidTemplate, 'partial');
                    if($fluidPartialFiles===true) {
                        $this->debug.= "fluid partial files: true<br>";
                    }
                    else {
                        $tempMessages.= $this->fluidService->createFiles($this->fluidTemplate, 'partial', $fluidPartialFiles);
                    }
                    
                    // Pruefen ob alle Template-Datensaetze vorhanden sind
                    $fluidTemplateFiles = $this->fluidService->checkFiles($this->fluidTemplate, 'template');
                    if($fluidTemplateFiles===true) {
                        $this->debug.= "fluid template files: true<br>";
                    }
                    else {
                        $tempMessages.= $this->fluidService->createFiles($this->fluidTemplate, 'template', $fluidTemplateFiles);
                    }
                    
                    // Meldungen von erstellten Templates ausgeben
                    if(trim($tempMessages)!="") {
                        $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.fluid_templates_generated_headline", "Ftm"); //Fluid-Templates erstellt!
                        $this->flashMessageContainer->add($tempMessages, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
                        
                        // Seite neu laden
                        $this->redirect('list', 'TemplateManager', NULL, array());
                    }
                    // -------------------------------------------------
                    
                    
                }


                // -------------------------------------------------
                // Template-Verzeichnis wurde noch nicht
                // im FTM-Template angegeben
                else {
                    
                    $options['templateDirFound'] = false;
                    
                    $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.warning_no_template_dir_found_headline", "Ftm"); //Kein Template-Verzeichnis gefunden!
                    $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.warning_no_template_dir_found_message1", "Ftm") . '<br />'; //In diesem FTM-Template ist noch kein Template-Verzeichnis eingetragen worden.
                    $message .= \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.warning_no_template_dir_found_message2", "Ftm") . '<br />'; //Bitte editieren Sie den Template-Datensatz, und geben Sie im Feld templateDir den Namen des Verzeichnisses an in dem Ihre Template erstellt werden soll.
                    $message .= \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.warning_no_template_dir_found_message3", "Ftm"); //Sobald das FTM-Template ein Template-Verzeichnis beinhaltet, wird die benötigte Verzeichnisstruktur gecheckt und ggf. erstellt!.
                    $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::WARNING);
                }
            }
            
        }
        

        // Template befuellen
        $this->view->assign('buttons', $buttons);
        $this->view->assign('debug',   $this->debug);
        $this->view->assign('doDebug', false);
        $this->view->assign('options', $options);
        $this->view->assign('fluidTemplate', $this->fluidTemplate);
    }
    
    /**
     * Merkt sich das die Warnungen gelesen wurden!
     */
    public function acceptDisclaimerAction() {
        
        // Parameter auswerten
        if($this->request->hasArgument('acceptDisclaimer')) {
            $acceptDisclaimer = $this->request->getArgument('acceptDisclaimer');
            if($acceptDisclaimer=='true') {
                $this->fluidTemplate->setDisclaimerAccepted(true);
                $this->fluidTemplateRepository->update($this->fluidTemplate);
            }
        }

        $this->redirect('list', 'TemplateManager', NULL, array());
    }
        
    /**
     * Prueft ob es fuer diese Seite schon ein Template-Object
     * gibt, wenn nicht wird eins erstellt
     *
     * @return \CodingMs\Ftm\Domain\Model\Template
     */
    protected function getTemplate() {
        
        
        // Template auslesen, falls vorhanden
        $fluidTemplate = $this->fluidTemplateRepository->findOneByPid($this->pid);
        
        
        $this->debug.= "read fluidTemplate on pid:".$this->pid." -> ".get_class($fluidTemplate)."<br>";
        
        // Wenn es noch keinen gibt, erstelle einen
        if(!($fluidTemplate instanceof \CodingMs\Ftm\Domain\Model\Template)) {

            $this->debug.= "create fluidTemplate on pid:".$this->pid."<br>";

            
            /**
             * @ToDo: Hier sollte geschaut werden ob auf 
             * Eltern-Seiten ein Template existiert
             */
            
            // Template speichern
            // $this->fluidTemplateRepository->add($fluidTemplate);
            return null;
        }
        
        return $fluidTemplate;
    }

    
    /**
     * Erstellt die Less-Variablen Datei zu einem FTM-Template
     *
     * @author Thomas Deuling <typo3@coding.ms>
     * @return void
     * @since 1.0.0
     */
    public function generateLessVariableAction() {
        
        // Pruefen ob FTM-Template vorhanden
        if(!($this->fluidTemplate instanceof \CodingMs\Ftm\Domain\Model\Template)) {
            $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_generated_headline", "Ftm"); //Less-Variablen nicht re-/generiert!
            $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_generated_message", "Ftm"); //Die Less-Variablen konnte re-/generiert werden, da auf dieser Seite anscheinen noch kein FTM-Template existiert.
            $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
        }
        
        else {
            
            // Less-Variablen ueber Web-Service generieren            
            $result = $this->pluginService->executeAction("generateLessVariable", $this->fluidTemplate->toArray());
            
            if($result['status']=='success') {
                
                $filepath = \CodingMs\Ftm\Utility\Tools::getDirectory("LessBasic", $this->fluidTemplate->getTemplateDir());
                $filename = "4_variables.less";
                $relPath = $filepath.$filename;
                
                $absPath   = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
                $touchPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($filepath);
                
                $defaults = "/* FTM - Less-Defaults: */\n";
                $defaults.= "@baseUrl         = \"".$this->fluidTemplate->getConfig()->getBaseUrl()."\";\n";
                $defaults.= "@baseUrlTemplate = \"".$this->fluidTemplate->getConfig()->getBaseUrl()."typo3conf/ext/".$this->fluidTemplate->getTemplateDir()."/\";\n";
                $defaults.= "@templateDir    = \"".$this->fluidTemplate->getTemplateDir()."\";\n";
                $defaults.= "\n";
                $defaults.= "/* FTM - Less-Customs: */\n";
                
                // Versuche Datei zu aktualisieren
                \CodingMs\Ftm\Service\Backup::backupFile($this->fluidTemplate, $absPath);
                if(!file_put_contents($absPath, $defaults.$result['lessVariable'])) {
                    $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_saved_headline", "Ftm"); //Less-Variablen wurden re-/generiert!
                    $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_saved_message1", "Ftm") . '<br />'; //Die Less-Variablen für dieses FTM-Template wurde re-/generiert, konnte aber nicht in der ..less/0_basicLess/4_variables.less abgespeichert werden.
                    $message .= \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_saved_message2", "Ftm", array($absPath)); //Bitte prüfen die Datei/Pfad auf Korrektheit und Schreibrechte: $absPath
                    $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
                }
                else {
                    $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.less_variables_generated_headline", "Ftm"); //Less-Variablen wurden re-/generiert!
                    $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.less_variables_generated_message", "Ftm"); //Die Less-Variablen für dieses FTM-Template wurde re-/generiert.
                    $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
                }
            }
            else {
                $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_generated_headline", "Ftm"); //Less-Variablen nicht re-/generiert!
                $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_generated_message1", "Ftm") . '<br />'; //Die Less-Variablen konnte re-/generiert werden, es gab einen Fehler beim Aufruf des Generierungs-WebServices.
                $message .= \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_generated_message2", "Ftm"); //Bitte versuchen Sie es später noch einmal. Sollte der Fehler erneut auftreten kontaktieren Sie das Entwicklungs-Team.
                $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
            }
            
            
        }
        
        
        $this->redirect('list', 'TemplateManager', NULL, array());
    }

    
    /**
     * Merkt sich einen Marker in der PluginCloud
     *
     * @author Thomas Deuling <typo3@coding.ms>
     * @param \CodingMs\Ftm\Domain\Model\TemplateMarker $marker
     * @return void
     * @since 1.0.4
     */
    public function saveMarkerAction(\CodingMs\Ftm\Domain\Model\TemplateMarker $marker) {
        
        // Infos fuer WebService ermitteln
        $data = $marker->toArray();
        $data['typo3Version'] = $typo3Version;
        // $data['templateDir'] = $this->fluidTemplate->getTemplateDir();
        // $data['baseUrl']      = $this->fluidTemplate->config->getBaseURL();
        $data['ftmVersion']   = FTM_VERSION;
        
        $result = $this->pluginService->executeAction("saveMarker", $data);
        
        if($result['status']=='success') {
            
            
             // Pfad ermitteln
            $typoScript = "";
            $messageOk  = "";
            $filepath   = "uploads/tx_ftm/";
            $relPath    = $filepath;
            $absPath   = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);


            // Marker schreiben
            $markerFile       = "marker.serialized";
            $markerSerialized = $result['marker'];
            
            
            \CodingMs\Ftm\Service\Backup::backupFile($this->fluidTemplate, $absPath.$markerFile);
            if(!file_put_contents($absPath.$markerFile, $markerSerialized)) {
                $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_headline", "Ftm"); //Snippets wurden ausgelesen!
                $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_message1", "Ftm", array($markerFile)). '<br />'; //Die Marker Snippets wurden ausgelesen, konnten aber nicht in der $markerFile abgespeichert werden.
                $message .= \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_message2", "Ftm", array($absPath.$markerFile)); //Bitte prüfe die Datei/Pfad auf Korrektheit und Schreibrechte: $absPath.$markerFile
                $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
            }
            
            $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.marker_saved_headline", "Ftm"); //Marker wurde gemerkt!
            $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.marker_saved_message", "Ftm", array($marker->getMarkerName())); // Marker $marker->getMarkerName() wurde in PluginCloud gemerkt.
            $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
        }
        else {
            $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_marker_not_saved_headline", "Ftm"); //Marker nicht gemerkt!
            $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_marker_not_saved_message", "Ftm", array($marker->getMarkerName())); //Marker $marker->getMarkerName() konnte nicht in der PluginCloud gemerkt werden.
            $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
        }
        
        $this->redirect('list', 'TemplateManager', NULL, array());
    }

    
    /**
     * Setzt einen Marker aus der PluginCloud ein
     *
     * @author Thomas Deuling <typo3@coding.ms>
     * @param \CodingMs\Ftm\Domain\Model\TemplateMarker $marker
     * @param string $markerName
     * @return void
     * @since 1.0.4
     */
    public function insertMarkerAction(\CodingMs\Ftm\Domain\Model\TemplateMarker $marker, $markerName) {
        
        $error = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_marker_not_found", "Ftm"); //Der einzufügende Marker konnte nicht gefunden werden.
        
        // Snippets auslesen
        $snippetFolder   = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName("uploads/tx_ftm/");
       
        
        if(@file_exists($snippetFolder)) {
            $markerSerialized = file_get_contents($snippetFolder.'marker.serialized');
            $markerArray = unserialize($markerSerialized);
            
            // Marker-Vorlage suchen
            if(is_array($markerArray) && !empty($markerArray)) {
                foreach($markerArray as $tempMarker) {

                    if($tempMarker['markerName']==$markerName) {
                        
                        $marker->setMarkerName($tempMarker['markerName']);
                        $marker->setMarkerType($tempMarker['markerType']);
                        $marker->setMarkerDescription($tempMarker['markerDescription']);
                        $marker->setMarkerTypoScript($this->removeSlashes($tempMarker['markerTypoScript']));
                        
                        $this->fluidTemplateMarkerRepository->update($marker);
                        
                        $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.marker_included_headline", "Ftm"); //Marker wurde eingefügt!
                        $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.marker_included_message", "Ftm", array($markerName, $marker->getMarkerName())) . '<br />'; //Marker-Vorlage $markerName wurde erfolgreich in Marker $marker->getMarkerName() eingefügt.
                        $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
                    }
                    // else {
                        // echo $tempMarker['markerName']."!=".$markerName."<br/>";
                    // }
                    
                }
            }
            else {
                $error = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_markers_not_synchronized", "Ftm"); //Vorlagen konnten nicht gefunden werden, bitte synchronisieren Sie die Marker.
            }
        }
        else {
            $error = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_markers_not_synchronized", "Ftm");
        }
        
        // var_dump($markerArray);
        // exit;
        
        $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_marker_not_included_headline", "Ftm"); //Marker nicht eingefügt!
        $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_marker_not_included_message", "Ftm", array($markerName, $marker->getMarkerName(), $error)); //Marker-Vorlage $markerName konnte nicht in Marker $marker->getMarkerName() eingefügt werden. $error
        $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
            
        $this->redirect('list', 'TemplateManager', NULL, array());
    }

    protected function removeSlashes($text) {
        $text = str_replace("\\n", "\n", $text);
        $text = str_replace("\\r", "\r", $text);
        $text = str_replace("\\\"", "\"", $text);
        return $text;
    }

    /**
     * Liest alle Snippets (Marker, etc.) aus der PluginCloud
     *
     * @author Thomas Deuling <typo3@coding.ms>
     * @return void
     * @since 1.0.4
     */
    public function loadSnippetsAction() {
        
        // Infos fuer WebService ermitteln
        $data = array();
        $data['typo3Version'] = $this->typo3Version;
        // $data['templateDir'] = $this->fluidTemplate->getTemplateDir();
        // $data['baseUrl']      = $this->fluidTemplate->config->getBaseURL();
        $data['ftmVersion']   = FTM_VERSION;
        
        $result = $this->pluginService->executeAction("loadSnippets", $data);
        
        if($result['status']=='success') {
            
            
             // Pfad ermitteln
            $typoScript = "";
            $messageOk  = "";
            $filepath   = "uploads/tx_ftm/";
            $relPath    = $filepath;
            $absPath    = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);


            // Marker schreiben
            $markerFile       = "marker.serialized";
            $markerSerialized = $result['marker'];
            
            
            \CodingMs\Ftm\Service\Backup::backupFile($this->fluidTemplate, $absPath.$markerFile);
            if(!file_put_contents($absPath.$markerFile, $markerSerialized)) {
                $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_headline", "Ftm"); //Snippets wurden ausgelesen!
                $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_message1", "Ftm", array($markerFile)) . '<br />'; //Die Marker Snippets wurden ausgelesen, konnten aber nicht in der $markerFile abgespeichert werden.
                $message .= \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_message2", "Ftm"); //Bitte prüfe die Datei/Pfad auf Korrektheit und Schreibrechte: $absPath.$markerFile
                $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
            }
            
            
            $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.snippets_read_headline", "Ftm"); //Snippets wurden ausgelesen!
            $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.snippets_read_message", "Ftm"); //Es wurden alle Snippets aus der PluginCloud ausgelesen.
            $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
        }
        else {
            $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_read_headline", "Ftm"); //Snippets nicht ausgelesen!
            $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_read_message", "Ftm"); //Es konnten keine Snippets aus der PluginCloud ausgelesen werden.
            $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
        }
        
        $this->redirect('list', 'TemplateManager', NULL, array());
    }

    /**
     * Erstellt das TypoScript zu einem FTM-Template
     *
     * @param  string $typoScriptFile TypoScript-Datei die generiert werden soll (constants.ts oder setup.ts)
     * @author Thomas Deuling <typo3@coding.ms>
     * @return void
     * @since  1.0.0
     */
    public function generateTypoScriptAction($typoScriptFile) {
        
        
        // Unterstuetzte TypoScript-dateien
        $validFiles = array();
        $validFiles[] = "constants.ts";
        $validFiles[] = "setup.ts";
        $validFiles[] = "tsConfig.ts";
        
        
        // TypoScript-Datei ok!?
        if(!in_array($typoScriptFile, $validFiles)) {
            throw new \Exception("Error - TS '".$typoScriptFile."' file isn't valid", 1);
        }
        
        
        // Pruefen ob FTM-Template vorhanden
        if(!($this->fluidTemplate instanceof \CodingMs\Ftm\Domain\Model\Template)) {
            $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_ftm_template_not_exists_headline", "Ftm"); //TypoScript nicht re-/generiert!
            $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_ftm_template_not_exists_message", "Ftm", array($typoScriptFile)); //Das $typoScriptFile TypoScript konnte nicht re-/generiert werden, da auf dieser Seite anscheinend noch kein FTM-Template existiert.
            $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
            $this->redirect('list', 'TemplateManager', NULL, array());
        }
        
        else {
            
            
            // Benoetigte Daten sammeln
            $dataCheckFailed = false;
            $templateDataArray = $this->getTemplateDataArray();
            
                    
            // Pruefen ob Templates vorhanden sind
            $tempFluid = unserialize($templateDataArray['fluid']);
            if(!is_array($tempFluid) || empty($tempFluid)) {
                $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_fluid_template_not_exists_headline", "Ftm"); //TypoScript nicht re-/generiert!
                $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_fluid_template_not_exists_message", "Ftm", array($typoScriptFile)); //Das $typoScriptFile TypoScript konnte nicht re-/generiert werden, da auf dieser Seite anscheinend noch keine Fluid-Templates existieren.
                $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::WARNING);
                
                $dataCheckFailed = true;
            }

        
            /**
             * @todo:  Pruefen ob in allen Menues ein NO vorhanden ist!!
             */ 
            // $tempFluid = unserialize($templateDataArray['fluid']);
            // if(!is_array($tempFluid) || empty($tempFluid)) {
                // $headline = 'TypoScript nicht re-/generiert!';
                // $message  = 'Das '.$typoScriptFile.' TypoScript konnte nicht re-/generiert werden, da auf dieser Seite anscheinend noch keine Fluid-Templates existieren.';
                // $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::WARNING);
                // $dataCheckFailed = true;
            // }

            /**
             * @todo: hier auch mal die eingebundenen include_statics mitsenden
             * am besten inkl. Versionen um den Generator steuern zu können
             */
            
            // TypoScript generieren
            if(!$dataCheckFailed) {
                         
                $result = $this->pluginService->executeAction("generateTypoScript", $templateDataArray);
                
                
                // Antwort auswerten
                if($result['status']=='success') {
                    
                    
                    // Pfad ermitteln
                    $typoScript = "";
                    $messageOk  = "";
                    $filepath   = \CodingMs\Ftm\Utility\Tools::getDirectory("TypoScript", $this->fluidTemplate->getTemplateDir());
                    $relPath    = $filepath;
                    $absPath    = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
    
    
                    // setup-TypoScript schreiben
                    $typoScriptFile = "setup.ts";
                    $typoScript = $result['setup'];
                    
                    \CodingMs\Ftm\Service\Backup::backupFile($this->fluidTemplate, $absPath.$typoScriptFile);
                    if(!file_put_contents($absPath.$typoScriptFile, $typoScript)) {
                        $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_not_saved_headline", "Ftm"); //TypoScript wurde re-/generiert!
                        $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_not_saved_message1", "Ftm", array($typoScriptFile)) . '<br />'; //Das $typoScriptFile TypoScript für dieses FTM-Template wurde re-/generiert, konnte aber nicht in der setup.ts abgespeichert werden.
                        $message .= \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_not_saved_message2", "Ftm", array($absPath.$typoScriptFile)); //Bitte prüfen die Datei/Pfad auf Korrektheit und Schreibrechte: $absPath.$typoScriptFile
                        $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
                    }
                    else {
                        
                        // MD5-Hash merken
                        $this->fluidTemplate->setMd5HashSetupTs(md5(serialize($templateDataArray)));
                        $messageOk.= \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.typoscript_file_generated", "Ftm", array($typoScriptFile)); //Das $typoScriptFile TypoScript für dieses FTM-Template wurde re-/generiert.
                    }
                    
                        
                    // constants-TypoScript schreiben
                    $typoScriptFile = "constants.ts";
                    $typoScript = $result['constants'];
                    
                    \CodingMs\Ftm\Service\Backup::backupFile($this->fluidTemplate, $absPath.$typoScriptFile);
                    if(!file_put_contents($absPath.$typoScriptFile, $typoScript)) {
                        $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_not_saved_in_constants_headline", "Ftm"); //TypoScript wurde re-/generiert!
                        $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_not_saved_in_constants_message1", "Ftm", array($typoScriptFile)) . '<br />'; //Das $typoScriptFile TypoScript für dieses FTM-Template wurde re-/generiert, konnte aber nicht in der constants.ts abgespeichert werden.
                        $message .= \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_not_saved_in_constants_message2", "Ftm", array($typoScriptFile, $absPath.$typoScriptFile)); //Bitte prüfen die Datei/Pfad auf Korrektheit und Schreibrechte: $absPath.$typoScriptFile
                        $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
                    }
                    else {
                        
                        // MD5-Hash merken
                        $this->fluidTemplate->setMd5HashConstantsTs(md5(serialize($templateDataArray)));
                        $messageOk.= \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.typoscript_file_generated", "Ftm", array($typoScriptFile)); //Das $typoScriptFile TypoScript für dieses FTM-Template wurde re-/generiert.
                    }
                    
                        
                    // tsConfig-TypoScript schreiben
                    $typoScriptFile = "tsConfig.ts";
                    $typoScript = $result['tsConfig'];
                    
                    \CodingMs\Ftm\Service\Backup::backupFile($this->fluidTemplate, $absPath.$typoScriptFile);
                    if(!file_put_contents($absPath.$typoScriptFile, $typoScript)) {
                        $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_not_saved_in_tsconfig_headline", "Ftm"); //TypoScript wurde re-/generiert!
                        $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_not_saved_in_tsconfig_message1", "Ftm", array($typoScriptFile)) . '<br />'; //Das $typoScriptFile TypoScript für dieses FTM-Template wurde re-/generiert, konnte aber nicht in der tsConfig.ts abgespeichert werden.
                        $message .= \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_not_saved_in_tsconfig_message2", "Ftm", array($typoScriptFile)); //Bitte prüfen die Datei/Pfad auf Korrektheit und Schreibrechte: $absPath.$typoScriptFile
                        $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
                    }
                    else {
                        
                        // MD5-Hash merken
                        $this->fluidTemplate->setMd5HashTsConfig(md5(serialize($templateDataArray)));
                        $messageOk.= \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.typoscript_file_generated", "Ftm", array($typoScriptFile)); //Das $typoScriptFile TypoScript für dieses FTM-Template wurde re-/generiert.
                    }
                        
                    
                    // Meldung anzeigen?!
                    if($messageOk!="") {
                        // Template speichern
                        $this->fluidTemplateRepository->update($this->fluidTemplate);
                        $this->flashMessageContainer->add($messageOk, \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.typoscript_generated", "Ftm"), \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
                    }
                   
    
                }
            }
            
            $this->redirect('list', 'TemplateManager', NULL, array());
        }
    }

    /**
     * Template-Model als Array holen
     */
    protected function getTemplateDataArray() {
    
        // Template-Model als Array holen
        $templateDataArray = $this->fluidTemplate->toArray();
        
        
        // Grid-Layouts auslesen, damit TypoScript 
        // dafuer generiert werden kann
        $gridLayouts = $this->gridLayoutRepository->findAllWithoutPid();
        $gridLayoutsArray = array();
        foreach($gridLayouts as $gridLayout) {
            $gridLayoutsArray[$gridLayout->getUid()] = $gridLayout->getTitle();
        }
        $templateDataArray['gridLayouts'] = serialize($gridLayoutsArray);
        
        
        // TYPO3-Version ermitteln
        $templateDataArray['typo3Version'] = $this->typo3Version;
        
        
        return $templateDataArray;
    }


    /**
     * Kopiert eine Fluid-Template-Datei <-> Fluid-Template-Datensatz
     * 
     * Generell wird erstmal immer von DB to File.
     * Wenn also eine Datei nicht existiert, der Datensatz aber, so wird
     * die Datei erstellt.
     *
     * @param  string $templateType Fluid-Typ der kopiert werden soll
     * @param  string $templateFile Fluid-Template das kopiert werden soll
     * @param  string $copy DB to File oder File to DB
     * @return void
     * 
     * @author Thomas Deuling <typo3@coding.ms>
     * @since  1.0.0
     */
    public function generateFluidAction($templateType, $templateFile, $copy="dbToFile") {


        $found = false;
        $temp = "";


        // Template-Datei nur erstellen,
        // wenn es den Datensatz wirklich gibt
        $fluidTemplates = $this->fluidTemplate->getFluid();
        if(!empty($fluidTemplates)) {
            foreach($fluidTemplates as $tempFluid) {
                
                $temp .= $tempFluid->getTemplateType()."==".$templateType." && ".$tempFluid->getTemplateType()."==".$templateFile."<br/ \n>";
                
                if($tempFluid->getTemplateType()==$templateType && $tempFluid->getTemplateFile()==$templateFile) {
                    
                    // Merken das das Template gefunden wurde
                    $found = true;
                    
                    
                    // Dateiname und Pfad
                    $templatePath = \CodingMs\Ftm\Utility\Tools::getDirectory("FluidTemplates", $this->fluidTemplate->getTemplateDir()).ucfirst($templateType)."s/";
                    $filename     = $templateFile.".html";
                    $relPath      = $templatePath.$filename;
                    $absPath      = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
                    
                    
                    // Template-Datei in die DB kopieren
                    if($copy=="fileToDb") {
                        if(file_exists($absPath)) {
                            $code = file_get_contents($absPath);
                            $tempFluid->setTemplateCode($code);
                            
                            // Geaendertes Template speichern
                            $this->fluidTemplateRepository->update($this->fluidTemplate);
                            
                            $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.template_file_copied_headline", "Ftm", array(ucfirst($templateType), ucfirst($templateType))); //Fluid-ucfirst($templateType)-Datei wurde erfolgreich in Fluid-ucfirst($templateType)-Datensatz kopiert!
                            $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.template_file_copied_message", "Ftm", array($templateFile, ucfirst($templateType))); //Die $templateFile.html Fluid-ucfirst($templateType)-Datei wurde erfolgreich kopiert.
                            $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
                        }
                        else {
                            $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_template_file_not_found_headline", "Ftm", array(ucfirst($templateType))); //Fluid-ucfirst($templateType)-Datei konnte nicht kopiert werden!
                            $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_template_file_not_found_message", "Ftm", array($templateFile, ucfirst($templateType))); //Die $templateFile.html Fluid-ucfirst($templateType)-Datei konnte nicht gefunden werden.
                            $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
                        }
                    }
                    
                    // Template-Datei erstellen
                    // bzw. DB-Code in die Datei schreiben
                    else {
                        \CodingMs\Ftm\Service\Backup::backupFile($this->fluidTemplate, $absPath);
                        if(file_put_contents($absPath, $tempFluid->getTemplateCode())) {
                            $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.fluid_datarecord_copied_headline", "Ftm", array(ucfirst($templateType), ucfirst($templateType))); //Fluid-ucfirst($templateType)-Datensatz wurde erfolgreich in Fluid-ucfirst($templateType)-Datei kopiert!
                            $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.fluid_datarecord_copied_message", "Ftm", array($templateFile, ucfirst($templateType))); //Die $templateFile.html Fluid-ucfirst($templateType)-Datei wurde erfolgreich kopiert.
                            $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
                        }
                        else {
                            $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_template_file_not_copied_headline", "Ftm", array(ucfirst($templateType))); //Fluid-ucfirst($templateType)-Datei konnte nicht kopiert werden!
                            $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_template_file_not_copied_message1", "Ftm", array($templateFile, ucfirst($templateType))) . '<br />'; //Die $templateFile.html Fluid-ucfirst($templateType)-Datei konnte nicht kopiert werden.
                            $message .= \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_template_file_not_copied_message2", "Ftm"); //Bitte prüfen Sie den Dateinamen und die Verzeichnisrechte.
                            $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
                        }
                    }
                    
                } 
                
               
            }
        }
        else {
            $temp .="not array";
        }
        
        
        if(!$found) {
            $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.warning_datarecord_not_found_headline", "Ftm", array(ucfirst($templateType))); //Fluid-ucfirst($templateType) konnte nicht gefunden werden!
            $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.warning_datarecord_not_found_message", "Ftm", array($templateFile, ucfirst($templateType), $temp)); //Der Datensatz zum $templateFile.html Fluid-ucfirst($templateType) konnte nicht gefunden werden.$temp
            $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::WARNING);
        }


        $this->redirect('list', 'TemplateManager', NULL, array());
    }

    /**
     * Erstellt ein Template-Datensatz auf der aktuellen Seite
     *
     * @author Thomas Deuling <typo3@coding.ms>
     * @param  string $templateType empty, yaml or bootstrap
     * @return void
     * @since 1.0.0
     */
    public function createTemplateAction($templateType='') {
        
        
        // Template auslesen, falls vorhanden
        $fluidTemplate = $this->fluidTemplateRepository->findOneByPid($this->pid);
        
        
        $this->debug.= "read fluidTemplate on pid:".$this->pid." -> ".get_class($fluidTemplate)."<br>";
        
        // Wenn es noch keinen gibt, erstelle einen
        if(!($fluidTemplate instanceof \CodingMs\Ftm\Domain\Model\Template)) {

            $this->debug.= "create fluidTemplate on pid:".$this->pid."<br>";

            
            // Template erstellen und Standard-Werte einsetzen
            $fluidTemplate = $this->objectManager->create('CodingMs\Ftm\Domain\Model\Template');
            $fluidTemplate->setPid($this->pid);
            $fluidTemplate->setTemplateType($templateType);
            
            
            // Template-Config
            $fluidTemplateConfig = $this->objectManager->create('CodingMs\Ftm\Domain\Model\TemplateConfig');
            $fluidTemplateConfig->setDefaults();
            $fluidTemplate->setConfig($fluidTemplateConfig);
            
            
            // Template-Meta
            $fluidTemplateMeta = $this->objectManager->create('CodingMs\Ftm\Domain\Model\TemplateMeta');
            $fluidTemplateMeta->setDefaults();
            $fluidTemplate->setMeta($fluidTemplateMeta);
            
            
            /**
             * @ToDo
             * hier noch infos für den Einstieg anzegien
             * 
             * Dein Template wurde mit einer Grundkonfiguration erstellt.
             * Bearbeite nun den FTP-Datensatz und gebe als erstes ein Template-Verzeichnis an, in dem Dein Template liegen soll
             * Benenne dieses Verzeichnis mit bedacht. Am besten wählst Du einen Namen der die 
             * 
             * ..
             * Wechselst Du jetzt wieder in die Übersichts-Ansicht des Template-Managers erstellt dieser automatisiert deine neuen Template-Verzeichnis Struktur
             */
             
             
            // Extensions:t3_less
            // -----------------------------
            $fluidTemplateExt     = $this->objectManager->create('CodingMs\Ftm\Domain\Model\TemplateExt');
            $fluidTemplateExtConf = $this->objectManager->create('CodingMs\Ftm\Domain\Model\TemplateExtT3Less');
            $fluidTemplateExt->setExtKey('t3_less');
            $fluidTemplateExt->setExtName('LESS for TYPO3');
            $fluidTemplateExt->setExtVersion('1.0.7');
            $fluidTemplateExt->setExtConfT3Less($fluidTemplateExtConf);
            $fluidTemplate->addExtension($fluidTemplateExt);
            
            /**
             * @ToDo: import.less by default einsetzen
             */
            
            // -----------------------------
            
            
            // Template speichern/persistieren
            // -----------------------------
            $this->fluidTemplateRepository->add($fluidTemplate);
            // -----------------------------
            
            $headline = $this->lang('templateCreatedMessageOkHeadline');
            $message  = $this->lang('templateCreatedMessageOkMessage');
            $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
        }
        else {
            $headline = $this->lang('templateCreatedMessageWarningHeadline');
            $message  = $this->lang('templateCreatedMessageWarningMessage');
            $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::WARNING);
        }
    
    
        $this->redirect('list', 'TemplateManager', NULL, array());
    }


    
    /**
     * Holt eine Uebersetzung
     * 
     * @param  string $key Schluessel des Sprachwerts
     * @return string Uebersetzung
     */
    protected function lang($key) {
        $extName   = 'Ftm';
        $keyPrefix = 'tx_ftm_domain_model_template';
        return \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($keyPrefix.".".$key, $extName);
    }

    /**
     * Create the panel of buttons for submitting the form or otherwise perform operations.
     *
     * @param  string $baseUrl Base-URL fuer die Links
     * @return array  All available buttons as an assoc. array
     */
    protected function getButtons($baseUrl="") {
        
        $buttons = array();
        
        // \TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIcon('actions-document-view')
        
        // Seite ansehen
        if(isset($this->pid) && $this->pid>0) { 
            $buttons['view'] = array();
            $buttons['view']['href']    = '#';
            $buttons['view']['onclick'] = 'var previewWin = window.open(\''.$baseUrl.'index.php?id='.$this->pid.'\',\'newTYPO3frontendWindow\');previewWin.focus();';
            $buttons['view']['title']   = $GLOBALS['LANG']->sL('LLL:EXT:lang/locallang_core.php:labels.showPage', 1);
            $buttons['view']['icon']    = 'actions-document-view';
        }
        
        
        // CSH
        //$buttons['csh'] = TYPO3_CMS_Backend_Utility_BackendUtility::cshItem('_MOD_web_ftm', '', $GLOBALS['BACK_PATH'], '', TRUE);
        
        return $buttons;
        
        // View page
        $buttons['view'] = '<a href="#" onclick="' . htmlspecialchars(TYPO3_CMS_Backend_Utility_BackendUtility::viewOnClick($this->pid, $GLOBALS['BACK_PATH'], TYPO3_CMS_Backend_Utility_BackendUtility::BEgetRootLine($this->pageinfo['uid']))) . '" title="' . $GLOBALS['LANG']->sL('LLL:EXT:lang/locallang_core.php:labels.showPage', 1) . '">' . \TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIcon('actions-document-view') . '</a>';
        // Shortcut
        // if ($GLOBALS['BE_USER']->mayMakeShortcut()) {
            // $buttons['shortcut'] = $this->doc->makeShortcutIcon('id, edit_record, pointer, new_unique_uid, search_field, search_levels, showLimit', implode(',', array_keys($this->MOD_MENU)), $this->MCONF['name']);
        // }
        return $buttons;
    }

    
    /**
     * Prueft ob alle benoetigten Extensions vorhanden sind
     */
    protected function checkRequiredExtenstions() {

        
        // Erforderlichen Extensions ermitteln
        $requiredExtensions = explode(';', FTM_REQUIRED_EXTENSIONS);
        $messages = array();
        
        
        // Standard-Extensions pruefen
        if(!empty($requiredExtensions)) {
            foreach($requiredExtensions as $extension) {
                if(!\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded($extension)) {
                    $messages[] = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_extension_not_found", "Ftm", array($extension)); //$extension Extension konnte nicht gefunden werden
                }
            }
        }
     
        if($this->fluidTemplate instanceof \CodingMs\Ftm\Domain\Model\Template) {
            if(!\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('realurl') && $this->fluidTemplate->getConfig()->getSpeakingPaths()=='realurl') {
                $messages[] = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_realurl_not_found", "Ftm"); //RealURL (ab Version 1.12.6) Extension konnte nicht gefunden werden
            }
            else if(!\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('simulatestatic') && $this->fluidTemplate->getConfig()->getSpeakingPaths()=='simulatestatic') {
                $messages[] = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_simulatestatic_not_found", "Ftm"); //simulatestatic Extension konnte nicht gefunden werden
            }
        }
        
     
        if(!empty($messages))  {
            if(count($messages)==1) {
                $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_extension_missing", "Ftm"); //Erforderliche Extension fehlt!
            }
            else {
                $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_extensions_missing", "Ftm"); //Erforderliche Extensions fehlen!
            }
            $message = implode('<br />', $messages);
            $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
        }
        
    }
    
    /**
     * Setzt bzw. aktualisiert ein Template-Verzeichnis
     * 
     * @param  string $templateName Template-Verzeichnis
     */
    protected function setTemplateDir($templateName) {
            

        // Im Sys-Template setzen/aktualisieren
        $messages = $this->sysTemplateService->setTemplateDir($this->pid, $templateName);
        if(isset($messages['ok']) && !empty($messages['ok'])) {
            $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.typoscript_files_generated", "Ftm"); //TypoScript-Datei(en) erstellt!
            $this->flashMessageContainer->add($messages['ok'], $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
        }
        if(isset($messages['error']) && !empty($messages['error'])) {
            $headline =  \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_files_not_generated", "Ftm"); //TypoScript-Datei(en) konnten nicht erstellt werden!
            $this->flashMessageContainer->add($messages['error'], $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
        }
        
        
        // In den t3_less Constants setzen/aktualisieren
        $lessExtension = $this->fluidTemplate->getExtensionByName('t3_less');
        if(!($lessExtension instanceof \CodingMs\Ftm\Domain\Model\TemplateExt)) {
            throw new \Exception("FTM-Template doesnt contain the required t3_less object", 1);
        }
        else {
            $lessExtensionConf = $lessExtension->getExtConfT3Less();
            if(!($lessExtensionConf instanceof \CodingMs\Ftm\Domain\Model\TemplateExtT3Less)) {
                throw new \Exception("FTM-Template doesnt contain the required t3_less configuration object", 1);
            }
            else {
                $lessExtensionConf->setPathToLessFiles(\CodingMs\Ftm\Utility\Tools::getDirectory("Less", $templateName));
                $lessExtensionConf->setOutputFolder(\CodingMs\Ftm\Utility\Tools::getDirectory("Stylesheets", $templateName));
            }
        }
        
        
        // Geaendertes Template speichern
        $this->fluidTemplateRepository->update($this->fluidTemplate);
        
    }


    /**
     * Prueft on in der Extension-Konfiguration
     * alle notwendigen Werte vorhanden sind
     * 
     * @return void
     * @since 1.0.0
     */
    protected function validateExtConf() {
        
        if(!isset($this->extConf['pluginCloudHost']) || trim($this->extConf['pluginCloudHost'])=='') {
            throw new \Exception("Extension configuration isnt valid! pluginCloudHost not found! Default value is plugincloud.de.", 1);
        }
        
        if(!isset($this->extConf['pcKey']) || trim($this->extConf['pcKey'])=='') {
            throw new \Exception("Extension configuration isnt valid! pcKey not found! Default value is public.", 1);
        }
        
        if(!isset($this->extConf['user']) || trim($this->extConf['user'])=='') {
            throw new \Exception("Extension configuration isnt valid! user not found! Default value is noUser.", 1);
        }
        
        if(!isset($this->extConf['password']) || trim($this->extConf['password'])=='') {
            throw new \Exception("Extension configuration isnt valid! password not found! Default value is noPassword.", 1);
        }
        
    }

}
?>