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
use \CodingMs\Ftm\Domain\Model\Template;
use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 *
 *
 * @package ftm
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class TypoScriptController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     * @var string File-Extension, empty string or _preview
     */
    protected $preview = ''; //'_preview';

    /**
     * @var string Generated Constants
     */
    protected $constants = '';

    /**
     * @var string Current Constants-Depth
     */
    protected $constantsDepth = 0;

    /**
     * @var string Generated Setup
     */
    protected $setup = '';

    /**
     * @var string Current Setup-Depth
     */
    protected $setupDepth = 0;

    /**
     * Extension-Konfiguration
     *
     * @var array
     */
    protected $extConf;

    /**
     * Generates a Template base TypoScript
     * @param Template $template
     */
    public function generateTypoScriptAction(Template $template) {

        // Extension-Konfiguration auslesen
        $this->extConf = \CodingMs\Ftm\Service\ExtensionConfiguration::getConfiguration();

        $constantsSuccess = $this->generateConstants($template);
        $setupSuccess = $this->generateSetup($template);

        $this->addFlashMessage('Konstanten wurde erfolgreich generiert', 'TypoScript erfolgreich generiert');

        $this->redirect('list', 'TemplateManager');

    }

    /**
     * Generates a Template base TypoScript
     * @param Template $template
     */
    protected function generateConstants(Template $template) {

        $constantsArray = $this->settings['templates'][$template->getTemplateType()]['constants'];
        $this->constants.= $this->getCommentHeader('constants', 'Constants for theme: '.$template->getTemplateDir());
        $this->constants.= "plugin.tx_themes {\n";
        $this->generateConstantRecursive($constantsArray);
        $this->constants.= "}\n";
        $this->constants.= "<INCLUDE_TYPOSCRIPT: source=\"DIR:EXT:".$template->getTemplateDir()."/Configuration/TypoScript/Constants/\">\n";
        $this->constants.= "<INCLUDE_TYPOSCRIPT: source=\"FILE:EXT:".$template->getTemplateDir()."/Configuration/TypoScript/constantsCustom.ts\">\n";

        // Save Configuration/constants.ts
        $dir = \CodingMs\Ftm\Utility\Tools::getDirectory('TypoScript', $template->getTemplateDir(), TRUE);
        return file_put_contents($dir.'constants'.$this->preview.'.ts', $this->constants);

    }

    protected function generateConstantRecursive($constantsArray) {

        if(!empty($constantsArray)) {
            foreach($constantsArray as $key=>$value) {
                if(count($value)==2 && array_key_exists('comment', $value) && array_key_exists('value', $value)) {
                    $this->constants.= $this->getSpaces($this->constantsDepth)."# ".$value['comment']."\n";
                    $this->constants.= $this->getSpaces($this->constantsDepth).$key." = ".$value['value']."\n";
                }
                else if(is_array($value)) {
                    $this->constants.= $this->getSpaces($this->constantsDepth).$key." {\n";
                    $this->constantsDepth++;
                    $this->generateConstantRecursive($value);
                    $this->constantsDepth--;
                    $this->constants.= $this->getSpaces($this->constantsDepth)."}\n";
                }
            }
        }

    }
    protected function getSpaces($depth=0) {
        $spaces = '';
        for($i=0 ; $i<=$depth ; $i++) {
            $spaces.= '  ';
        }
        return $spaces;
    }


    /**
     * Generates a Template base TypoScript
     * @param Template $template
     */
    protected function generateSetup(Template $template) {

        $this->setup.= $this->getCommentHeader('setup', 'Setup for theme: '.$template->getTemplateDir());

        $this->setup.= "page = PAGE\n";

        // Generate Content-Marker
        $this->setup.= $this->getCommentLine('Generate Content-Marker');
        $this->generateSetupContent();

        // Include libraries
        $this->setup.= $this->getCommentLine('Include libraries');
        $this->setup.= "<INCLUDE_TYPOSCRIPT: source=\"DIR:EXT:".$template->getTemplateDir()."/Configuration/TypoScript/Library/\">\n";

        // Generate Fluid-Template
        $this->setup.= $this->getCommentLine('Generate Fluid-Template');
        $this->setup.= "page {\n";
        $this->setup.= "  typeNum = 0\n";
        $this->setup.= "  10 = FLUIDTEMPLATE\n";
        $this->setup.= "  10 {\n";
        $this->setup.= "    file {\n";
        $this->setup.= "      stdWrap.cObject = CASE\n";
        $this->setup.= "      stdWrap.cObject {\n";
        $this->setup.= "        key.data = levelfield:-1, backend_layout_next_level, slide\n";
        $this->setup.= "        key.override.field = backend_layout\n";

        // Include BackendLayouts
        $default = 'MenuContentSidebar';
        if(isset($this->extConf['backendLayoutDefault'])) {
            $default = $this->extConf['backendLayoutDefault'];
        }

        $path = GeneralUtility::getFileAbsFileName('EXT:ftm/Resources/Private/BackendLayouts/');
        $filesOfDirectory = GeneralUtility::getFilesInDir($path, 'ts', TRUE, 1);
        foreach ($filesOfDirectory as $file) {

            $name = basename($file, ".ts");
            $key = GeneralUtility::camelCaseToLowerCaseUnderscored($name);

            if(isset($this->extConf['backendLayoutDisable'.$name]) && (int)$this->extConf['backendLayoutDisable'.$name]===0) {
                $this->setup.= "        pagets__".$key." = TEXT\n";
                $this->setup.= "        pagets__".$key.".value = {\$plugin.tx_themes.resourcesPrivatePath}Templates/".$name.".html\n";
                $this->setup.= "        pagets__".$key.".insertData = 1\n";
            }

            if($name==$default) {
                if(isset($this->extConf['backendLayoutDisableDefault']) && (int)$this->extConf['backendLayoutDisableDefault']===0) {
                    $key = 'default';
                    $this->setup.= "        ".$key." = TEXT\n";
                    $this->setup.= "        ".$key.".value = {\$plugin.tx_themes.resourcesPrivatePath}Templates/".$name.".html\n";
                    $this->setup.= "        ".$key.".insertData = 1\n";
                }
            }

        }
        $this->setup.= "      }\n";

        // Wenn keine BackendLayouts gefunden wurden
        $this->setup.= "      stdWrap.ifEmpty.cObject = TEXT\n";
        $this->setup.= "      stdWrap.ifEmpty.cObject {\n";
        $this->setup.= "        value = {\$plugin.tx_themes.resourcesPrivatePath}Templates/Error.html\n";
        $this->setup.= "      }\n";

        $this->setup.= "    }\n";
        $this->setup.= "    layoutRootPath = {\$plugin.tx_themes.resourcesPrivatePath}Layouts/\n";
        $this->setup.= "    partialRootPath = {\$plugin.tx_themes.resourcesPrivatePath}Partials/\n";

        // Damit nicht bei jedem f:translate der ExtensionName angegeben werden muss
        $this->setup.= "    extbase.controllerExtensionName = ".GeneralUtility::underscoredToUpperCamelCase($template->getTemplateDir())."\n";

        // Fluid-Variables
        $this->setup.= "    variables {\n";

        $this->setup.= "      pageTitle = TEXT\n";
        $this->setup.= "      pageTitle.data = page:title\n";

        $this->setup.= "    }\n";

        $this->setup.= "  }\n";
        $this->setup.= "}\n";

        // Include Dyncss
        $this->setup.= $this->getCommentLine('Include Dyncss');
        $this->setup.= "page.includeCSS {\n";
        $this->setup.= "  import = {\$plugin.tx_themes.resourcesPrivatePath}Dyncss/import.less\n";
        $this->setup.= "}\n";

        // Include custom setup
        $this->setup.= $this->getCommentLine('Include custom setup');
        $this->setup.= "<INCLUDE_TYPOSCRIPT: source=\"FILE:EXT:".$template->getTemplateDir()."/Configuration/TypoScript/setupCustom.ts\">\n";

        // Save Configuration/setup.ts
        $dir = \CodingMs\Ftm\Utility\Tools::getDirectory('TypoScript', $template->getTemplateDir(), TRUE);
        return file_put_contents($dir.'setup'.$this->preview.'.ts', $this->setup);
    }

    /**
     * Generiert das Meta-TypoScript
     *
     * @author     Thomas Deuling <typo3@coding.ms>
     * @return     string TypoScript
     * @since      22.11.2013
     */
//    protected function generateMetaTypoScript(Template $template) {
//
//        $typoScript = $this->getCommentLine('Page & Meta');
//
//        // Create Page
//        $typoScript.= "page = PAGE\n";
//        $typoScript.= "page.typeNum = 0\n";
//        $typoScript.= "\n";
//
//        $data = $template->getMeta()->toArray();
//
//        // Create Meta-Data
//        $inheritedFields = array('abstract', 'keywords', 'description', 'author', 'authorEmail');
//        if(!empty($data)) {
//            foreach($data as $metaKey => $metaValue) {
//
//                // Wenn in Dev-Mode wird automatisch gesetzt:
//                // page.meta.robots = noindex,nofollow
//                if($metaKey=='robots' && $template->getTemplateMode()=='development') {
//                    $typoScript.= "page.meta.robots = noindex,nofollow\n";
//                }
//                // Revisit-Key weicht ab
//                else if($metaKey=='revisit') {
//                    $typoScript.= "page.meta.revisit-after = ".$metaValue."\n";
//                }
//                // Canonical-Tag
//                else if($metaKey=='useCanonical') {
//                    // Spaeter behandeln
//                }
//                // Vererbbare Felder
//                else if(in_array($metaKey, $inheritedFields)) {
//
//                    if($metaKey=='authorEmail') {
//                        $metaKey = 'author_email';
//                    }
//
//                    $typoScript.= "page.meta.".$metaKey.".data = levelfield :-1, ".$metaKey.", slide\n";
//                    $typoScript.= "page.meta.".$metaKey.".override.data = page:".$metaKey."\n";
//                    $typoScript.= "page.meta.".$metaKey.".ifEmpty = ".$metaValue."\n";
//                    $typoScript.= "page.meta.".$metaKey.".".$metaKey." = 1\n";
//
//                    if($metaKey=='author') {
//                        $typoScript.= "page.meta.publisher.data = levelfield :-1, ".$metaKey.", slide\n";
//                        $typoScript.= "page.meta.publisher.override.data = page:".$metaKey."\n";
//                        $typoScript.= "page.meta.publisher.ifEmpty = ".$metaValue."\n";
//                        $typoScript.= "page.meta.publisher.publisher = 1\n";
//                    }
//
//                }
//                else {
//                    $typoScript.= "page.meta.".$metaKey." = ".$metaValue."\n";
//                }
//
//            }
//        }
//
//        $typoScript.= "page.meta.application-name = ".$template->getSiteName()." Website\n";
//
//
//
//        /*
//         *
//        http://www.carstenwalther.de/blog/details/typo3-seo-massnahmen-best-practice/
//        <meta content="2-3 Zeilen" name="description">
//<meta content="2-3 Zeilen" name="DC.Description">
//<meta content="5-10 Begriffe" name="keywords">
//<meta content="5-10 Begriffe" name="DC.Subject">
//         *
//           keywords.field = keywords
//       keywords.ifEmpty = IF-20, Extension, Plugin, Typo3, Extbase, Fluid
//       description.field = description
//       description.ifEmpty = Die IF-20-Extension auf Basis von Fluid/ExtBase für Ihr Typo3 Content Management System / CMS
//         */
//
//        // Footer/Separator
//        $typoScript.= $this->getCommentLine('End: Page & Meta');
//
//        return $typoScript;
//    }

    /**
     * Returns a comment line
     * @param string $comment
     * @return string
     */
    protected function getCommentLine($comment='') {
        $result = "\n";
        if($comment!='') {
            $result.= "# ".$comment."\n";
        }
        $result.= "#############################################\n";
        return $result;
    }


    /**
     * Returns a comment line
     * @param string $type setup/constants
     * @param string $comment
     * @return string
     */
    protected function getCommentHeader($type='setup', $comment='') {
        $result = "#\n";
        $result.= "# ".$comment."\n";
        $result.= "# \n";
        $result.= "# Auto-generated by Fluid-Template-Manager (ftm) ".date('Y-m-d H:i:m')."\n";
        $result.= "# \n";
        if($type=='constants') {
            $result.= "# More information about Constants:\n";
            $result.= "# http://wiki.typo3.org/TypoScript_Constants\n";
        }
        $result.= "#############################################\n";
        return $result;
    }

    protected function generateSetupContent() {
        $this->setup.= "# Insert colPos 0 in main content\n";
        $this->setup.= "lib.content.main = COA\n";
        $this->setup.= "lib.content.main {\n";
        $this->setup.= "  50 < styles.content.get\n";
        $this->setup.= "  50.select.where = colPos=0\n";
        $this->setup.= "}\n";
        $this->setup.= "# Insert colPos 1 in menu content\n";
        $this->setup.= "lib.content.menu = COA\n";
        $this->setup.= "lib.content.menu {\n";
        $this->setup.= "  stdWrap.prefixComment = 2|Output of lib.content.menu\n";
        $this->setup.= "  stdWrap.outerWrap = |\n";
        $this->setup.= "  10 =< lib.menu.sub\n";
        $this->setup.= "  50 < styles.content.get\n";
        $this->setup.= "  50.select.where = colPos=1\n";
        $this->setup.= "}\n";
        $this->setup.= "# Insert colPos 2 in menu content\n";
        $this->setup.= "lib.content.sidebar = COA\n";
        $this->setup.= "lib.content.sidebar {\n";
        $this->setup.= "  50 < styles.content.get\n";
        $this->setup.= "  50.select.where = colPos=2\n";
        $this->setup.= "}\n";
        $this->setup.= "# Insert colPos 3 in feature content\n";
        $this->setup.= "lib.content.feature = COA\n";
        $this->setup.= "lib.content.feature {\n";
        $this->setup.= "  50 < styles.content.get\n";
        $this->setup.= "  50.select.where = colPos=3\n";
        $this->setup.= "}\n";
        $this->setup.= "# Insert colPos 4 in extended content\n";
        $this->setup.= "lib.content.extended = COA\n";
        $this->setup.= "lib.content.extended {\n";
        $this->setup.= "  50 < styles.content.get\n";
        $this->setup.= "  50.select.where = colPos=4\n";
        $this->setup.= "}\n";
    }
}