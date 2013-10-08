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
        
        // Allgemeine Extension-Informationen
        if($parameters['field']=="extensions_info") {
            $infotext = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_informationrow.extensions_info", "Ftm");
        }
        
        else if($parameters['field']=="extension_t3_less_info") {
            $infotext = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_informationrow.extension_t3less_info", "Ftm", array($this->wikiLink('Css-Less.html', \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_informationrow.link_here", "Ftm"))));
        }
        
        else if($parameters['field']=="less_variable_info") {
            $infotext = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_informationrow.less_variable_info", "Ftm", array('<b>@baseUrl</b>', '<b>@baseUrlTemplate</b>', '<b>@templateDir</b>', '<b>@baseUrlImage</b>', '<b>@{baseUrlTemplate}img/</b>', '<b>@{baseUrl}typo3conf/ext/@{templateDir}/template/img</b>', $this->wikiLink('Css-Less.html', \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_informationrow.link_here", "Ftm"))));
 
        }
        
        else if($parameters['field']=="marker_info") {
            $infotext = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_informationrow.marker_info", "Ftm", array($this->wikiLink('FluidMarker.html', \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_informationrow.link_here", "Ftm"))));
        }
        
        else if($parameters['field']=="marker_save") {
               
                
            $script     = "";
            $insertHref = "";
            $insertLink = "";
            
            $markerSelection = "";
            
            $snippetFolder = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName("uploads/tx_ftm/");
            
            
            if(@file_exists($snippetFolder.'marker.serialized')) {
                $markerSerialized = file_get_contents($snippetFolder.'marker.serialized');
                $markerArray = unserialize($markerSerialized);
                
                if(is_array($markerArray) && !empty($markerArray)) {
                    
                    $markerSelection = "<span><strong>" .\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_informationrow.include_from_template", "Ftm"). "</strong></span><br /><select id=\"ftm_insertMarkerSelect_".$uid."\">";
                    
                    foreach($markerArray as $marker) {
                        $markerSelection.= "<option value=\"".$marker['markerName']."\">lib.".$marker['markerName']." (".$marker['markerType'].") ".$marker['markerDescription']."</option>";
                    }
                    $markerSelection.= "</select>";
                    
                    // JavaScript zum Anpassen des Insert-Links
                    $script = '<script type="text/javascript">'.LF;
                    $script.= 'function ftm_generateInsertMarkerLink_'.$uid.'() {'.LF;
                    $script.= '  var tempValue  = document.getElementById("ftm_insertMarkerSelect_'.$uid.'").value;'.LF;
                    // $script.= '  console.log(tempValue);'.LF;
                    $script.= '  var tempHref   = document.getElementById("ftm_insertMarkerLink_'.$uid.'").href;'.LF;
                    // $script.= '  console.log(tempHref);'.LF;
                    $script.= '  var tempAdd    = "&tx_ftm_web_ftmftm[markerName]="+tempValue;'.LF;
                    $script.= '  document.getElementById("ftm_insertMarkerLink_'.$uid.'").href = tempHref+tempAdd;'.LF;
                    // $script.= '  console.log(tempAdd);'.LF;
                    $script.= 'return confirm("' . \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_informationrow.confirm_overwrite", "Ftm") . '");}'.LF;
                    $script.= '</script>'.LF;
                    
                    
                    // Insert-Link
                    $insertHref = '/typo3/mod.php?M=web_FtmFtm&amp;id='.$pid.'&amp;tx_ftm_web_ftmftm[action]=insertMarker&amp;tx_ftm_web_ftmftm[controller]=TemplateManager&amp;tx_ftm_web_ftmftm[marker]='.$uid; 
                    $insertLink = '<a href="'.$insertHref.'" id="ftm_insertMarkerLink_'.$uid.'" onclick="ftm_generateInsertMarkerLink_'.$uid.'()"><span class="t3-icon t3-icon-actions t3-icon-actions-document t3-icon-document-paste-after">&nbsp;</span></a>';
                    
                }
                else {
                    $markerSelection = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_informationrow.no_markers_exists", "Ftm"); //Es sind noch keine gemerkten Marker vorhanden.
                }
            }
            else {
                $syncHref = '/typo3/mod.php?M=web_FtmFtm&amp;id='.$pid.'&amp;tx_ftm_web_ftmftm[action]=loadSnippets&amp;tx_ftm_web_ftmftm[controller]=TemplateManager'; 
                $markerSelection = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_informationrow.no_saved_markers_exists", "Ftm") . "<a href=\"".$syncHref."\"><span style=\"color: red\">" . \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_informationrow.synchronize_markers_message", "Ftm") . "</span></a>";
            }
            
            
            
            
            $markerSaveUri = "/typo3/mod.php?M=web_FtmFtm&id=".$pid."&tx_ftm_web_ftmftm[action]=saveMarker&tx_ftm_web_ftmftm[controller]=TemplateManager&tx_ftm_web_ftmftm[marker]=".$uid."";
            $saveLink = "<a href=\"".$markerSaveUri."\" title=\"" . \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_informationrow.save_marker_in_plugincloud", "Ftm") . "\"><img src=\"".$imagePath."marker_save.png\"></a>";
            $infotext = $saveLink." <span>&nbsp;<strong>". \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_informationrow.klick_to_save_marker_in_plugincloud", "Ftm") ."</strong></span></a><br />";
            $infotext.= "<br /><u>" . \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_informationrow.warning_savemarkers_headline", "Ftm") . "</u> " . \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_informationrow.warning_savemarkers_message", "Ftm") . "<br /><br />";
            $infotext.= $script.$markerSelection." ".$insertLink."<br /><br />";
        }
        
        return $infotext;
    }


    protected function wikiLink($link, $label) {
        $wikiLink = "http://fluid-template-manager.de/documentation/";
        return "<a href=\"".$wikiLink.$link."\" target=\"_blank\"><u>".$label."</u></a>";
    }

}

?>