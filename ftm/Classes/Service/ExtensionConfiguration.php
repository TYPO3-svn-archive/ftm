<?php
namespace CodingMs\Ftm\Service;

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
 * Prüft die ExtConf
 *
 * @package ftm
 * @subpackage Service
 * 
 * @author Thomas Deuling <typo3@coding.ms>
 * @since 1.0.0
 */
class ExtensionConfiguration {


    /**
     * Prüft ob die Konfiguration valide ist
     *
     * @param array Array mit der Extension-Configuration
     * @return array
     */
    public static function validate(array $extConf=array()) {
        
        /**
         * @todo: hier muss noch das Script hinzugefügt werden
         */
        
        if(!isset($extConf['pluginCloudHost']) || trim($extConf['pluginCloudHost'])=='') {
            throw new \Exception("Extension configuration isnt valid! pluginCloudHost not found! Default value is plugincloud.de.", 1);
        }
        
        if(!isset($extConf['pcKey']) || trim($extConf['pcKey'])=='') {
            throw new \Exception("Extension configuration isnt valid! pcKey not found! Default value is public.", 1);
        }
        
        if(!isset($extConf['user']) || trim($extConf['user'])=='') {
            throw new \Exception("Extension configuration isnt valid! user not found! Default value is noUser.", 1);
        }
        
        if(!isset($extConf['password']) || trim($extConf['password'])=='') {
            throw new \Exception("Extension configuration isnt valid! password not found! Default value is noPassword.", 1);
        }

        return $extConf;
    }

    public static function getConfiguration() {
        return self::validate(unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['ftm']));
    }
    
}

?>