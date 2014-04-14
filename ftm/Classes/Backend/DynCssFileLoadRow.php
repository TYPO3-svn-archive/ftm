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
 * Loads a Dyncss file
 *
 * @package    TYPO3
 * @subpackage    ftm
 */
class DyncssFileLoadRow {

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



        $langPrefix = 'LLL:EXT:ftm/Resources/Private/Language/locallang_db_templatedyncssfile.xlf:tx_ftm_templatedyncssfile.';
                
        $script     = '';
        $preview    = '';
        $insertLink = '';
        $snippetFolder = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName("uploads/tx_ftm/");

        if(@file_exists($snippetFolder.'dyncssFiles.serialized')) {
            $snippetsSerialized = file_get_contents($snippetFolder.'dyncssFiles.serialized');
            $snippetsArray = unserialize($snippetsSerialized);

            if(is_array($snippetsArray) && !empty($snippetsArray)) {

                $selectionLabel = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($langPrefix."include_from_plugincloud", "Ftm");
                $snippetSelection = "<span><strong>".$selectionLabel."</strong></span><br />".LF;
                $snippetSelection.= "<select id=\"ftm_insertSnippetSelect_".$uid."\" size=\"10\" onchange=\"ftm_showSnippetPreview_".$uid."(this.id);return false;\">".LF;

                $snippetOwn = '';
                $snippetOther = '';

                foreach($snippetsArray as $snippet) {

                    // Vorschau
                    $previewText = "Description:\n";
                    $previewText.= "----------------------------------------------------------------\n";
                    $previewText.= base64_decode(strip_tags($snippet['description']));
                    $previewText.= "\n";
                    $previewText.= "\n";
                    $previewText.= "Dyncss:\n";
                    $previewText.= "----------------------------------------------------------------\n";
                    $previewText.= base64_decode($snippet['dyncss']);
                    $previewText.= "\n";
                    $previewText.= "\n";
                    $previewText = htmlentities($previewText);

                    $snippetDesc = substr(html_entity_decode(strip_tags(base64_decode($snippet['description']))), 0, 40);
                    if(strlen($snippetDesc)==40) {
                        $snippetDesc.= '...';
                    }

                    $tempLabel = $snippet['type']." - ".$snippet['name']." - ".$snippetDesc;
                    if($snippet['own']) {
                        $snippetOwn.= "<option value=\"".$snippet['name']."\" data-description=\"".$previewText."\">".$tempLabel."</option>".LF;
                    }
                    else {
                        $snippetOther.= "<option value=\"".$snippet['name']."\" data-description=\"".$previewText."\">".$tempLabel."</option>".LF;
                    }
                }

                $snippetOwnLabel = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($langPrefix."own_files", "Ftm");
                $snippetOtherLabel = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($langPrefix."foreign_files", "Ftm");

                $snippetSelection.= "<optgroup label=\"".$snippetOwnLabel."\">".$snippetOwn."</optgroup>";
                $snippetSelection.= "<optgroup label=\"".$snippetOtherLabel."\">".$snippetOther."</optgroup>";
                $snippetSelection.= "</select>".LF;



                // JavaScript zum Anpassen des Insert-Links
                $script = '<script type="text/javascript">'.LF;

                $script.= 'function ftm_showSnippetPreview_'.$uid.'(select) {'.LF;
                $script.= '  var allOptions = document.getElementById(select).getElementsByTagName(\'option\');'.LF;
                $script.= '  for(var i=0; i<allOptions.length; i++) {'.LF;
                $script.= '    if (allOptions[i].selected ) {'.LF;
                // $script.= '        console.log( allOptions[i].getAttribute(\'data-description\') );'.LF;
                $script.= '        document.getElementById(\'ftm_insertSnippetPreview_'.$uid.'\').innerHTML = allOptions[i].getAttribute(\'data-description\');'.LF;
                $script.= '    }'.LF;
                $script.= '  }'.LF;
                $script.= '}'.LF;

                $script.= 'function ftm_generateInsertSnippetLink_'.$uid.'() {'.LF;
                $script.= '  var tempValue  = document.getElementById("ftm_insertSnippetSelect_'.$uid.'").value;'.LF;
                // $script.= '  console.log(tempValue);'.LF;
                $script.= '  var tempHref   = document.getElementById("ftm_insertSnippetLink_'.$uid.'").href;'.LF;
                // $script.= '  console.log(tempHref);'.LF;
                $script.= '  var tempAdd    = "&tx_ftm_web_ftmftm[snippetName]="+tempValue;'.LF;
                $script.= '  document.getElementById("ftm_insertSnippetLink_'.$uid.'").href = tempHref+tempAdd;'.LF;
                // $script.= '  console.log(tempAdd);'.LF;
                $confirmQuestion = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($langPrefix."confirm_overwrite", "Ftm");
                $script.= 'return confirm("'.$confirmQuestion.'");}'.LF;
                $script.= '</script>'.LF;


                // Insert-Link
                $insertHref = '/typo3/mod.php';
                $insertHref.= '?M=web_FtmFtm';
                $insertHref.= '&amp;id='.$pid.'';
                $insertHref.= '&amp;tx_ftm_web_ftmftm[action]=insertSnippet';
                $insertHref.= '&amp;tx_ftm_web_ftmftm[controller]=TypoScriptSnippet';
                $insertHref.= '&amp;tx_ftm_web_ftmftm[snippet]='.$uid;
                $insertLabel = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($langPrefix."include_now", "Ftm");
                $insertLink = '<a href="'.$insertHref.'" id="ftm_insertSnippetLink_'.$uid.'" onclick="ftm_generateInsertSnippetLink_'.$uid.'()">';
                $insertLink.= '<span class="t3-icon t3-icon-actions t3-icon-actions-document t3-icon-document-paste-after">&nbsp;</span> '.$insertLabel;
                $insertLink.= '</a>';

                // Vorschau/Beschreibung
                $previewLabel = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($langPrefix."preview", "Ftm");
                $previewStyles = "resize: vertical;display: block;height: 320px;width: 100%;border: 1px solid #666;overflow-y: scroll;";
                $preview = "<div style=\"font-weight:bold; margin-top: 16px\">".$previewLabel.":</div>";
                $preview.= "<textarea id=\"ftm_insertSnippetPreview_".$uid."\" style=\"".$previewStyles."\"></textarea>".LF;
            }
            else {
                $snippetSelection = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($langPrefix."no_dyncss_file_exists", "Ftm");
            }
        }
        else {
            $syncHref = '/typo3/mod.php';
            $syncHref.= '?M=web_FtmFtm';
            $syncHref.= '&amp;id='.$pid.'';
            $syncHref.= '&amp;tx_ftm_web_ftmftm[action]=loadFiles';
            $syncHref.= '&amp;tx_ftm_web_ftmftm[controller]=Dyncss';
            $noSnippetsLabel = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($langPrefix."no_saved_dyncss_file_exists", "Ftm");
            $syncLinkLabel = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($langPrefix."synchronize_dyncss_files_message", "Ftm");
            $snippetSelection = $noSnippetsLabel." <a href=\"".$syncHref."\"><span style=\"color: red\">".$syncLinkLabel."</span></a>";
        }

        $infotext = $script.$snippetSelection." ".$insertLink.$preview."<br /><br />";

        return $infotext;
    }


    protected function wikiLink($link, $label) {
        $wikiLink = "http://fluid-template-manager.de/documentation/";
        return "<a href=\"".$wikiLink.$link."\" target=\"_blank\"><u>".$label."</u></a>";
    }

}

?>