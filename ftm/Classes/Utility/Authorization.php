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
 * Authorization Tools
 *
 * @package ftm
 * @subpackage Utility
 */
class Authorization {

    /**
     * Prueft ob ein Admin im Backend eingeloggt ist
     */
    public static function isAdmin() {
        if(isset($GLOBALS['BE_USER'])) {
            if(isset($GLOBALS['BE_USER']->user)) {
                return (bool)$GLOBALS['BE_USER']->user['uid'];
            }
        }
        return FALSE;
    }
    
}
?>