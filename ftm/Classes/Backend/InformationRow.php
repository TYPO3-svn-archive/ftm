<?php
namespace CodingMs\Ftm\Backend;

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
 * Class that renders a selection field for Fluid FCE template selection
 * Abgeschaut bei FCESelector der fed-Extension
 *
 * @package    TYPO3
 * @subpackage    ftm
 */
class InformationRow {

    /**
     * Render a Flexible Content Element type selection field
     *
     * @param array $parameters
     * @param mixed $parentObject
     * @return string
     */
    public function renderField(array &$parameters, &$parentObject) {
            
            
        // Vars
        $uid   = $parameters["row"]["uid"];
        $pid   = $parameters["row"]["pid"];
        $name  = $parameters['itemFormElName'];
        $value = $parameters['itemFormElValue'];
        $imagePath = "/typo3conf/ext/ftm/Resources/Public/Icons/";
        
        // foreach ($parameters as $key => $value) {
            // $select .= $key."<br>";
        // }
        
        // echo "<pre>";
        // var_dump(&$parameters["row"]);
        // echo "</pre>";
        // die(serialize(&$parentObject['_THIS_UID']));
        
        
        if($parameters['field']=="less_variable_info") {
            $infotext = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_informationrow.less_variable_info", "Ftm", array('<b>@baseUrl</b>', '<b>@baseUrlTemplate</b>', '<b>@templateDir</b>', '<b>@baseUrlImage</b>', '<b>@{baseUrlTemplate}img/</b>', '<b>@{baseUrl}typo3conf/ext/@{templateDir}/template/img</b>', $this->wikiLink('Css-Less.html', \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_informationrow.link_here", "Ftm"))));
 
        }
        
        else if($parameters['field']=="typo_script_snippet_info") {
            $infotext = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_templatetyposcriptsnippet.typoscript_snippet_info", "Ftm", array($this->wikiLink('TypoScriptSnippets.html', \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_informationrow.link_here", "Ftm"))));
        }
        

        
        return $infotext;
    }


    protected function wikiLink($link, $label) {
        $wikiLink = "http://fluid-template-manager.de/documentation/";
        return "<a href=\"".$wikiLink.$link."\" target=\"_blank\"><u>".$label."</u></a>";
    }

}

?>