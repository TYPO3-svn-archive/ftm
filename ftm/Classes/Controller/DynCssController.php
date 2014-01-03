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
class DynCssController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

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
            $this->fluidTemplate = $this->getTemplate();
            if($this->fluidTemplate instanceof \CodingMs\Ftm\Domain\Model\Template) {
                
                
                // Strukture-Service, entsprechend des Template-Typens erstellen
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
     * Erstellt das dynamische CSS für ein FTM-Template
     *
     * @author Thomas Deuling <typo3@coding.ms>
     * @return void
     * @since 1.0.0
     */
    public function generateAction() {
        
        // Pruefen ob FTM-Template vorhanden
        if(!($this->fluidTemplate instanceof \CodingMs\Ftm\Domain\Model\Template)) {
            $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_generated_headline", 'Ftm'); //Less-Variablen nicht re-/generiert!
            $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_generated_message", 'Ftm'); //Die Less-Variablen konnte re-/generiert werden, da auf dieser Seite anscheinen noch kein FTM-Template existiert.
            $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
        }
        
        else {
            
            // DynCss-Typ
            $dynCssType = $this->fluidTemplate->getConfig()->getDynCssType();
            
            // Ziel-Verzeichnis identifizieren
            $folderName = $this->fluidTemplate->getConfig()->getDynCssFolder();
            $folderAbs = \CodingMs\Ftm\Utility\Tools::getDirectory($folderName."Basic", $this->fluidTemplate->getTemplateDir());
            
            // Dynamisches CSS erstellen
            $variables = '';
            if($dynCssType=='less') {
                $variables = $this->generateLess($this->fluidTemplate);
            }
            else if($dynCssType=='scss') {
                $variables = $this->generateScss($this->fluidTemplate);
            }
            
            if($variables!='') {
                // Variablen Speichern
                $this->saveVariablesFile($variables, $folderAbs, $dynCssType);
            }
            else {
                $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_generated_headline", 'Ftm'); //Less-Variablen nicht re-/generiert!
                $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_generated_message1", 'Ftm') . '<br />'; //Die Less-Variablen konnte re-/generiert werden, es gab einen Fehler beim Aufruf des Generierungs-WebServices.
                $message .= \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_generated_message2", 'Ftm'); //Bitte versuchen Sie es später noch einmal. Sollte der Fehler erneut auftreten kontaktieren Sie das Entwicklungs-Team.
                $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
            }
            
            
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
     * Generiert die Less-Variablen
     * Variables.less
     *
     * @author     Thomas Deuling <typo3@coding.ms>
     * @return     string Less-Variablen
     * @since      22.11.2013
     */
    protected function generateLess($fluidTemplate, $folder='') {
        
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
            $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_saved_headline", 'Ftm'); //Less-Variablen wurden re-/generiert!
            $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_saved_message1", 'Ftm') . '<br />'; //Die Less-Variablen für dieses FTM-Template wurde re-/generiert, konnte aber nicht in der ..Less/BasicLess/variables.less abgespeichert werden.
            $message .= \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.error_less_variables_not_saved_message2", 'Ftm', array($absPath)); //Bitte prüfen die Datei/Pfad auf Korrektheit und Schreibrechte: $absPath
            $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
            $success = FALSE;
        }
        else {
            $headline = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.less_variables_generated_headline", 'Ftm'); //Less-Variablen wurden re-/generiert!
            $message  = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_controller_templatemanagercontroller.less_variables_generated_message", 'Ftm'); //Die Less-Variablen für dieses FTM-Template wurde re-/generiert.
            $this->flashMessageContainer->add($message, $headline, \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
            $success = TRUE;
        }
        
        return $success;
    }

}
?>