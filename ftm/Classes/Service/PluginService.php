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
 * Sendet und Empfaengt Daten aus der PluginCloud
 *
 * @package ftm
 * @subpackage Service
 * 
 * @version 1.0.2
 */
class PluginService {
    
    /**
     * Host der PluginCloud
     * @var string
     */
    protected $pluginCloudHost = "plugincloud.de";
    
    /**
     * Name des Plugins in der PluginCloud
     * @var string
     */
    protected $plugin = "ftm";
        
    /**
     * PluginCloud-Connector
     * @var \CodingMs\Ftm\Service\PluginConnector
     */
    protected $pluginConnector = null;
    
    /**
     * Authorisierungs-Token
     * @var string
     */
    protected $token = '';
    
    
    function __construct($pcHost="plugincloud.de", $pcKey="public", $user="noUser", $password="noPassword") {
        $this->pluginCloudHost = $pcHost;
        $this->token = base64_encode($user.":".$password);
        $this->pluginConnector = new \CodingMs\Ftm\Service\PluginConnector($this->pluginCloudHost, $this->plugin, $pcKey);
    }
  
    
    /**
     * 
     */
    public function executeAction($action='', array $dataValues=array(), $dataType='xml') {
        
        
        // Daten in XML ueberfuehren
        $dataXml = '';
        if(!empty($dataValues)) {
            
            // Werte sammeln
            foreach($dataValues as $dataKey => $dataValue) {
                $dataXml .= '<'.$dataKey.'><![CDATA['.$this->prepareXML($dataValue).']]></'.$dataKey.'>';
            }
            
            // XML erstellen
            $dataXml  =    
            '<?xml version="1.0" encoding="UTF-8" ?>'.
            '<data>'.$dataXml.'</data>';
        }
        
        
        // Send Request
        $result = $this->pluginConnector->sendRequest($this->token, $action, $dataXml, $dataType);
        
        return $this->transformXML($this->pluginConnector->getResultXML());
    }
    
    /**
     * Bereitet einen Text fuer die Einbettung im XML vor.
     * Ab Version 1.0.2 
     * - wird der gesamte String nochmal base64-kodiert
     * - wird kein utf8-encode mehr gemacht, innerhalb von Typo3 nicht notwendig
     *
     * @author     Thomas Deuling <tdeuling@coding.ms>
     * @param      string $text Text der vorbereitet werden soll
     * @return     string Text
     * @since      18.11.2010
     */
    protected function prepareXML($text="") {
        return base64_encode(trim($text));
    }
    
    protected function transformXML($data) {
            
        libxml_use_internal_errors(TRUE);
        $xmlObject = simplexml_load_string($data);
        
        if($xmlObject) {
            $t_array = array();
            foreach ($xmlObject->children() as $key => $value){
                $value = (string)$value;
                if(is_string($value)){
                    $t_array[$key] = $value;
                }
                else throw new \Exception("Data is Complex XML can't handle it!", E_WARNING);
            }
        }
        
        else {
            $errorData = '';
            foreach(libxml_get_errors() as $error) {
                $errorData .= $error->message."\n";
            }
            throw new \Exception($errorData."Data is not valid!", E_WARNING);
        }
        
        
        return $t_array;
        
    }
    
}

?>