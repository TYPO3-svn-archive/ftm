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
class GridElementColPosBootstrapHeader {

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
        
        
        $colStyle     = "width: 100px; display: inline-block; margin-right: 5px; border-right: 1px solid #c0c0c0; ";
        $colHeadStyle = "display: block; height: 32px; font-weight: bold; ";
        $colSubStyle  = "display: block; height: 18px; font-size: 0.9em; width: 100px; border-top: 1px solid #e0e0e0;";
        
        $col1Head = '<span style="'.$colHeadStyle.'">Extra small devices</span>';
        $col1Sub  = '<span style="'.$colSubStyle.'" >Phones (<768px)</span>';
        $col1     = '<div  style="'.$colStyle.'"    >'.$col1Head.$col1Sub.'</div>';
        
        $col2Head = '<span style="'.$colHeadStyle.'">Small devices Tablets</span>';
        $col2Sub  = '<span style="'.$colSubStyle.'" >(≥768px)</span>';
        $col2     = '<div  style="'.$colStyle.'"    >'.$col2Head.$col2Sub.'</div>';
        
        $col3Head = '<span style="'.$colHeadStyle.'">Medium devices</span>';
        $col3Sub  = '<span style="'.$colSubStyle.'" >Desktops (≥992px)</span>';
        $col3     = '<div  style="'.$colStyle.'"    >'.$col3Head.$col3Sub.'</div>';
        
        $col4Head = '<span style="'.$colHeadStyle.'">Large devices Desktops </span>';
        $col4Sub  = '<span style="'.$colSubStyle.'" >(≥1200px)</span>';
        $col4     = '<div  style="'.$colStyle.' border-right: none;"    >'.$col4Head.$col4Sub.'</div>';
        
                
        return '<div><b>Bootstrap Grid system/ responsive column setup:</b><br /><br /><div><div><span style="width: 72px; display: inline-block;"><b>&nbsp;</b></span> '.$col1.$col2.$col3.$col4.'</div>'.LF;
	}


}

?>