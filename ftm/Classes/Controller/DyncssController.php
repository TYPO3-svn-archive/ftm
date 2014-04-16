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
class DyncssController extends PluginCloudBaseController {

    /**
     * Dyncss-Service
     * @var \CodingMs\Ftm\Service\Dyncss
     * @inject
     */
    protected $dyncssService;
    
    /**
     * Erstellt das dynamische CSS für ein FTM-Template
     *
     * @author Thomas Deuling <typo3@coding.ms>
     * @return void
     * @since 1.0.0
     */
    public function generateAction() {
        
        // Pruefen ob FTM-Template vorhanden
        if(!($this->fluidTemplate instanceof \CodingMs\Ftm\Domain\Model\Template)) {
            $headline = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_generated_headline", 'Ftm'); //Less-Variablen nicht re-/generiert!
            $message  = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_generated_message", 'Ftm'); //Die Less-Variablen konnte re-/generiert werden, da auf dieser Seite anscheinen noch kein FTM-Template existiert.
            $this->addFlashMessage($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
        }
        
        else {

            $this->dyncssService->generateImportFile($this->fluidTemplate);


//            // Dyncss-Typ
//            $dyncssType = $this->fluidTemplate->getConfig()->getDyncssType();
//
//            // Ziel-Verzeichnis identifizieren
//            $folderName = $this->fluidTemplate->getConfig()->getDyncssFolder();
//            $folderAbs = \CodingMs\Ftm\Utility\Tools::getDirectory($folderName."Basic", $this->fluidTemplate->getTemplateDir());
//
//            // Dynamisches CSS erstellen
//            $variables = '';
//            if($dyncssType=='less') {
//                $variables = $this->generateLess($this->fluidTemplate);
//            }
//            else if($dyncssType=='scss') {
//                $variables = $this->generateScss($this->fluidTemplate);
//            }
            
//            if($variables!='') {
//                // Variablen Speichern
//                $this->saveVariablesFile($variables, $folderAbs, $dyncssType);
//            }
//            else {
//                $headline = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_generated_headline", 'Ftm'); //Less-Variablen nicht re-/generiert!
//                $message  = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_generated_message1", 'Ftm') . '<br />'; //Die Less-Variablen konnte re-/generiert werden, es gab einen Fehler beim Aufruf des Generierungs-WebServices.
//                $message .= LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_generated_message2", 'Ftm'); //Bitte versuchen Sie es später noch einmal. Sollte der Fehler erneut auftreten kontaktieren Sie das Entwicklungs-Team.
//                $this->addFlashMessage($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
//            }
            
            
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
        return LocalizationUtility::translate($keyPrefix.".".$key, $extName);
    }

/**
     * Generiert die Less-Variablen
     * Variables.less
     *
     * @author     Thomas Deuling <typo3@coding.ms>
     * @return     string Less-Variablen
     * @since      22.11.2013
     */
    protected function generateLess($fluidTemplate, $folder='') {

        /**
         * @todo: diese müssen in die Constants verschoben werden
         */

        // Default-Variablen
        $lessVariable = "/* FTM - Less-Defaults: */\n";
        $lessVariable.= "@baseUrl         = \"".$this->fluidTemplate->getConfig()->getBaseUrl()."\";\n";
        $lessVariable.= "@baseUrlTemplate = \"".$this->fluidTemplate->getConfig()->getBaseUrl()."typo3conf/ext/".$this->fluidTemplate->getTemplateDir()."/\";\n";
        $lessVariable.= "@baseUrlImage    = \"".$this->fluidTemplate->getConfig()->getBaseUrl()."typo3conf/ext/".$this->fluidTemplate->getTemplateDir()."/Resources/Public/Images/\";\n";
        $lessVariable.= "@templateDir     = \"".$this->fluidTemplate->getTemplateDir()."\";\n";
        $lessVariable.= "\n";
        $lessVariable.= "/* FTM - Less-Customs: */\n";
        
        $variables = $fluidTemplate->getLessVariable();
        if($variables->count()>0) {
            foreach($variables as $variable) {
                
                $variableType = $variable->getVariableType();
                $variableName = $variable->getVariableName();
                $variableColor = $variable->getVariableColor();
                $variableValue = $variable->getVariableValue();
                $variableString = $variable->getVariableString();
                
                // Wenn Typ=Farbe
                if($variableType=='color') {
                    $lessVariable.= "@".$variableName." = ".$variableColor.";\n";
                }
                
                // Andernfalls immer als String behandeln
                else if($variableType=='value') {
                    $lessVariable.= "@".$variableName." = ".$variableValue.";\n";
                }
                
                // Andernfalls immer als String behandeln
                else {
                    $lessVariable.= "@".$variableName." = \"".$variableString."\";\n";
                }
            }
        }
        $lessVariable.= "\n";
        
        return $lessVariable;
    }

    /**
     * Speicher die Daten mit den dynamischen Variablen
     * 
     * @param string $data Variablen
     * @param string $filepath Pfad in dem die Datei liegen soll
     * @param string $type Typ: Less oder Scss
     * @return boolean TRUE oder FALSE
     */
    protected function saveVariablesFile($data, $filepath='', $type='less') {
        
        $success = FALSE;
        
        // Dateisname & Pfad
        $filename = "Variables.".$type;
        $relPath = $filepath.$filename;
        $absPath   = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
        
        // Versuche Datei zu aktualisieren
        \CodingMs\Ftm\Service\Backup::backupFile($this->fluidTemplate, $absPath);
        if(!file_put_contents($absPath, $data)) {
            $headline = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_saved_headline", 'Ftm'); //Less-Variablen wurden re-/generiert!
            $message  = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_saved_message1", 'Ftm') . '<br />'; //Die Less-Variablen für dieses FTM-Template wurde re-/generiert, konnte aber nicht in der ..Less/BasicLess/variables.less abgespeichert werden.
            $message .= LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_saved_message2", 'Ftm', array($absPath)); //Bitte prüfen die Datei/Pfad auf Korrektheit und Schreibrechte: $absPath
            $this->addFlashMessage($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
            $success = FALSE;
        }
        else {
            $headline = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.less_variables_generated_headline", 'Ftm'); //Less-Variablen wurden re-/generiert!
            $message  = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.less_variables_generated_message", 'Ftm'); //Die Less-Variablen für dieses FTM-Template wurde re-/generiert.
            $this->addFlashMessage($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
            $success = TRUE;
        }
        
        return $success;
    }

    /**
     * Liest alle Dyncss-Dateien vom FTM-Server
     *
     * @author Thomas Deuling <typo3@coding.ms>
     * @return void
     * @since 2.0.0
     */
    public function loadFilesAction() {

        // Infos fuer WebService ermitteln
        $data = array();
        $data['typo3Version'] = $this->typo3Version;
        $data['ftmVersion']   = FTM_VERSION;

        $result = $this->pluginService->executeAction("loadDyncssFiles", $data);
        if($result['status']=='success') {

            // Pfad ermitteln
            $filepath   = "uploads/tx_ftm/";
            $relPath    = $filepath;
            $absPath    = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);

            // TypoScriptSnippets schreiben
            $snippetFile       = "dyncssFiles.serialized";
            $snippetsSerialized = $result['dyncssFiles'];

            \CodingMs\Ftm\Service\Backup::backupFile($this->fluidTemplate, $absPath.$snippetFile);
            if(!file_put_contents($absPath.$snippetFile, $snippetsSerialized)) {
                $headline = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_headline", 'Ftm');
                $message  = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_message1", 'Ftm', array($snippetFile)) . '<br />';
                $message .= LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_saved_message2", 'Ftm', array($absPath.$snippetFile));
                $this->addFlashMessage($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
            }
            else {
                $headline = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.snippets_read_headline", 'Ftm');
                $message  = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.snippets_read_message", 'Ftm');
                $this->addFlashMessage($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
            }
        }
        else {
            $errors = '<br />'.str_replace('|', '<br />', $result['errors']);
            $headline = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_read_headline", 'Ftm');
            $message  = LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_snippets_not_read_message", 'Ftm');
            $this->addFlashMessage($message.$errors, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
        }

        $this->redirect('list', 'TemplateManager', NULL, array());
    }

}
?>