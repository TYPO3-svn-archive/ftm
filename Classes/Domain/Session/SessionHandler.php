<?php
namespace CodingMs\Ftm\Domain\Session;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Erwin Knoll <typo3coding@rootsystem.de>, Rootsystem
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/


/**
 * session handling
 * Source: http://www.typo3-nürnberg.de/typo-v5/extbase/erweiterungen/sessions/
 *
 * @package ftm
 * @license www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class SessionHandler implements \TYPO3\CMS\Core\SingletonInterface {
 
    /**
     * Return stored session data
     * @return Object the stored object
     */
    public function restoreFromSession() {
        if(isset($GLOBALS['TSFE']->fe_user)) {
            $sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'tx_ftm');
            return unserialize($sessionData);
        }
    }
 
    /**
     * Write session data
     * @param    $object    any serializable object to store into the session
     * @return    \CodingMs\Ftm\Domain\Session\SessionHandler this
     */
    public function writeToSession($object) {
        if(isset($GLOBALS['TSFE']->fe_user)) {
            $sessionData = serialize($object);
            $GLOBALS['TSFE']->fe_user->setKey('ses', 'tx_ftm', $sessionData);
            $GLOBALS['TSFE']->fe_user->storeSessionData();
        }
        return $this;
    }
 
    /**
     * Clean up session
     * @return    \CodingMs\Ftm\Domain\Session\SessionHandler this
     */
    public function cleanUpSession() {
        if(isset($GLOBALS['TSFE']->fe_user)) {
            $GLOBALS['TSFE']->fe_user->setKey('ses', 'tx_ftm', NULL);
            $GLOBALS['TSFE']->fe_user->storeSessionData();
        }
        return $this;
    }
}
?>