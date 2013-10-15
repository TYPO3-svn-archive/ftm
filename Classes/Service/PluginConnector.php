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
 * Sendet und empfaengt Daten aus der PluginCloud
 *
 * @package ftm
 * @subpackage Service
 * 
 * @version 1.0.1
 */
class PluginConnector {
    
    // Server-IP auf dem die Plugins laufen
    private $host = '';
    
    // Verzeichnis in dem die APIs der Plugins liegen
    private $folder = "api"; // -dev
    
    // PHP-Datei die das Plugin ansteuert
    private $file = '';
    
    // Verzeichnis und Datei der API
    private $pathAndFile = '';
    
    // Fehler sammeln
    private $errorRows = array();
    
    // PluginCloud-Schluessel
    private $pcKey = "public";
    
    private $requestTime = 0;
    
    private $resultHeaderRows = array();
    
    private $resultXML = '';
    
    function __construct($host="", $plugin="", $pcKey="public") {
        
        $this->host  = "plugincloud.de";
        $this->file  = $plugin;
        $this->pcKey = $pcKey;
        
        // Kompletten Pfad zum Plugin zusammensetzen
        $this->pathAndFile = "/".$this->folder."/".$this->file.".php";
        
    }
    
    private function createRequest($token, $post) {
        
        $request  = "POST ".$this->pathAndFile." HTTP/1.1\r\n";
        $request .= "Host: ".$this->host."\r\n";
        $request .= "Authorization: Basic ".$token."\r\n";
        $request .= "Content-type: application/x-www-form-urlencoded\r\n";
        $request .= "Content-length: ".strlen($post)."\r\n";
        $request .= "Connection: Close\r\n\r\n";
        $request .= $post;
                
        return $request;
    }
    
    
    public function sendRequest($token, $action, $data, $dataType="xml") {
        
        $startTime = $this->getMicrotime();
        
        $result = array();
        $result['headerRows'] = array();
        $result['xml'] = '';
                
        
        // Zeilen nach dem der Header zuende ist
        $xmlFound = FALSE;
        
        
        try {
        
            // Verbindung oeffnen
            $fs = fsockopen("tcp://".$this->host, 80, $errno, $errstr);
            
            $allInAll = '';
            
            if($fs) {
                
                // Anfrage zusammensetzen
                $out = $this->createRequest($token, $this->prepareData($data, $action), $this->host, $this->pathAndFile);   
                fwrite($fs, $out);
        
                // Anfrage auslesen
                while(($line = fgets($fs)) !== FALSE) {
                    $allInAll .= $line."<br>";
                    if(substr($line, 0, 6) == "<?xml ") $xmlFound = TRUE;
                    if($xmlFound) {
                        $result['xml'] .= $line;
                    }
                    else {
                        $result['headerRows'][] = str_replace(array("\n", "\r"), "", $line);
                    }
                }
                fclose($fs);

            }
            else {
                $this->errors[] = "fsockopen failed to tcp://".$this->host.$this->pathAndFile." Port 80";
            }
        
        }
        catch(Exception $e) {
            var_dump($e);
        }
        
        
        // Alles hinter dem End-Tag abschneiden     
        $xmlParts = explode("</return>", $result['xml']);
        $result['xml'] = $xmlParts[0]."</return>";
        
    
         $this->resultHeaderRows = $result['headerRows'];
         $this->resultXML        = $result['xml'];
         $this->requestTime      = $this->getMicrotime()-$startTime;
         
         
         if(empty($this->errors)) {
             return $allInAll;
         }
         else return FALSE;
    }
    
    
    private function prepareData($data="", $action="", $dataType="xml") {
        $data = "data=".urlencode(base64_encode($data))."&pcKey=".$this->pcKey."&dataType=".$dataType."&action=".$action;
        return $data;
    }
    
    
    public function getResultXML() { return $this->resultXML; }
    public function getResultHeaderRows() { return $this->resultHeaderRows; }
    public function getRequestTime() { return $this->requestTime; }
    public function getErrors() { return $this->errors; }
    
    
    /**
     * Liefert die microtime (Sekunden u. Millisekunden)
     *
     * @author     Thomas Deuling <typo3@coding.ms>
     * @return     float Microtime
     * @since      22.11.2010
     */
    private function getMicrotime() {
        list ($usec, $sec) = explode(" ", microtime());
        return ((float) $usec + (float) $sec);
    }
    
}

?>
