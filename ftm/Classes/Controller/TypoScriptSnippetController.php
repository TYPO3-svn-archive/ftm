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
class TypoScriptSnippetController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

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
     * Template-TypoScriptSnippet Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\TemplateTypoScriptSnippetRepository
     */
    protected $fluidTemplateTypoScriptSnippetRepository;

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
    protected $debug = '';

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
     * injectTemplateTypoScriptSnippetRepository
     *
     * @param \CodingMs\Ftm\Domain\Repository\TemplateTypoScriptSnippetRepository $fluidTemplateTypoScriptSnippetRepository
     * @return void
     */
    public function injectTemplateTypoScriptSnippetRepository(\CodingMs\Ftm\Domain\Repository\TemplateTypoScriptSnippetRepository $fluidTemplateTypoScriptSnippetRepository) {
        $this->fluidTemplateTypoScriptSnippetRepository = $fluidTemplateTypoScriptSnippetRepository;
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
        \CodingMs\Ftm\Service\ExtensionConfiguration::validate($this->extConf);
        
        // Aktuelle Page auslesen
        $this->pid = intval(\TYPO3\CMS\Core\Utility\GeneralUtility::_GET('id'));
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
            $this->fluidTemplate = \CodingMs\Ftm\Service\Template::getTemplate($this->pid);
            if($this->fluidTemplate instanceof \CodingMs\Ftm\Domain\Model\Template) {
                
                
                // Strukture-Service, entsprechend des Template-Typens erstellen
                if($this->fluidTemplate->getTemplateType()=='yaml') {
                    $this->templateStructureService = $this->objectManager->create('CodingMs\Ftm\Service\TemplateStructureYaml');
                }
                elseif($this->fluidTemplate->getTemplateType()=='bootstrap') {
                    $this->templateStructureService = $this->objectManager->create('CodingMs\Ftm\Service\TemplateStructureBootstrap');
                }
                elseif($this->fluidTemplate->getTemplateType()=='bootstrap_3') {
                    $this->templateStructureService = $this->objectManager->create('CodingMs\Ftm\Service\TemplateStructureBootstrap');
                }
                else {
                    $this->templateStructureService = $this->objectManager->create('CodingMs\Ftm\Service\TemplateStructure');
                }
                
            }
            
        }
        
        
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
     * Merkt sich ein Snippet auf dem FTM-Server
     *
     * @author Thomas Deuling <typo3@coding.ms>
     * @param \CodingMs\Ftm\Domain\Model\TemplateTypoScriptSnippet $snippet
     * @return void
     * @since 1.0.4
     */
    public function saveSnippetAction(\CodingMs\Ftm\Domain\Model\TemplateTypoScriptSnippet $snippet) {
        
        // Infos fuer WebService ermitteln
        $data = $snippet->toArray();
        $data['typo3Version'] = $typo3Version;
        $data['ftmVersion']   = FTM_VERSION;
        
        $result = $this->pluginService->executeAction("saveSnippet", $data);
        if($result['status']=='success') {
            
             // Pfad ermitteln
            $typoScript = '';
            $messageOk  = '';
            $filepath   = "uploads/tx_ftm/";
            $relPath    = $filepath;
            $absPath   = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);

            // Snippets zum Speichern vorbereiten
            $snippetFile       = "typoScriptSnippets.serialized";
            $snippetsSerialized = $result['typoScriptSnippets'];
            
            // Backuppen und neu schreiben
            \CodingMs\Ftm\Service\Backup::backupFile($this->fluidTemplate, $absPath.$snippetFile);
            if(!file_put_contents($absPath.$snippetFile, $snippetsSerialized)) {
                $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_headline", 'Ftm');
                $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_message1", 'Ftm', array($snippetFile)). '<br />';
                $message .= \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_message2", 'Ftm', array($absPath.$snippetFile));
                $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
            }
            
            $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.typoscript_snippet_saved_headline", 'Ftm');
            $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.typoscript_snippet_saved_message", 'Ftm', array($snippet->getName()));
            $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
        }
        else {
            $errors = '<br />'.str_replace('|', '<br />', $result['errors']);
            $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_snippet_not_saved_headline", 'Ftm');
            $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_snippet_not_saved_message", 'Ftm', array($snippet->getName()));
            $this->flashMessageContainer->add($message.$errors, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
        }
        
        $editParams = "&edit[tx_ftm_domain_model_templatetyposcriptsnippet][".$snippet->getUid()."]=edit";
        $editOnClick = \TYPO3\CMS\Backend\Utility\BackendUtility::editOnClick($editParams);
        $editOnClick = str_replace(array("window.location.href='", "'; return false;"), '', $editOnClick);
        $editOnClick = urldecode($editOnClick);
        $this->redirectToUri($editOnClick);
    }

    /**
     * Setzt ein Snippet vom FTM-Server ein
     *
     * @author Thomas Deuling <typo3@coding.ms>
     * @param \CodingMs\Ftm\Domain\Model\TemplateTypoScriptSnippet $snippet
     * @param string $snippetName
     * @return void
     * @since 1.0.4
     */
    public function insertSnippetAction(\CodingMs\Ftm\Domain\Model\TemplateTypoScriptSnippet $snippet, $snippetName) {
        
        // Standard Error
        $error = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_snippet_not_found", 'Ftm');
        
        // Snippets auslesen
        $snippetFolder   = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName("uploads/tx_ftm/");
        if(@file_exists($snippetFolder)) {
            $snippetsSerialized = file_get_contents($snippetFolder.'typoScriptSnippets.serialized');
            $snippetsArray = unserialize($snippetsSerialized);
            
            // Snippet suchen
            if(is_array($snippetsArray) && !empty($snippetsArray)) {
                foreach($snippetsArray as $tempSnippet) {

                    if($tempSnippet['name']==$snippetName) {
                        
                        $snippet->setName($tempSnippet['name']);
                        $snippet->setType($tempSnippet['type']);
                        $snippet->setDescription(base64_decode($tempSnippet['description']));
                        $snippet->setConstants($this->removeSlashes(base64_decode($tempSnippet['constants'])));
                        $snippet->setSetup($this->removeSlashes(base64_decode($tempSnippet['setup'])));
                        
                        $this->fluidTemplateTypoScriptSnippetRepository->update($snippet);
                        
                        $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.typoscript_snippet_included_headline", 'Ftm');
                        $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.typoscript_snippet_included_message", 'Ftm', array($snippetName, $snippet->getName())) . '<br />';
                        $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
                        
                        $error = '';
                        break;
                    }
                    
                }
            }
            else {
                $error = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_snippets_not_synchronized", 'Ftm');
            }
        }
        else {
            $error = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_snippets_not_synchronized", 'Ftm');
        }
        
        if($error!='') {
            $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_snippet_not_included_headline", 'Ftm');
            $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_snippet_not_included_message", 'Ftm', array($snippetName, $snippet->getName(), $error));
            $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
        }
        
        $editParams = "&edit[tx_ftm_domain_model_templatetyposcriptsnippet][".$snippet->getUid()."]=edit";
        $editOnClick = \TYPO3\CMS\Backend\Utility\BackendUtility::editOnClick($editParams);
        $editOnClick = str_replace(array("window.location.href='", "'; return false;"), '', $editOnClick);
        $editOnClick = urldecode($editOnClick);
        $this->redirectToUri($editOnClick);
    }

    protected function removeSlashes($text) {
        $text = str_replace("\\n", "\n", $text);
        $text = str_replace("\\r", "\r", $text);
        $text = str_replace("\\\"", "\"", $text);
        return $text;
    }

    /**
     * Liest alle TYPOScript-Snippets vom FTM-Server
     *
     * @author Thomas Deuling <typo3@coding.ms>
     * @return void
     * @since 1.0.4
     */
    public function loadSnippetsAction() {
        
        // Infos fuer WebService ermitteln
        $data = array();
        $data['typo3Version'] = $this->typo3Version;
        $data['ftmVersion']   = FTM_VERSION;
        
        $result = $this->pluginService->executeAction("loadSnippets", $data);
        if($result['status']=='success') {
            
             // Pfad ermitteln
            $typoScript = '';
            $messageOk  = '';
            $filepath   = "uploads/tx_ftm/";
            $relPath    = $filepath;
            $absPath    = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);

            // TypoScriptSnippets schreiben
            $snippetFile       = "typoScriptSnippets.serialized";
            $snippetsSerialized = $result['typoScriptSnippets'];
            
            \CodingMs\Ftm\Service\Backup::backupFile($this->fluidTemplate, $absPath.$snippetFile);
            if(!file_put_contents($absPath.$snippetFile, $snippetsSerialized)) {
                $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_headline", 'Ftm');
                $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_message1", 'Ftm', array($snippetFile)) . '<br />';
                $message .= \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_message2", 'Ftm', array($absPath.$snippetFile));
                $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
            }
            else {
                $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.snippets_read_headline", 'Ftm');
                $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.snippets_read_message", 'Ftm');
                $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
            }
        }
        else {
            $errors = '<br />'.str_replace('|', '<br />', $result['errors']);
            $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_read_headline", 'Ftm');
            $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_read_message", 'Ftm');
            $this->flashMessageContainer->add($message.$errors, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
        }
        
        $this->redirect('list', 'TemplateManager', NULL, array());
    }

        /**
     * @param   string      $command: The command which has been sent to processDatamap
     * @param   string      $table: The table we're dealing with
     * @param   mixed       $id: Either the record UID or a string if a new record has been created
     * @param   array       $fieldArray: The record row how it has been inserted into the database
     * @param   object      $reference: A reference to the TCEmain instance
     * @return  void
     * 
     * Erfordert in ext_localconf.php:
       $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] 
       = 'EXT:coding_ms_tyma/Classes/Controller/MagentoProductController.php:Tx_CodingMsTyma_Controller_MagentoProductController';
     * 
     */
    public function processDatamap_afterDatabaseOperations($command, $table, $id, &$fieldArray, \TYPO3\CMS\Core\DataHandling\DataHandler &$reference) {
        
        // Delete wurde hier nicht auf gefangen
        if ($command == 'delete' && $table == 'tx_ftm_domain_model_templatetyposcriptsnippet') {
        }
        else if ($command == 'update' && $table == 'tx_ftm_domain_model_templatetyposcriptsnippet') {
        }
        
        // Neue Snippets immer automatisch zum Template zuordnen
        else if ($command == 'new' && $table == 'tx_ftm_domain_model_templatetyposcriptsnippet') {
            
            // Zugehöriges Template ermitteln
            $template = \CodingMs\Ftm\Service\Template::getTemplate($fieldArray['pid']);
            
            // MM-Eintrag schreiben
            $mmArray = array();
            $mmArray['uid_local'] = (int)$template->getUid();
            $mmArray['uid_foreign'] = (int)$reference->substNEWwithIDs[$id];
            $mmArray['sorting'] = 9999;
            $GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_ftm_domain_model_templatetyposcriptsnippet_mm', $mmArray);
        }
        
    }
    
}
?>