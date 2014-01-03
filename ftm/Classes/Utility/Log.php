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
 *  
 ***************************************************************/

/**
 * Log
 *
 * @package ftm
 * @subpackage Utility
 */
class Log {

    /**
     * Log verwenden!?
     *
     * @var boolean
     */
    protected static $active = false;

    /**
     * Log-Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\LogRepository
     */
    protected static $logRepository = NULL;

    /**
     * Persistence-Manager
     *
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     */
    protected static $persistenceManager = NULL;
    
    /**
     * Merkt sich ob der Log verwendet wird
     * @param boolean $active An oder aus!?
     */
    public static function setActive($active=false) {
        self::$active = $active;
    }

    /**
     * Erstellt einen neuen Log-Eintrag in der Datenbank
     *
     * @param \CodingMs\Ftm\Domain\Model\Log $newLog
     * @return void
     */
    public static function add(\CodingMs\Ftm\Domain\Model\Log $newLog, $persistDirect=false) {

        // Wenn Log nicht aktiv, mache nichts
        if(!self::$active) {
            //return;
        }
        
        // Falls nicht gesetzt, setze!
        if($newLog->getRemoteAddress()=='') {
            $newLog->setRemoteAddress($_SERVER['REMOTE_ADDR']);
        }
        
        // Pruefen ob schon ein Log-Repository
        // vorhanden ist
        if(self::$logRepository===NULL) {
            // Diese Instanz darf nicht erst erstellt werden,
            // wenn der Console::__destruct den Log schreibt! 
            self::$logRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('CodingMs\Ftm\Domain\Repository\LogRepository');
        }
        self::$logRepository->add($newLog);
        
        // wird z.B. verwendet wenn aus dem 
        // Console __destruct geloggt werden soll
        if($persistDirect) {
            if(self::$persistenceManager===NULL) {
                self::$persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager');
            }
            self::$persistenceManager->persistAll();
        }
        
    }

    

}
?>