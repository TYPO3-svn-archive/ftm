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
 * @package	TYPO3
 * @subpackage	ftm
 */
class ImageHoverEffectRow {

	/**
	 * Render a Flexible Content Element type selection field
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


        // FTM Template-Verzeichnis ermitteln
        $rootlinePages = \CodingMs\Ftm\Utility\Tools::getRootlinePids($pid);
        $rootlineFtms  = \CodingMs\Ftm\Utility\Tools::getRootlineFtms($rootlinePages);
        if(!empty($rootlineFtms) && count($rootlineFtms)==1) {
            $ftmTemplateDir = $rootlineFtms[0];
        }
        else {
            return "Error: Multiple FTM-Templates on rootline! Only one is valid!";
        }
        
        
        //  onchange="if (confirm(TBE_EDITOR.labels.onChangeAlert) && TBE_EDITOR.checkSubmit(-1)){ TBE_EDITOR.submitForm() };"
		$select = '<div><select name="' . htmlspecialchars($name) . '"  class="formField select">' . LF;
        $select.= '<option value="none">-</option>' . LF;
		
        $templateDir = \CodingMs\Ftm\Utility\Tools::getDirectory("LessImageHoverEffects", $ftmTemplateDir);
        $directory   = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($templateDir);
        
        
        // Aber nur wenn es darin das ImageHoverEffect-Verzeichnis gibt
        if(@file_exists($directory)) {
            if($handleLess=opendir($directory)) {
                while($fileLess=readdir($handleLess)){
                    if(substr($fileLess , 0, 1) != ".") {
                        $selected = (str_replace(".less", "", $fileLess) === $value ? ' selected="selected"' : '');
                        $select .= '<option value="'.str_replace(".less", "", $fileLess).'" '.$selected.'>'.str_replace(".less", "", $fileLess).'</option>' . LF;
                    }
                }
            }
        }
        
        
		$select .= '</select></div>' . LF;
		return $select;
	}


}

?>