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

use \TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use \TYPO3\CMS\Core\Messaging\FlashMessage;
use \CodingMs\Ftm\Utility\Tools;

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
     * GridLayout Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\GridLayoutRepository
     * @inject
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
     * @inject
     */
    protected $fluidService;

    /**
     * Pages-Service
     *
     * @var \CodingMs\Ftm\Service\Pages
     * @inject
     */
    protected $pagesService;

    /**
     * TemplateStructure-Service
     *
     * @var \CodingMs\Ftm\Service\TemplateStructure
     */
    protected $templateStructureService;

    /**
     * Dynncss-Service
     *
     * @var \CodingMs\Ftm\Service\Dyncss
     * @inject
     */
    protected $dyncssService;
    
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
    protected $debug = '';

    /**
     * SysTemplate-Service
     *
     * @var \CodingMs\Ftm\Service\SysTemplate
     * @inject
     */
    protected $sysTemplateService;

    /**
     * Storage-Service
     *
     * @var \CodingMs\Ftm\Service\Storage
     * @inject
     */
    protected $storageService;

    /**
     * Session-Handler
     *
     * @var \CodingMs\Ftm\Domain\Session\SessionHandler
     */
    protected $sessionHandler = null;

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    public $objectManager;

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
        $this->extConf = \CodingMs\Ftm\Service\ExtensionConfiguration::getConfiguration();
        
        // Aktuelle Page auslesen
        // Auf Page:0 nichts machen
        $this->pid = intval(\TYPO3\CMS\Core\Utility\GeneralUtility::_GET('id'));
        if($this->pid==0) {
//            if($this->typo3Version>=6) {
//                die("Please select a first-level page in order to create or edit a FTM-Template.");
//            }
//            else {
                $this->addFlashMessage("Please select a first-level page in order to create or edit a FTM-Template.", 'Please select a page!', FlashMessage::WARNING);
//            }
            return;
        }
        else {

            $templateService = new \CodingMs\Ftm\Service\Template();
            $this->fluidTemplate = $templateService->getTemplate($this->pid);

        }

        // Template-Structure-Service
        $this->templateStructureService = $this->objectManager->get('CodingMs\\Ftm\\Service\\TemplateStructure');

        // PluginCloud-Service initiieren
        $this->pluginService = $this->objectManager->create(
            'CodingMs\Ftm\Service\PluginService', 
            $this->extConf['pluginCloudHost'],
            $this->extConf['pluginCloudScript'],
            $this->extConf['pcKey'],
            $this->extConf['user'],
            $this->extConf['password'],
            $this->extConf['allowLog']
        );
        
    }

    /**
     * Displays the Template-Manager
     *
     * @return void
     */
    public function listAction() {

        // Auf Root-Seite nichts machen
        // Meldung wurde bereits in initializeAction generiert
        if($this->pid==0) {
            return;
        }

        //
        $this->checkRequiredExtenstions();
        
        // Preufen ob Updates verfuegbar sind
        $updateMessage = \CodingMs\Ftm\Service\Updates::check('ftm', explode('.', FTM_VERSION));
        if(is_string($updateMessage)) {
            /** @todo $updateHeadline anpassen, wenn keine update-check möglich war: file_get_content fails */
            $updateHeadline = $this->lang('ftm_update_available');
            $this->addFlashMessage($updateMessage, $updateHeadline, FlashMessage::WARNING);
        } //'FTM Update verfügbar!'

       
        $buttons = array();
        $options = array();
        $options['ftmVersion'] = FTM_VERSION;
        $options['pid']        = $this->pid;
        $options['extConf']    = $this->extConf;
        $options['wikiUrl']    = 'http://fluid-template-manager.de/documentation/';
        $options['disclaimerNotAccepted'] = TRUE;
        
        
        // Pruefen ob es auf der aktuelle Seite schon ein
        // Template-Datensatz gibt
        if($this->fluidTemplate===null) {
            $this->redirect('newTheme');
            return;
        }
        else {
            
            // Merken das es ein Template gibt
            // und pruefen ob Meldung noch angezeigt wird
            // -------------------------------------------------
            $options['templateOnCurrentPage'] = TRUE;
            $options['disclaimerNotAccepted'] = !$this->fluidTemplate->isDisclaimerAccepted();
            $this->debug.="template on this pid: ".$this->pid."<br>";
        
        
            // Buttons im Header
            // -------------------------------------------------
            $buttons = $this->getButtons($this->fluidTemplate->getConfig()->getBaseUrl());
            
            // TYPOScript-Snippet-List next/prev-uid einsetzen
            $this->fluidTemplate->setTypoScriptSnippet($this->fluidTemplate->getTypoScriptSnippet());
            
            
            // Pruefen ob das Sys-Template vorhanden ist
            // und erstellt es ggf.
            // -------------------------------------------------
            $sysTemplateStatus = $this->sysTemplateService->checkSysTemplate($this->pid);

            $translationBaseKey = 'tx_ftm_controller_templatemanagercontroller.';

//            if($sysTemplateStatus=='error') {
//                $headline = $this->lang('ftm_root_template_error_headline'); //FTM Root-Template Fehler!
//                $message  = $this->lang('ftm_root_template_error_message1') . '<br />'; //Es wurde ein Problem mit dem Root-Template auf dieser Seite festgestellt!
//                $message .= $this->lang('ftm_root_template_error_message2'); //Bitte stellen Sie sicher das es nur ein Root-Template auf dieser Seite gibt!
//                $this->addFlashMessage($message, $headline, FlashMessage::ERROR);
//            }
//            else if($sysTemplateStatus=='updated') {
//                $headline = $this->lang('ftm_root_template_update_headline'); //FTM Root-Template aktualisiert!
//                $message  = $this->lang('ftm_root_template_update_message'); //Das FTM Root-Template auf dieser Seite wurde aktualisiert!
//                $this->addFlashMessage($message, $headline, FlashMessage::OK);
//                $this->redirect('list', 'TemplateManager', NULL, array());
//            }
//            else if($sysTemplateStatus=='created') {
//                $headline = $this->lang('ftm_root_template_generated_headline'); //FTM Root-Template erstellt!
//                $message  = $this->lang('ftm_root_template_generated_message'); //Es wurde ein FTM Root-Template auf dieser Seite erstellt!
//                $this->addFlashMessage($message, $headline, FlashMessage::OK);
//                $this->redirect('list', 'TemplateManager', NULL, array());
//            }
            // -------------------------------------------------
            
            
            
            // Sys-Template gefunden
            // -------------------------------------------------
            //else
            if($sysTemplateStatus=='alreadyExist') {

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
                    /**
                     * @todo: Pages müssen anders erstelltn werden
                     * via. Button oder Distribution
                     */
                    $pagesMessages = ""; //$this->pagesService->checkPages($this->pid);
                    
                    // Meldungen von erstellten Seiten ausgeben
                    if(trim($pagesMessages)!="" && $pagesMessages!==TRUE) {
                        $headline = $this->lang('ftm_pages_generated_headline'); //FTM Seiten erstellt!
                        $this->addFlashMessage($pagesMessages, $headline, FlashMessage::OK);
                    }
                    // -------------------------------------------------
                    
                    


                    
                    
                    // Template-Dir ggf nochmal in Sys-
                    // Template etc. setzen/aktualisieren
                    // -------------------------------------------------
                    $options['templateDirFound'] = TRUE;
                    $this->setTemplateDir($templateName);
                    // -------------------------------------------------
                    
                    
                    
                    // Pruefen ob Storage vorhanden ist und erstelle ihn ggf.
                    // -------------------------------------------------
                    if($this->storageService->checkAndCreate($this->fluidTemplate->getTemplateDir()) == 'created') {
                        $messageText = $this->lang('storage_created_message');
                        $messageHead = $this->lang('storage_created_headline');
                        $this->addFlashMessage($messageText, $messageHead, FlashMessage::OK);
                    }
                    // -------------------------------------------------
                    
                    
                    
                    // Template Strukture pruefen
                    // -------------------------------------------------
                    if($this->templateStructureService->checkStructure($this->pid, $this->fluidTemplate)) {
                        // checkStructure returns TRUE wenn etwas erstellt wurde
                        
                        $headline = $this->lang('ftm_template_structure_generated_headline'); //FTM Template-Struktur erstellt!
                        $messages = $this->lang('ftm_template_structure_generated_message'); //FTM Template-Struktur wurde erstellt bzw. aktualisiert.
                        $this->addFlashMessage($messages, $headline, FlashMessage::OK);
                        
                        // daher nochmal ein Redirect
                        $this->redirect('list', 'TemplateManager', NULL, array());
                    }
                    
                    
                    
                    // Pruefen ob alle Fluid-Templates vorhanden sind
                    // -------------------------------------------------
                    $tempMessages = '';
                    // Pruefen ob alle Layout-Datensaetze vorhanden sind
                    $fluidLayoutFiles   = $this->fluidService->checkFiles($this->fluidTemplate, 'layout');
                    if($fluidLayoutFiles===TRUE) {
                        $this->debug.= "fluid layout files: TRUE<br>";
                    }
                    else {
                        $tempMessages.= $this->fluidService->createFiles($this->fluidTemplate, 'layout', $fluidLayoutFiles);
                    }
                    
                    // Pruefen ob alle Partial-Datensaetze vorhanden sind
                    $fluidPartialFiles  = $this->fluidService->checkFiles($this->fluidTemplate, 'partial');
                    if($fluidPartialFiles===TRUE) {
                        $this->debug.= "fluid partial files: TRUE<br>";
                    }
                    else {
                        $tempMessages.= $this->fluidService->createFiles($this->fluidTemplate, 'partial', $fluidPartialFiles);
                    }
                    
                    // Pruefen ob alle Template-Datensaetze vorhanden sind
                    $fluidTemplateFiles = $this->fluidService->checkFiles($this->fluidTemplate, 'template');
                    if($fluidTemplateFiles===TRUE) {
                        $this->debug.= "fluid template files: TRUE<br>";
                    }
                    else {
                        $tempMessages.= $this->fluidService->createFiles($this->fluidTemplate, 'template', $fluidTemplateFiles);
                    }
                    
                    // Meldungen von erstellten Templates ausgeben
                    if(trim($tempMessages)!="") {
                        $headline = $this->lang('fluid_templates_generated_headline'); //Fluid-Templates erstellt!
                        $this->addFlashMessage($tempMessages, $headline, FlashMessage::OK);
                        
                        // Seite neu laden
                        $this->redirect('list', 'TemplateManager', NULL, array());
                    }
                    // -------------------------------------------------



                    // Dyncss dataset creation on file detection
                    if($this->extConf['autoCreateDyncssDatasetOnFileDetection']) {
                        $this->dyncssService->autoCreateDatasets($this->fluidTemplate);
                        $successMessages = $this->dyncssService->getMessages('success');
                        if(!empty($successMessages)) {
                            $this->addFlashMessage(implode('<br />', $successMessages), 'Dyncss erfolgreich erstellt', FlashMessage::OK);
                        }
                    }

                    
                }


                // -------------------------------------------------
                // Template-Verzeichnis wurde noch nicht
                // im FTM-Template angegeben
                else {
                    $options['templateDirFound'] = FALSE;
                    $headline = $this->lang('warning_no_template_dir_found_headline'); //Kein Template-Verzeichnis gefunden!
                    $message  = $this->lang('warning_no_template_dir_found_message1') . '<br />'; //In diesem FTM-Template ist noch kein Template-Verzeichnis eingetragen worden.
                    $message .= $this->lang('warning_no_template_dir_found_message2') . '<br />'; //Bitte editieren Sie den Template-Datensatz, und geben Sie im Feld templateDir den Namen des Verzeichnisses an in dem Ihre Template erstellt werden soll.
                    $message .= $this->lang('warning_no_template_dir_found_message3'); //Sobald das FTM-Template ein Template-Verzeichnis beinhaltet, wird die benötigte Verzeichnisstruktur gecheckt und ggf. erstellt!.
                    $this->addFlashMessage($message, $headline, FlashMessage::WARNING);
                }
            }
            
        }
        

        // Template befuellen
        $this->view->assign('buttons', $buttons);
        $this->view->assign('debug',   $this->debug);
        $this->view->assign('doDebug', FALSE);
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
            if($acceptDisclaimer=='TRUE') {
                $this->fluidTemplate->setDisclaimerAccepted(TRUE);
                $this->fluidTemplateRepository->update($this->fluidTemplate);
            }
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
            $headline = $this->lang('error_ftm_template_not_exists_headline'); //TypoScript nicht re-/generiert!
            $message  = $this->lang('error_ftm_template_not_exists_message', array($typoScriptFile)); //Das $typoScriptFile TypoScript konnte nicht re-/generiert werden, da auf dieser Seite anscheinend noch kein FTM-Template existiert.
            $this->addFlashMessage($message, $headline, FlashMessage::ERROR);
            $this->redirect('list', 'TemplateManager', NULL, array());
        }
        
        else {
            
            
            // Benoetigte Daten sammeln
            $dataCheckFailed = FALSE;
            $templateDataArray = $this->getTemplateDataArray();
            
                    
            // Pruefen ob Templates vorhanden sind
            $tempFluid = unserialize($templateDataArray['fluid']);
            if(!is_array($tempFluid) || empty($tempFluid)) {
                $headline = $this->lang('error_fluid_template_not_exists_headline'); //TypoScript nicht re-/generiert!
                $message  = $this->lang('error_fluid_template_not_exists_message', array($typoScriptFile)); //Das $typoScriptFile TypoScript konnte nicht re-/generiert werden, da auf dieser Seite anscheinend noch keine Fluid-Templates existieren.
                $this->addFlashMessage($message, $headline, FlashMessage::WARNING);
                
                $dataCheckFailed = TRUE;
            }

        
            /**
             * @todo:  Pruefen ob in allen Menues ein NO vorhanden ist!!
             */ 
            // $tempFluid = unserialize($templateDataArray['fluid']);
            // if(!is_array($tempFluid) || empty($tempFluid)) {
                // $headline = 'TypoScript nicht re-/generiert!';
                // $message  = 'Das '.$typoScriptFile.' TypoScript konnte nicht re-/generiert werden, da auf dieser Seite anscheinend noch keine Fluid-Templates existieren.';
                // $this->addFlashMessage($message, $headline, FlashMessage::WARNING);
                // $dataCheckFailed = TRUE;
            // }

            /**
             * @todo: hier auch mal die eingebundenen include_statics mitsenden
             * am besten inkl. Versionen um den Generator steuern zu können
             */
            
            // TypoScript generieren
            if(!$dataCheckFailed) {

                $result = $this->pluginService->executeAction("generateTypoScript", $templateDataArray);
                if($result['status']=='success') {
                    
                    
                    // Pfad ermitteln
                    $typoScript = '';
                    $messageOk  = '';
                    $filepath   = \CodingMs\Ftm\Utility\Tools::getDirectory("TypoScript", $this->fluidTemplate->getTemplateDir());
                    $relPath    = $filepath;
                    $absPath    = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
    
    
                    // setup-TypoScript schreiben
                    // ------------------------------------------------
                    $typoScriptFile = "setup.ts";
                    $typoScript = $result['setup'];
                    
                    \CodingMs\Ftm\Service\Backup::backupFile($this->fluidTemplate, $absPath.$typoScriptFile);
                    if(!file_put_contents($absPath.$typoScriptFile, $typoScript)) {
                        $headline = $this->lang('error_typoscript_not_saved_headline'); //TypoScript wurde re-/generiert!
                        $message  = $this->lang('error_typoscript_not_saved_message1', array($typoScriptFile)) . '<br />'; //Das $typoScriptFile TypoScript für dieses FTM-Template wurde re-/generiert, konnte aber nicht in der setup.ts abgespeichert werden.
                        $message .= $this->lang('error_typoscript_not_saved_message2', array($absPath.$typoScriptFile)); //Bitte prüfen die Datei/Pfad auf Korrektheit und Schreibrechte: $absPath.$typoScriptFile
                        $this->addFlashMessage($message, $headline, FlashMessage::ERROR);
                    }
                    else {
                        
                        // MD5-Hash merken
                        $this->fluidTemplate->setMd5HashSetupTs(md5(serialize($templateDataArray)));
                        $messageOk.= $this->lang('typoscript_file_generated', array($typoScriptFile)); //Das $typoScriptFile TypoScript für dieses FTM-Template wurde re-/generiert.
                    }
                    // ------------------------------------------------
                    
                    
                    // constants-TypoScript schreiben
                    // ------------------------------------------------
                    $typoScriptFile = "constants.ts";
                    $typoScript = $result['constants'];
                    
                    \CodingMs\Ftm\Service\Backup::backupFile($this->fluidTemplate, $absPath.$typoScriptFile);
                    if(!file_put_contents($absPath.$typoScriptFile, $typoScript)) {
                        $headline = $this->lang('error_typoscript_not_saved_in_constants_headline'); //TypoScript wurde re-/generiert!
                        $message  = $this->lang('error_typoscript_not_saved_in_constants_message1', array($typoScriptFile)) . '<br />'; //Das $typoScriptFile TypoScript für dieses FTM-Template wurde re-/generiert, konnte aber nicht in der constants.ts abgespeichert werden.
                        $message .= $this->lang('error_typoscript_not_saved_in_constants_message2', array($typoScriptFile, $absPath.$typoScriptFile)); //Bitte prüfen die Datei/Pfad auf Korrektheit und Schreibrechte: $absPath.$typoScriptFile
                        $this->addFlashMessage($message, $headline, FlashMessage::ERROR);
                    }
                    else {
                        
                        // MD5-Hash merken
                        $this->fluidTemplate->setMd5HashConstantsTs(md5(serialize($templateDataArray)));
                        $messageOk.= $this->lang('typoscript_file_generated', array($typoScriptFile)); //Das $typoScriptFile TypoScript für dieses FTM-Template wurde re-/generiert.
                    }
                    // ------------------------------------------------
                    
                    
                    // tsConfig-TypoScript schreiben
                    // ------------------------------------------------
                    $typoScriptFile = "tsConfig.ts";
                    $typoScript = $result['tsConfig'];
                    
                    \CodingMs\Ftm\Service\Backup::backupFile($this->fluidTemplate, $absPath.$typoScriptFile);
                    if(!file_put_contents($absPath.$typoScriptFile, $typoScript)) {
                        $headline = $this->lang('error_typoscript_not_saved_in_tsconfig_headline'); //TypoScript wurde re-/generiert!
                        $message  = $this->lang('error_typoscript_not_saved_in_tsconfig_message1', array($typoScriptFile)) . '<br />'; //Das $typoScriptFile TypoScript für dieses FTM-Template wurde re-/generiert, konnte aber nicht in der tsConfig.ts abgespeichert werden.
                        $message .= $this->lang('error_typoscript_not_saved_in_tsconfig_message2', array($typoScriptFile)); //Bitte prüfen die Datei/Pfad auf Korrektheit und Schreibrechte: $absPath.$typoScriptFile
                        $this->addFlashMessage($message, $headline, FlashMessage::ERROR);
                    }
                    else {
                        
                        // MD5-Hash merken
                        $this->fluidTemplate->setMd5HashTsConfig(md5(serialize($templateDataArray)));
                        $messageOk.= $this->lang('typoscript_file_generated', array($typoScriptFile)); //Das $typoScriptFile TypoScript für dieses FTM-Template wurde re-/generiert.
                    }
                    // ------------------------------------------------
                    
                    
                    // Meldung anzeigen?!
                    if($messageOk!="") {
                        // Template speichern
                        $this->fluidTemplateRepository->update($this->fluidTemplate);
                        $headline = $this->lang('typoscript_generated');
                        $this->addFlashMessage($messageOk, $headline, FlashMessage::OK);
                    }
                   
    
                }
                else {
                    $errors = str_replace('|', '<br />', $result['errors']);
                    $this->addFlashMessage($errors, 'TypoScript konnte nicht re-/generiert werden!', FlashMessage::ERROR);
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


        $found = FALSE;
        $temp = '';


        // Template-Datei nur erstellen,
        // wenn es den Datensatz wirklich gibt
        $fluidTemplates = $this->fluidTemplate->getFluid();
        if(!empty($fluidTemplates)) {
            foreach($fluidTemplates as $tempFluid) {
                
                $temp .= $tempFluid->getTemplateType()."==".$templateType." && ".$tempFluid->getTemplateType()."==".$templateFile."<br/ \n>";
                
                if($tempFluid->getTemplateType()==$templateType && $tempFluid->getTemplateFile()==$templateFile) {
                    
                    // Merken das das Template gefunden wurde
                    $found = TRUE;
                    
                    
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
                            
                            $headline = $this->lang('template_file_copied_headline', array(ucfirst($templateType), ucfirst($templateType))); //Fluid-ucfirst($templateType)-Datei wurde erfolgreich in Fluid-ucfirst($templateType)-Datensatz kopiert!
                            $message  = $this->lang('template_file_copied_message', array($templateFile, ucfirst($templateType))); //Die $templateFile.html Fluid-ucfirst($templateType)-Datei wurde erfolgreich kopiert.
                            $this->addFlashMessage($message, $headline, FlashMessage::OK);
                        }
                        else {
                            $headline = $this->lang('error_template_file_not_found_headline', array(ucfirst($templateType))); //Fluid-ucfirst($templateType)-Datei konnte nicht kopiert werden!
                            $message  = $this->lang('error_template_file_not_found_message', array($templateFile, ucfirst($templateType))); //Die $templateFile.html Fluid-ucfirst($templateType)-Datei konnte nicht gefunden werden.
                            $this->addFlashMessage($message, $headline, FlashMessage::ERROR);
                        }
                    }
                    
                    // Template-Datei erstellen
                    // bzw. DB-Code in die Datei schreiben
                    else {
                        \CodingMs\Ftm\Service\Backup::backupFile($this->fluidTemplate, $absPath);
                        if(file_put_contents($absPath, $tempFluid->getTemplateCode())) {
                            $headline = $this->lang('fluid_datarecord_copied_headline', array(ucfirst($templateType), ucfirst($templateType))); //Fluid-ucfirst($templateType)-Datensatz wurde erfolgreich in Fluid-ucfirst($templateType)-Datei kopiert!
                            $message  = $this->lang('fluid_datarecord_copied_message', array($templateFile, ucfirst($templateType))); //Die $templateFile.html Fluid-ucfirst($templateType)-Datei wurde erfolgreich kopiert.
                            $this->addFlashMessage($message, $headline, FlashMessage::OK);
                        }
                        else {
                            $headline = $this->lang('error_template_file_not_copied_headline', array(ucfirst($templateType))); //Fluid-ucfirst($templateType)-Datei konnte nicht kopiert werden!
                            $message  = $this->lang('error_template_file_not_copied_message1', array($templateFile, ucfirst($templateType))) . '<br />'; //Die $templateFile.html Fluid-ucfirst($templateType)-Datei konnte nicht kopiert werden.
                            $message .= $this->lang('error_template_file_not_copied_message2'); //Bitte prüfen Sie den Dateinamen und die Verzeichnisrechte.
                            $this->addFlashMessage($message, $headline, FlashMessage::ERROR);
                        }
                    }
                    
                } 
                
               
            }
        }
        else {
            $temp .="not array";
        }
        
        
        if(!$found) {
            $headline = $this->lang('warning_datarecord_not_found_headline', array(ucfirst($templateType))); //Fluid-ucfirst($templateType) konnte nicht gefunden werden!
            $message  = $this->lang('warning_datarecord_not_found_message', array($templateFile, ucfirst($templateType), $temp)); //Der Datensatz zum $templateFile.html Fluid-ucfirst($templateType) konnte nicht gefunden werden.$temp
            $this->addFlashMessage($message, $headline, FlashMessage::WARNING);
        }


        $this->redirect('list', 'TemplateManager', NULL, array());
    }

    /**
     * Holt eine Uebersetzung
     * 
     * @param  string $key Schluessel des Sprachwerts
     * @param  array  $params Replacements
     * @return string Uebersetzung
     */
    protected function lang($key, array $params=array()) {
        $extName = 'Ftm';
        $fullkey = 'tx_ftm_domain_model_template.'.$key;
        $lang    = LocalizationUtility::translate($key, $extName, $params);
        if(!$lang || $lang=='') {
            $fullkey = 'tx_ftm_domain_model_templatemanagercontroller.'.$key;
            $lang = LocalizationUtility::translate($fullkey, $extName, $params);
        }
        if(!$lang || $lang=='') {
            $lang = 'Translation of '.$key.' not found';
        }
        return $lang;
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

        /**
         * @todo
         * hier beiLess auch dnycss, dyncss_less
         * bie scss -dnycss_scss prüfen!!
         */
        
        // Erforderlichen Extensions ermitteln
        $requiredExtensions = explode(';', FTM_REQUIRED_EXTENSIONS);
        $messages = array();
        
        
        // Standard-Extensions pruefen
        if(!empty($requiredExtensions)) {
            foreach($requiredExtensions as $extension) {
                if(!\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded($extension)) {
                    $messages[] = $this->lang('error_extension_not_found', array($extension)); //$extension Extension konnte nicht gefunden werden
                }
            }
        }
        
        if($this->fluidTemplate instanceof \CodingMs\Ftm\Domain\Model\Template) {
            if($this->fluidTemplate->getConfig() instanceof \CodingMs\Ftm\Domain\Model\TemplateConfig) {
                if(!\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('realurl') && $this->fluidTemplate->getConfig()->getSpeakingPaths()=='realurl') {
                    $messages[] = $this->lang('error_realurl_not_found'); //RealURL (ab Version 1.12.6) Extension konnte nicht gefunden werden
                }
                else if(!\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('simulatestatic') && $this->fluidTemplate->getConfig()->getSpeakingPaths()=='simulatestatic') {
                    $messages[] = $this->lang('error_simulatestatic_not_found'); //simulatestatic Extension konnte nicht gefunden werden
                }
            }
            else {
                $message = $this->lang('ftm_template_damaged');
                throw new \Exception($message, 1);
            }
        }
        
        if(!empty($messages)) {
            if(count($messages)==1) {
                $headline = $this->lang('error_extension_missing'); //Erforderliche Extension fehlt!
            }
            else {
                $headline = $this->lang('error_extensions_missing'); //Erforderliche Extensions fehlen!
            }
            $message = implode('<br />', $messages);
            $this->addFlashMessage($message, $headline, FlashMessage::ERROR);
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
            $headline = $this->lang('typoscript_files_generated'); //TypoScript-Datei(en) erstellt!
            $this->addFlashMessage($messages['ok'], $headline, FlashMessage::OK);
        }
        if(isset($messages['error']) && !empty($messages['error'])) {
            $headline =  $this->lang('error_typoscript_files_not_generated'); //TypoScript-Datei(en) konnten nicht erstellt werden!
            $this->addFlashMessage($messages['error'], $headline, FlashMessage::ERROR);
        }
        
        // In den t3_less Constants setzen/aktualisieren
        // $lessExtension = $this->fluidTemplate->getExtensionByName('t3_less');
        // if(!($lessExtension instanceof \CodingMs\Ftm\Domain\Model\TemplateExt)) {
            // throw new \Exception("FTM-Template doesnt contain the required t3_less object", 1);
        // }
        // else {
            // $lessExtensionConf = $lessExtension->getExtConfT3Less();
            // if(!($lessExtensionConf instanceof \CodingMs\Ftm\Domain\Model\TemplateExtT3Less)) {
                // throw new \Exception("FTM-Template doesnt contain the required t3_less configuration object", 1);
            // }
            // else {
                // $lessExtensionConf->setPathToLessFiles(\CodingMs\Ftm\Utility\Tools::getDirectory("Less", $templateName));
                // $lessExtensionConf->setOutputFolder(\CodingMs\Ftm\Utility\Tools::getDirectory("Stylesheets", $templateName));
            // }
        // }
        
        // Geaendertes Template speichern
        $this->fluidTemplateRepository->update($this->fluidTemplate);
        
    }

    /**
     * Maske anzeigen um ein neues Theme zuerstellen
     */
    public function newThemeAction() {


        $templateTypes = array();
        if(!empty($this->settings['templates'])) {
            foreach($this->settings['templates'] as $templateKey=> $tempateData) {
                $templateTypes[$templateKey] = $templateKey;
            }
        }
        else {
            throw new \Exception('No template types found');
        }
        $this->view->assign('templateTypes', $templateTypes);
    }

    /**
     * Neues Theme generieren
     */
    public function createThemeAction() {

        $templateDir = '';
        if($this->request->hasArgument('templateDir')) {
            $templateDir = $this->request->getArgument('templateDir');
        }
        $templateType = '';
        if($this->request->hasArgument('templateType')) {
            $templateType = $this->request->getArgument('templateType');
        }
        $siteName = '';
        if($this->request->hasArgument('siteName')) {
            $siteName = $this->request->getArgument('siteName');
        }
        $installTheme = FALSE;
        if($this->request->hasArgument('installTheme')) {
            $installTheme = $this->request->getArgument('installTheme')=='install' ? TRUE : FALSE;
        }
        $createDirectories = FALSE;
        if($this->request->hasArgument('createDirectories')) {
            $createDirectories = $this->request->getArgument('createDirectories')=='create' ? TRUE : FALSE;
        }
        $createFtmDataset = FALSE;
        if($this->request->hasArgument('createFtmDataset')) {
            $createFtmDataset = $this->request->getArgument('createFtmDataset')=='create' ? TRUE : FALSE;
        }

        if($templateDir=='theme_' || trim($templateDir)=='') {
            $this->addFlashMessage('Bitte geben Sie einen Extension/Theme-Key an!', 'Das Theme konnte nicht erstellt werden', FlashMessage::ERROR);
            $this->redirect('newTheme');
        }

        /**
         * @todo: generateBaseTypoScript-flag integrieren
         */

        // Theme-Verzeichnis prüfen
        $relPath = "typo3conf/ext/".$templateDir;
        $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
        if(is_dir($absPath)) {
            $this->addFlashMessage('Ein Theme mit diesem Extension/Theme-Key existiert bereits!', 'Das Theme konnte nicht erstellt werden', FlashMessage::ERROR);
            $this->redirect('newTheme');
        }
        else if(!mkdir($absPath)) {
            $this->addFlashMessage('Das Extension/Theme-Verzeichnis konnte nicht erstellt werden!', 'Das Theme konnte nicht erstellt werden', FlashMessage::ERROR);
            $this->redirect('newTheme');
        }

        // und es ein gültiger Template-Type ist
        if(!array_key_exists($templateType, $this->settings['templates'])) {
            $this->addFlashMessage('Bitte wählen Sie einen Template-Typ aus!', 'Das Theme konnte nicht erstellt werden', FlashMessage::ERROR);
            $this->redirect('newTheme');
        }


        // Template-Verzeichnisstruktur erstellen
        // -------------------------------------------------
        if($createDirectories) {
            $directories = $this->settings['templates'][$templateType]['directories'];
            $directoryCheck = \CodingMs\Ftm\Service\TemplateDirectory::checkDirectories($templateDir, $directories);
            if($directoryCheck===TRUE) {
                $this->debug.= "directory check: TRUE<br>";
            }
            else {
                if(!empty($directoryCreate)) {
                    foreach($directoryCreate as $directory => $description) {
                        $this->debug.= "directory '".$directory."' not found<br>";
                    }
                }
            }

            $directoryCreate = \CodingMs\Ftm\Service\TemplateDirectory::createDirectories($templateDir, $directories);
            if($directoryCreate===TRUE) {
                $this->debug.= "directory create: TRUE<br>";
            }
            else {
                if(!empty($directoryCreate)) {
                    foreach($directoryCreate as $directory => $description) {
                        $this->debug.= "couldnt create directory '".$directory."'. Please check permissions for directory /typo3conf/ext/".$templateDir."/<br>";
                    }
                }
            }
            $this->addFlashMessage('Die Verzeichnisstruktur für das Theme wurde erfolgreich erstellt.', 'Verzeichnisstruktur erstellt!', FlashMessage::OK);
        }
        // -------------------------------------------------

        // Create Theme-Files
        // -------------------------------------------------

        if(!empty($this->settings['templates'][$templateType]['files'])) {
            $filesNotFound = array();
            $filesNotCopied = array();
            foreach($this->settings['templates'][$templateType]['files'] as $file) {

                // Source
                $relPathSource = "typo3conf/ext/ftm/Resources/Private/Theme/".$templateType;
                $absPathSource = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPathSource);
                if(file_exists($absPathSource.$file['from'])) {

                    // Target
                    $relPathTarget = "typo3conf/ext/".$templateDir;
                    $absPathTarget = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPathTarget);
                    if(!copy($absPathSource.$file['from'], $absPathTarget.$file['to'])) {
                        $filesNotCopied[] = $file['from'];
                    }
                    else {
                        // Replace-Variables
                        $fileContent = file_get_contents($absPathTarget.$file['to']);
                        $fileContent = str_replace("###templateDir###", $templateDir, $fileContent);
                        file_put_contents($absPathTarget.$file['to'], $fileContent);
                    }
                }
                else {
                    $filesNotFound[] = $file['from'];
                }

            }

            // Files not copied?!
            if(!empty($filesNotCopied)) {
                $message = 'Folgende Dateien konnten nicht kopiert werden:<br />';
                foreach($filesNotCopied as $file) {
                    $message.= $file.'<br />';
                }
                $this->addFlashMessage($message, 'Es konnten nicht alle Dateien kopiert werden', FlashMessage::ERROR);
            }

            // Files not found?!
            if(!empty($filesNotFound)) {
                $message = 'Folgende Dateien konnten nicht gefunden werden:<br />';
                foreach($filesNotFound as $file) {
                    $message.= $file.'<br />';
                }
                $this->addFlashMessage($message, 'Es konnten nicht alle Dateien kopiert werden', FlashMessage::ERROR);
            }
        }
        // -------------------------------------------------


        // Template-Datensatz erstellen und Standard-Werte einsetzen
        // -------------------------------------------------
        if($createFtmDataset) {
            $fluidTemplate = new \CodingMs\Ftm\Domain\Model\Template();
            $fluidTemplate->setPid($this->pid);
            $fluidTemplate->setTemplateDir($templateDir);
            $fluidTemplate->setTemplateType($templateType);
            $fluidTemplate->setTemplateMode('development');
            $fluidTemplate->setSiteName($siteName);

            // Template-Config
            $fluidTemplateConfig = new \CodingMs\Ftm\Domain\Model\TemplateConfig();
            $fluidTemplateConfig->setPid($this->pid);
            $fluidTemplateConfig->setDefaults();
            if(!empty($_SERVER['HTTPS'])) {
                $baseUrl = 'https://'.$_SERVER['SERVER_NAME'].'/';
            }
            else {
                $baseUrl = 'http://'.$_SERVER['SERVER_NAME'].'/';
            }
            $fluidTemplateConfig->setBaseURL($baseUrl);
            $fluidTemplate->setConfig($fluidTemplateConfig);

            // Template-Meta
            $fluidTemplateMeta = new \CodingMs\Ftm\Domain\Model\TemplateMeta();
            $fluidTemplateMeta->setPid($this->pid);
            $fluidTemplateMeta->setDefaults();
            $fluidTemplate->setMeta($fluidTemplateMeta);

            // Template speichern/persistieren
            $this->fluidTemplateRepository->add($fluidTemplate);

            $this->addFlashMessage('Der FTM-Datensatz wurde erfolgreich erstellt.', 'FTM-Datensatz erstellt!', FlashMessage::OK);
        }
        // -------------------------------------------------


        // Template-Extension installieren
        // -------------------------------------------------
        if($installTheme) {
            $this->installTheme($templateDir);
        }


//        $headline = $this->lang('templateCreatedMessageOkHeadline');
//        $message  = $this->lang('templateCreatedMessageOkMessage');
//        $this->addFlashMessage($message, $headline, FlashMessage::OK);

        // Im Fehlerfall
//        else {
//            $headline = $this->lang('templateCreatedMessageWarningHeadline');
//            $message  = $this->lang('templateCreatedMessageWarningMessage');
//            $this->addFlashMessage($message, $headline, FlashMessage::WARNING);
//        }

        $this->redirect('list');
    }

    protected function installTheme($extension) {
        /**
         * @var \TYPO3\CMS\Extensionmanager\Service\ExtensionManagementService $managementService
         */
        $managementService = $this->objectManager->get('TYPO3\\CMS\\Extensionmanager\\Service\\ExtensionManagementService');

        /**
         * @var \TYPO3\CMS\Extensionmanager\Utility\ExtensionModelUtility $extensionModelUtility
         */
        $extensionModelUtility = $this->objectManager->get('TYPO3\\CMS\\Extensionmanager\\Utility\\ExtensionModelUtility');

        /**
         * @var \TYPO3\CMS\Extensionmanager\Utility\InstallUtility $installUtility
         */
        $installUtility = $this->objectManager->get('TYPO3\\CMS\\Extensionmanager\\Utility\\InstallUtility');

        // install
        $managementService->resolveDependenciesAndInstall(
            $extensionModelUtility->mapExtensionArrayToModel(
                $installUtility->enrichExtensionWithDetails($extension)
            )
        );
    }

}
?>