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
 * Selection for Grid-Elements Classes
 *
 * @package	TYPO3
 * @subpackage	ftm
 */
class GridElementClassesRow {

	/**
	 * Render a Selection for Grid-Elements Classes
	 *
	 * @param array $parameters
	 * @param mixed $parentObject
	 * @return string
	 */
	public function renderField(array &$parameters, &$parentObject) {
            
            
        // Vars
        $uid   = &$parameters["row"]["uid"];
        $pid   = $parameters["row"]["pid"];
		$name  = $parameters['itemFormElName'];
		$value = $parameters['itemFormElValue'];
        
        
        // Initial Wert
        if(trim($value)=="") {
            $value = 'none none none none';
        }
        $values = explode(' ', $value);


        // FTM Template-Verzeichnis ermitteln
        $rootlinePages = \CodingMs\Ftm\Utility\Tools::getRootlinePids($pid);
        $rootlineFtms  = \CodingMs\Ftm\Utility\Tools::getRootlineFtms($rootlinePages);
        if(!empty($rootlineFtms) && count($rootlineFtms)==1) {
            $ftmTemplateDir = $rootlineFtms[0];
        }
        else {
            return \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_gridelementclassesrow.error_multiple_ftm_templates_on_rootline", "Ftm");
            // return "Error: Multiple FTM-Templates on rootline! Only one is valid!";
        }


        // echo "<pre>";
        // var_dump(&$parameters["row"]["uid"]);
        // var_dump($rootlineFtms);
        // echo "</pre>";
        // exit;
        // die(serialize(&$parentObject['_THIS_UID']));

        
        // Hidden-Field zum Speichern
        $hidden = '<input type="hidden" name="'.htmlspecialchars($name).'" value="'.htmlspecialchars($value).'" id="ftm_gridElementClasses_'.$uid.'"/>';
        
        $templateDir = \CodingMs\Ftm\Utility\Tools::getDirectory("LessGridElementLayouts", $ftmTemplateDir);
        $directory   = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($templateDir);
        
        // Select-Boxen bauen    
        for($i=0; $i<=3; $i++) {
            $options = array();
            $select.= '<select name="'.htmlspecialchars($name).'['.$i.']"  class="formField select" onchange="ftm_updateGridElementClasses_'.$uid.'(this.value, '.$i.')">' . LF;
            $select.= '<option value="none">-</option>' . LF;
            if($handleLess=opendir($directory)) {
                while($fileLess=readdir($handleLess)){
                    if(substr($fileLess , 0, 1) != ".") {
                        $selected = (str_replace(".less", "", $fileLess) === $values[$i] ? ' selected="selected"' : '');
                        $options[$fileLess] = '<option value="'.str_replace(".less", "", $fileLess).'" '.$selected.'>'.str_replace(".less", "", $fileLess).'</option>' . LF;
                    }
                }
            }
            ksort($options);
            $select.= implode('', $options).'</select>&nbsp;&nbsp;'; 
        }
        
        
        $script = '<script type="text/javascript">'.LF;
        $script.= 'function ftm_updateGridElementClasses_'.$uid.'(value, no) {'.LF;
        $script.= '  var tempValue  = document.getElementById("ftm_gridElementClasses_'.$uid.'").value;'.LF;
        $script.= '  var valueParts = tempValue.split(\' \');'.LF;
        $script.= '  valueParts[no] = value;'.LF;
        $script.= '  document.getElementById("ftm_gridElementClasses_'.$uid.'").value = valueParts.join(\' \');'.LF;
        $script.= '}'.LF;
        $script.= '</script>'.LF;
        
        
        $notice1 = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_gridelementclassesrow.directory_notice", "Ftm", array("<b>".$templateDir."</b>"));
        //$notice1 = 'Options were created from '.$templateDir.' directory.';
        $notice2 = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_gridelementclassesrow.documentation_notice", "Ftm", array('<a href="http://fluid-template-manager.de/documentation/Css-Less.html" target="_blank"><u>http://fluid-template-manager.de/documentation/Css-Less.html</u></a>'));
        //$notice2 = 'How to manage the provided classes, you can read here: .';
        
        return '<div>'.$select.$hidden.$script.'<br />'.$notice1.'<br/>'.$notice2.'</div>'.LF;
	}


}

?>