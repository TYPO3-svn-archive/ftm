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
 * Save a TYPOScript snippet
 *
 * @package    TYPO3
 * @subpackage    ftm
 */
class TypoScriptSnippetSaveRow {

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

        $snippetSaveUri = "/typo3/mod.php";
        $snippetSaveUri.= "?M=web_FtmFtm";
        $snippetSaveUri.= "&id=".$pid."";
        $snippetSaveUri.= "&tx_ftm_web_ftmftm[action]=saveSnippet";
        $snippetSaveUri.= "&tx_ftm_web_ftmftm[controller]=TypoScriptSnippet";
        $snippetSaveUri.= "&tx_ftm_web_ftmftm[snippet]=".$uid."";

        $langPrefix = 'LLL:EXT:ftm/Resources/Private/Language/locallang_db_templatetyposcriptsnippet.xlf:tx_ftm_templatetyposcriptsnippet.';
        $linkTitle = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($langPrefix."save_typoscript_snippet_in_plugincloud", "Ftm");
        $linkLabel = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($langPrefix."save_typoscript_snippet_in_plugincloud", "Ftm");

        $saveLink = "<a href=\"".$snippetSaveUri."\" title=\"".$linkTitle."\"><img src=\"".$imagePath."typoscript_snippet_save.png\"> <span>".$linkLabel."</span></a><br /><br />";

        return $saveLink;
    }


    protected function wikiLink($link, $label) {
        $wikiLink = "http://fluid-template-manager.de/documentation/";
        return "<a href=\"".$wikiLink.$link."\" target=\"_blank\"><u>".$label."</u></a>";
    }

}

?>