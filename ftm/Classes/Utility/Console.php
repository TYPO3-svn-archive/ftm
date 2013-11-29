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
 * 
 ***************************************************************
 * 
 * Used to log SQL-Queries from Query-Builder, just
 * add the logging function-call:
 * if(class_exists('\CodingMs\Ftm\Utility\Console')) {
 *   \CodingMs\Ftm\Utility\Console::log("buildQuery():".$statement);
 * }
 * ..in file: 
 * /typo3/sysext/extbase/Classes/Persistence/Storage/Typo3DbBackend.php
 * /typo3/sysext/extbase/Classes/Persistence/Generic/Storage/Typo3DbBackend.php
 * 
 * ..before the return in method buildQuery()
 * 
 ***************************************************************/

/**
 * PHP type handling functions
 *
 * @package ftm
 * @subpackage Utility
 */
class Console {

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected static $objectManager;

    /**
     * Console verwenden!?
     *
     * @var boolean
     */
    protected static $active = FALSE;

    /**
     * Session-Handler
     *
     * @var \CodingMs\Ftm\Domain\Session\SessionHandler
     */
    protected static $sessionHandler = NULL;

    /**
     * Merkt sich die Zeilen die auf der 
     * Firebug-Console ausgegeben werden sollen
     * 
     * @var array 
     */
    public static $consoleRows = array();

    /**
     * Console-Objekt welches soaeter die Ausgabe macht
     *
     * @var \CodingMs\Ftm\Utility\Console
     */
    private static $destructEvent = null;
    
    /**
     * Gibt die Console-Rows zurueck
     */
    public static function getConsoleRows() {
        return self::$consoleRows;
    }
    
    
    /**
     * Gibt die Console-Rows als String zurueck
     * Nicht als magische Methode, da diese nicht statisch sein darf :/
     */
    public static function toString() {
        $logging="";
        if(!empty(self::$consoleRows)) {
            foreach(self::$consoleRows as $row) {
                $outputType = key($row);
                
                // Hochkomma und Newline escapen
                // damit das JavaScript nicht zerschossen wird
                $content = str_replace("'", "\\'", $row[$outputType]);
                $content = str_replace("\n", "\\n", $content);
                
                if($outputType=="warn") {
                    $logging.= "warn:  ".$content."\n";
                }
                else if($outputType=="info") {
                    $logging.= "info:  ".$content."\n";
                }
                else if($outputType=="error") {
                    $logging.= "error: ".$content."\n";
                }
                else {
                    $logging.= "log:   ".$content."\n";
                }
            }
        }
        return $logging;
    }
    
    /**
     * Gibt die Console-Rows zurueck
     */
    public static function getAndClearConsoleRows() {
        $consoleRows = self::$consoleRows;
        self::$consoleRows = array();
        return $consoleRows;
    }
    
    /**
     * Merkt sich ob die Console verwendet wird
     * @param boolean $active An oder aus!?
     */
    public static function setActive($active=FALSE) {
        self::$active = $active;
    }
    
    /**
     * Merkt sich ob die Console verwendet wird
     * @return boolean An oder aus!?
     */
    public static function getActive() {
        return self::$active;
    }

    /**
     * Schreibt eine Zeile in den Firebug
     *
     * @param string $row Zeile die in den Firebug geschrieben werden soll
     * @return void
     */
    public static function log($row) {
        
        // Nur beim ersten Aufruf..
        if(empty(self::$consoleRows)) {
            // Pruefen ob wegen eines Redirects consoleRows
            // in der Session gemerkt wurden. Wenn ja, stelle
            // diese wieder her
            self::restoreConsoleRowsFromSession();
            // ein Object erstellen, was wir spaeter
            // fuer den Ausgabe-Aufruf missbrauchen
            self::$destructEvent = new self();
            
            $row.= ' ('.count(self::$consoleRows).' Console rows restored)';
        }
        
        // Zeile im statischen Array merken
        self::$consoleRows[] = array('log' => $row);
    }

    /**
     * Schreibt eine Zeile in den Firebug
     *
     * @param string $row Zeile die in den Firebug geschrieben werden soll
     * @return void
     */
    public static function info($row) {
        
        // Nur beim ersten Aufruf..
        if(empty(self::$consoleRows)) {
            // Pruefen ob wegen eines Redirects consoleRows
            // in der Session gemerkt wurden. Wenn ja, stelle
            // diese wieder her
            self::restoreConsoleRowsFromSession();
            // ein Object erstellen, was wir spaeter
            // fuer den Ausgabe-Aufruf missbrauchen
            self::$destructEvent = new self();
            
            $row.= ' ('.count(self::$consoleRows).' Console rows restored)';
        }
        
        // Zeile im statischen Array merken
        self::$consoleRows[] = array('info' => $row);
    }

    /**
     * Schreibt eine Zeile in den Firebug
     *
     * @param string $row Zeile die in den Firebug geschrieben werden soll
     * @return void
     */
    public static function warn($row) {
        
        // Nur beim ersten Aufruf..
        if(empty(self::$consoleRows)) {
            // Pruefen ob wegen eines Redirects consoleRows
            // in der Session gemerkt wurden. Wenn ja, stelle
            // diese wieder her
            self::restoreConsoleRowsFromSession();
            // ein Object erstellen, was wir spaeter
            // fuer den Ausgabe-Aufruf missbrauchen
            self::$destructEvent = new self();
            
            $row.= ' ('.count(self::$consoleRows).' Console rows restored)';
        }
        
        // Zeile im statischen Array merken
        self::$consoleRows[] = array('warn' => $row);
    }

    /**
     * Schreibt eine Zeile in den Firebug
     *
     * @param string $row Zeile die in den Firebug geschrieben werden soll
     * @return void
     */
    public static function error($row) {
        
        // Nur beim ersten Aufruf..
        if(empty(self::$consoleRows)) {
            // Pruefen ob wegen eines Redirects consoleRows
            // in der Session gemerkt wurden. Wenn ja, stelle
            // diese wieder her
            self::restoreConsoleRowsFromSession();
            // ein Object erstellen, was wir spaeter
            // fuer den Ausgabe-Aufruf missbrauchen
            self::$destructEvent = new self();
            
            $row.= ' ('.count(self::$consoleRows).' Console rows restored)';
        }
        
        // Zeile im statischen Array merken
        self::$consoleRows[] = array('error' => $row);
    }

    /**
     * Desruktor
     * Schreibt Logging-Ausgaben in die Firebug-Console
     */
    public function __destruct() {
        
        $someErrorHappens = FALSE;
        
        // HTML Response
        if(!empty(self::$consoleRows) && ((int)$_REQUEST['type']===0 || (int)$_REQUEST['type']===1802)) {
            $logging = "<script>";
            $logging.= "if(typeof(console)!='undefined' && console!=null) {\n";
            foreach(self::$consoleRows as $row) {
                $outputType = key($row);
                
                // Hochkomma und Newline escapen
                // damit das JavaScript nicht zerschossen wird
                $content = str_replace("'", "\\'", $row[$outputType]);
                $content = str_replace("\n", "\\n", $content);
                $content = str_replace("\r", "\\n", $content);
                
                // Pruefen ob es ein JSON-String ist
                $json = json_decode($content);
                if($json!=NULL) {
                    $json = $content;
                }
                // ..wenn nicht in Hochkomma einschliessen
                else {
                    $json = "'".$content."'";
                }
                
                if($outputType=="warn") {
                    $logging.= "  console.warn('FTM: ', ".$json.");\n";
                }
                else if($outputType=="info") {
                    $logging.= "  console.info('FTM: ', ".$json.");\n";
                }
                else if($outputType=="error") {
                    $logging.= "  console.error('FTM: ', ".$json.");\n";
                    $someErrorHappens = TRUE;
                }
                else {
                    $logging.= "  console.log('FTM: ', ".$json.");\n";
                }
            }
            $logging.= "}\n"; 
            $logging.= "</script>\n"; 
            
            // Einfach ausgeben, landet dann 
            // vorm schliessenden Body-Tag   
            if(self::$active) {
                echo $logging;
                //$GLOBALS['TSFE']->additionalHeaderData[] = $logging;
            }
            
        }
        
        
        // Wenn ein Fehler geloggt wurde
        if($someErrorHappens) {
            /**
             * @ToDo: Hier noch einen Error-Mailer integrieren!!
             * Wenn ein Error enthalten ist, sende eine E-Mail an den Admin
             */
            
            
            // Console-Log auch in den Datenbank-Log schreiben
            // $newLog = new Tx_CodingMsBase_Domain_Model_Log();
            // $newLog->initialize(__METHOD__, $this);
            // $newLog->setText(self::toString());
            // Tx_CodingMsBase_Utility_Log::add($newLog, TRUE);
        }
        
    }

    /**
     * Prueft ob wegen eines Redirects consoleRows
     * in der Session gemerkt wurden. Wenn ja, werden
     * diese wieder hergestellt
     */
    protected static function restoreConsoleRowsFromSession() {
        
        // Pruefen ob diese Methode schon mal aufgerufen wurde
        if(self::$sessionHandler===NULL) {
            
            // Schauen ob der Objekt-Manager schon vorhanden ist
            if(!(self::$objectManager instanceof \TYPO3\CMS\Extbase\Object\ObjectManager)) {
                self::$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
            }
            
            // Session auslesen
            self::$sessionHandler = self::$objectManager->get('CodingMs\Ftm\Domain\Session\SessionHandler');
            $session = self::$sessionHandler->restoreFromSession();

            // Wenn Logs gespeichert sind
            if(is_array($session['consoleRows']) && !empty($session['consoleRows'])) {
                
                // Stelle sie wieder her
                self::$consoleRows = $session['consoleRows'];
                $session['consoleRows'] = NULL;
                
                // ..und loesche den Eintrag aus der Sesssion
                self::$sessionHandler->writeToSession($session);
        
            }
        }
    }

}
?>