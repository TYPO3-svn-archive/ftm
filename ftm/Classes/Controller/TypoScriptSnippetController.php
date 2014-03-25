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

/**
 *
 *
 * @package ftm
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class TypoScriptSnippetController extends PluginCloudBaseController {
    
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
                $headline = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_headline", 'Ftm');
                $message  = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_message1", 'Ftm', array($snippetFile)). '<br />';
                $message .= LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_message2", 'Ftm', array($absPath.$snippetFile));
                $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
            }

            $messages = '<br />'.str_replace('|', '<br />', $result['messages']);
            $headline = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.typoscript_snippet_saved_headline", 'Ftm');
            $message  = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.typoscript_snippet_saved_message", 'Ftm', array($snippet->getName()));
            $this->flashMessageContainer->add($message.$messages, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
        }
        else {
            $errors = '<br />'.str_replace('|', '<br />', $result['errors']);
            $headline = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_snippet_not_saved_headline", 'Ftm');
            $message  = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_snippet_not_saved_message", 'Ftm', array($snippet->getName()));
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
                        $snippet->setPublicReadable($tempSnippet['publicReadable']);
                        $snippet->setPublicWriteable($tempSnippet['publicWriteable']);
                        
                        $this->fluidTemplateTypoScriptSnippetRepository->update($snippet);
                        
                        $headline = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.typoscript_snippet_included_headline", 'Ftm');
                        $message  = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.typoscript_snippet_included_message", 'Ftm', array($snippetName, $snippet->getName())) . '<br />';
                        $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
                        
                        $error = '';
                        break;
                    }
                    
                }
            }
            else {
                $error = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_snippets_not_synchronized", 'Ftm');
            }
        }
        else {
            $error = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_snippets_not_synchronized", 'Ftm');
        }
        
        if($error!='') {
            $headline = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_snippet_not_included_headline", 'Ftm');
            $message  = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_typoscript_snippet_not_included_message", 'Ftm', array($snippetName, $snippet->getName(), $error));
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
            $filepath   = "uploads/tx_ftm/";
            $relPath    = $filepath;
            $absPath    = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);

            // TypoScriptSnippets schreiben
            $snippetFile       = "typoScriptSnippets.serialized";
            $snippetsSerialized = $result['typoScriptSnippets'];
            
            \CodingMs\Ftm\Service\Backup::backupFile($this->fluidTemplate, $absPath.$snippetFile);
            if(!file_put_contents($absPath.$snippetFile, $snippetsSerialized)) {
                $headline = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_headline", 'Ftm');
                $message  = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_message1", 'Ftm', array($snippetFile)) . '<br />';
                $message .= LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_message2", 'Ftm', array($absPath.$snippetFile));
                $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
            }
            else {
                $headline = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.snippets_read_headline", 'Ftm');
                $message  = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.snippets_read_message", 'Ftm');
                $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
            }
        }
        else {
            $errors = '<br />'.str_replace('|', '<br />', $result['errors']);
            $headline = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_read_headline", 'Ftm');
            $message  = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_read_message", 'Ftm');
            $this->flashMessageContainer->add($message.$errors, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
        }
        
        $this->redirect('list', 'TemplateManager', NULL, array());
    }

}
?>