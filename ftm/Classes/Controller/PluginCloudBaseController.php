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
class PluginCloudBaseController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

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

        // TYPO3-Version ermitteln
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

        $tables = array();
        $tables[] = 'tx_ftm_domain_model_templatetyposcriptsnippet';
        $tables[] = 'tx_ftm_domain_model_templatedyncssfile';
        $tables[] = 'tx_ftm_domain_model_templatefluidfile';

        // Delete wurde hier nicht auf gefangen
        if ($command == 'delete' && in_array($table, $tables)) {
        }
        else if ($command == 'update' && in_array($table, $tables)) {

            // Zugehöriges Template und Verzeichnis ermitteln
            $template = \CodingMs\Ftm\Service\Template::getTemplate($reference->checkValue_currentRecord['pid']);

            // Extension-Konfiguration
            $extConf = \CodingMs\Ftm\Service\ExtensionConfiguration::getConfiguration();

            // Dateiname ermitteln, der könnte sich geändert haben
            $saveInFilename = $this->getProcessDatamapValue($fieldArray, $reference, 'filename');

            /**
             * @todo: hier muss nach einem validen Dateinamen geprüft werden,
             * auch ob nicht aus dem verzeichnis ausgebrochen wird
             */

            // TypoScript-Snippet: Auto-Save aktiviert
            if($table == 'tx_ftm_domain_model_templatetyposcriptsnippet' && $extConf['rewriteTypoScriptSnippetFileAfterUpdateDataset']) {
                $setupDir = \CodingMs\Ftm\Utility\Tools::getDirectory('TypoScriptLibrary', $template->getTemplateDir(), TRUE);
                $setup = $this->getProcessDatamapValue($fieldArray, $reference, 'filename');
                file_put_contents($setupDir.$saveInFilename, $setup);
            }


            // DynCss-File: Auto-Save aktiviert
            if($table == 'tx_ftm_domain_model_templatedyncssfile' && $extConf['rewriteDynCssFileAfterUpdateDataset']) {

                $dynCssDir = \CodingMs\Ftm\Utility\Tools::getDirectory('DynCssFiles', $template->getTemplateDir(), TRUE);
                $dynCss = $this->getProcessDatamapValue($fieldArray, $reference, 'dyn_css');
                file_put_contents($dynCssDir.$saveInFilename, $dynCss);

                $dynCssVariablesDir = \CodingMs\Ftm\Utility\Tools::getDirectory('DynCssVariables', $template->getTemplateDir(), TRUE);
                $dynCssVariables = $this->getProcessDatamapValue($fieldArray, $reference, 'variables');
                file_put_contents($dynCssVariablesDir.$saveInFilename, $dynCssVariables);

                    /**
                     * @todo import.less neu schreiben
                     */
            }


//            \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($themeDir);
//
//            /**
//             * @todo: über config wird entschieden, od datensätze immer nach dem
//             * speichern auch in dateien geschrieben werden sollen
//             */
//
//            var_dump($themeDir, $fieldArray, $extConf['rewriteDynCssFileAfterUpdateDataset'], $saveInFilename, $reference->checkValue_currentRecord['pid'], $reference->checkValue_currentRecord);
//            exit;
        }

        // Neue Snippets immer automatisch zum Template zuordnen
        else if ($command == 'new' && in_array($table, $tables)) {

            /**
             * @todo: Datei schreiben, sofern option aktiviert
             */

            // Zugehöriges Template ermitteln
            $template = \CodingMs\Ftm\Service\Template::getTemplate($fieldArray['pid']);

            // MM-Eintrag schreiben
            $mmArray = array();
            $mmArray['uid_local'] = (int)$template->getUid();
            $mmArray['uid_foreign'] = (int)$reference->substNEWwithIDs[$id];
            $mmArray['sorting'] = 9999;
            $GLOBALS['TYPO3_DB']->exec_INSERTquery($table.'_mm', $mmArray);
        }

    }

    protected function getProcessDatamapValue($fieldArray, $reference, $key) {
        if(isset($fieldArray[$key]) && trim($fieldArray[$key])!='') {
            return $fieldArray[$key];
        }
        else if(isset($reference->checkValue_currentRecord[$key]) && trim($reference->checkValue_currentRecord[$key])!='') {
            return $reference->checkValue_currentRecord[$key];
        }
        return '';
    }

}
?>