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
    protected $preview = '_preview';

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

        $this->setup.= "page = PAGE\n";
        $this->setup.= "<INCLUDE_TYPOSCRIPT: source=\"DIR:EXT:".$template->getTemplateDir()."/Configuration/TypoScript/Library/\">\n";

        $this->setup.= "page {\n";
        $this->setup.= "  typeNum = 0\n";
        $this->setup.= "  10 = FLUIDTEMPLATE\n";
        $this->setup.= "  10 {\n";
        $this->setup.= "    file {\n";
        $this->setup.= "      stdWrap.cObject = TEXT\n";
        $this->setup.= "      stdWrap.cObject {\n";
        $this->setup.= "        data = levelfield:-1, backend_layout_next_level, slide\n";
        $this->setup.= "        override.field = backend_layout\n";

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
                $this->setup.= "        ftm__".$key." = TEXT\n";
                $this->setup.= "        ftm__".$key.".value = {\$plugin.tx_themes.resourcesPrivatePath}Templates/".$name.".html\n";
                $this->setup.= "        ftm__".$key.".insertData = 1\n";
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

        //$this->setup.= "        split {\n";
        //$this->setup.= "          token = file__\n";
        //$this->setup.= "          1.current = 1\n";
        //$this->setup.= "          1.wrap = |\n";
        //$this->setup.= "        }\n";
        //$this->setup.= "        wrap = {\$plugin.tx_themes.resourcesPrivatePath}Templates/|.html\n";
        $this->setup.= "      }\n";

        // Wenn keine BackendLayouts gefunden wurden
        $this->setup.= "      stdWrap.ifEmpty.cObject = TEXT\n";
        $this->setup.= "      stdWrap.ifEmpty.cObject {\n";
        $this->setup.= "        value = {\$plugin.tx_themes.resourcesPrivatePath}Error.html\n";
        $this->setup.= "      }\n";

        $this->setup.= "    }\n";
        $this->setup.= "    layoutRootPath = {\$plugin.tx_themes.resourcesPrivatePath}Layouts/\n";
        $this->setup.= "    partialRootPath = {\$plugin.tx_themes.resourcesPrivatePath}Partials/\n";

        // Fluid-Variables
        $this->setup.= "    variables {\n";
        $this->setup.= "    }\n";

        $this->setup.= "  }\n";
        $this->setup.= "}\n";

        // Include DynCss
        $this->setup.= "page.includeCSS {\n";
        $this->setup.= "  import = {\$plugin.tx_themes.resourcesPrivatePath}DynCss/import.less\n";
        $this->setup.= "}\n";
        $this->setup.= "<INCLUDE_TYPOSCRIPT: source=\"FILE:EXT:".$template->getTemplateDir()."/Configuration/TypoScript/setupCustom.ts\">\n";

        // Save Configuration/setup.ts
        $dir = \CodingMs\Ftm\Utility\Tools::getDirectory('TypoScript', $template->getTemplateDir(), TRUE);
        return file_put_contents($dir.'setup'.$this->preview.'.ts', $this->setup);
    }


}