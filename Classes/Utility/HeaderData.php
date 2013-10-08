<?php
namespace CodingMs\Ftm\Utility;

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
 * PHP type handling functions
 *
 * @package coding_ms_base
 * @subpackage Utility
 */
class HeaderData {

    /**
     * Merkt sich ob ein Script schon enthalten ist
     */
    public static $alreadyAdded = array();

   

    /**
     * Normalize data types so they match the PHP type names:
     *  
     *
     * @param string $type Data type to unify
     * @return void
     */
    static public function add($type='css', $file='', $viewresponse=null) {
        
        // Erst pruefen ob die Datei schon im Header sitzt
        $fileHash = md5($file);
        if(!in_array($fileHash, self::$alreadyAdded)) {
            
            // Wenn nicht includiere
            if($type=='javascript') {
                $viewresponse->addAdditionalHeaderData('<script type="text/javascript" src="'.$file.'"></script>');
            }
            else if($type=='css') {
                $viewresponse->addAdditionalHeaderData('<link rel="stylesheet" href="'.$file.'" />');
            }
            
            // Und merke das Hinzugefuegt wurde
            self::$alreadyAdded[] = $fileHash;
        }
        

    }

}
?>