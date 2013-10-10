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
class GridElementColPosBootstrap {

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


        // echo "<pre>";
        // var_dump($parameters["field"]);
        // var_dump($parameters["row"]["uid"]);
        // var_dump($rootlineFtms);
        // echo "</pre>";
        // exit;
        // die(serialize($parentObject['_THIS_UID']));
        
        
        $id       = md5($name);
        $columnNo = str_replace("tx_ftm_grid_elements_col_pos_bootstrap_", "", $parameters["field"]);
        $label    = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_backend_gridelementcolposbootstrap.column", "Ftm");
        $label    = $label." ".$columnNo;

        
        // Hidden-Field zum Speichern
        $hidden = '<input type="hidden" name="'.htmlspecialchars($name).'" value="'.htmlspecialchars($value).'" id="ftm_gridElementColPosBootstrap_'.$uid.'_'.$id.'"/>';
        
        // Select-Boxen bauen
        $selects = array();
        for($i=0 ; $i<=3 ; $i++) {
            $options = array();
            $select = '<select style="width: 90px" name="'.htmlspecialchars($name).'['.$i.']"  class="formField select" onchange="ftm_updateGridElementColPosBootstrap_'.$uid.'_'.$id.'(this.value, '.$i.')">' . LF;
            $select.= '<option value="none">-</option>' . LF;
            
            for($j=1 ; $j<=12 ; $j++) {
                
                if($i==0) {
                    $className = 'col-xs-'.$j;
                }
                else if($i==1) {
                    $className = 'col-sm-'.$j;
                }
                else if($i==2) {
                    $className = 'col-md-'.$j;
                }
                else if($i==3) {
                    $className = 'col-lg-'.$j;
                }
                
                $classLabel = $j;
                
                $selected   = ($className === $values[$i] ? ' selected="selected"' : '');
                $options[$className] = '<option value="'.$className.'" '.$selected.'>'.$classLabel.'</option>' . LF;
            }
            $selects[] = $select.implode('', $options).'</select>'; 
        }
        $selects = implode("&nbsp;|&nbsp;", $selects);
        
        
        $script = '<script type="text/javascript">'.LF;
        $script.= 'function ftm_updateGridElementColPosBootstrap_'.$uid.'_'.$id.'(value, no) {'.LF;
        $script.= '  var tempValue  = document.getElementById("ftm_gridElementColPosBootstrap_'.$uid.'_'.$id.'").value;'.LF;
        $script.= '  var valueParts = tempValue.split(\' \');'.LF;
        $script.= '  valueParts[no] = value;'.LF;
        $script.= '  document.getElementById("ftm_gridElementColPosBootstrap_'.$uid.'_'.$id.'").value = valueParts.join(\' \');'.LF;
        $script.= '}'.LF;
        $script.= '</script>'.LF;
        
        return '<div><span style="width: 72px; display: inline-block;"><b>'.$label.':</b></span> '.$selects.$hidden.$script.'</div>'.LF;
	}


}

?>