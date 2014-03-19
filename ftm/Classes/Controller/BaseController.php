<?php
namespace CodingMs\Ftm\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Thomas Deuling <typo3@coding.ms>, coding.ms
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
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use CodingMs\Ftm\Utility\Console;
use CodingMs\Ftm\Utility\Log;

/**
 *
 *
 * @package coding_ms_base
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class BaseController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     * Controller debuggen und Ausgaben in die Firebug-Console schreiben!?
     * Nicht vorhandene Sprachwerte in Console schreiben?!
     *
     * @var boolean
     */
    protected $debug = false;
    
    /**
     * Alle E-Mails als Kopie an den Admin senden!?
     *
     * @var boolean
     */
    protected $emailCopy = false;
    
    /**
     * Admin E-Mail / Name
     *
     * @var array
     */
    protected $adminEmail = array('typo3@coding.ms' => 'Thomas Deuling');
    
    /**
     * Session-Handler
     *
     * @var \CodingMs\Ftm\Domain\Session\SessionHandler
     * @inject
     */
    protected $sessionHandler = NULL;
    
    /**
     * Session-Daten
     *
     * @var array
     */
    protected $session = array();
    
    /**
     * Ftm-Settings
     *
     * @var array
     */
    protected $ftmSettings = array();
    
    /**
     * Nachrichten die gesammelt werden
     *
     * @var array
     */
    protected $messages = array();
    
    /**
     * Action initialisieren
     * Wird immer aufgerufen wenn irgendeine Action ausgefuehrt wird
     */
    public function initializeAction() {
        
        // Zur Sicherheit den Controller-Context herstellen
        $this->controllerContext = $this->buildControllerContext();
        
        // $this->session = $this->sessionHandler->restoreFromSession();
        // $action      = $this->request->getControllerActionName();
        // if($action=='showRegistration')
            // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->session);
            
        // FTM-Settings auslesen
        $configuration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK, 'Ftm');
        $this->ftmSettings = $configuration['settings'];
        
        // System debuggen!?
        $this->debug = (boolean)$this->ftmSettings['debug'];
        $pluginName  = $this->request->getPluginName();
        $action      = $this->request->getControllerActionName();
        \CodingMs\Ftm\Utility\Console::setActive($this->debug);
        \CodingMs\Ftm\Utility\Console::info('Tx_'.$this->extensionName.'_'.$pluginName.'->'.$action.'() debugging - disable it with TS: plugin.tx_ftm.settings.debug = 0');
        
        // Session-Daten auslesen
        $this->session = $this->sessionHandler->restoreFromSession();
        \CodingMs\Ftm\Utility\Console::log('BaseController->sessionRestored: ');
        \CodingMs\Ftm\Utility\Console::log(json_encode($this->session));
        
        // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->session);
        // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($ftmSettings);
        // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->debug, 'ftm->debug');
        // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(\CodingMs\Ftm\Utility\Console::getActive(), 'console active');
        // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(\CodingMs\Ftm\Utility\Console::getConsoleRows(), 'console entries');
        
        // Nachrichten ggf. wiederherstellen
        $this->restoreMessages();
        
        
    }

    /**
     * Bereitet das System auf einen Redirect vor.
     * Hier werden alle Console-Nachrichten in die Session geschrieben.
     * Aber auf Frontend-Nachrichten, die durch einen Bug bei Verwendung von mehreren Plugins auf einer Seite verloren gehen.
     * 
     * @return void
     */
    protected function prepareRedirect() {
        \CodingMs\Ftm\Utility\Console::log('BaseController->prepareRedirect()');
        
        // Nachrichten merken
        $this->session['flashMessages'] = $this->messages;
        
        // Vor dem Redirect noch schnell die Logs&Nachrichten in der Session merken
        // $sessionHandler = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('CodingMs\Ftm\Domain\Session\SessionHandler');
        // $session = $sessionHandler->restoreFromSession();
        $this->session['consoleRows']   = \CodingMs\Ftm\Utility\Console::getAndClearConsoleRows();
        $this->sessionHandler->writeToSession($this->session);
        
    }
    
    /**
     * Sammelt Nachricht fuer die Frontend-Ausgabe.
     * Wir machen es selbst, da es mit dem flashMessageContainer bei redirects Probleme gibt!
     */
    protected function pushMessage($type='OK', $languageKey='', $extensionKey='Ftm') {
        \CodingMs\Ftm\Utility\Console::log('BaseController->pushMessage('.$type.', '.$languageKey.', '.$extensionKey.')');

        // Valide Typen
        $validTypes = array();
        $validTypes['NOTICE']  = '\TYPO3\CMS\Core\Messaging\FlashMessage::NOTICE';
        $validTypes['INFO']    = '\TYPO3\CMS\Core\Messaging\FlashMessage::INFO';
        $validTypes['OK']      = '\TYPO3\CMS\Core\Messaging\FlashMessage::OK';
        $validTypes['WARNING'] = '\TYPO3\CMS\Core\Messaging\FlashMessage::WARNING';
        $validTypes['ERROR']   = '\TYPO3\CMS\Core\Messaging\FlashMessage::ERROR';
        
        // Wenn ubergebener Typ ok ist
        if(array_key_exists($type, $validTypes)) {
            
            // Key-Prefix: tx_ftm_message.*
            $keyPrefix = 'tx_'.strtolower($extensionKey).'_message';
            
            // Sprach-Key: error_*
            $key = strtolower($type).'_'.strtolower($languageKey);
            
            // Schauen ob es eine Uebersetzung gibt
            $translation = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($keyPrefix.'.'.$key, $extensionKey);
            if($translation===NULL) {
                $translation = $languageKey;
                \CodingMs\Ftm\Utility\Console::warn('missed language value '.$keyPrefix.'.'.$key.' ('.$extensionKey.' locallang.xlf)');
            }
            
            // Daten im Messages-Array sammeln
            $temp = array();
            $temp['type']         = $validTypes[$type];
            $temp['translation']  = $translation;
            $temp['languageKey']  = $keyPrefix.'.'.$key;
            $temp['extensionKey'] = $extensionKey;
            $this->messages[$extensionKey][$type][$temp['languageKey']] = $temp;
            
        }
        else {
            throw new \Exception("Unknown message type in pushMessage", 1);
        }
    }

    protected function translate($type='label', $languageKey='', $extensionKey='Ftm') {
        // Key-Prefix: tx_ftm_label.*
        $keyPrefix = 'tx_'.strtolower($extensionKey).'_'.strtolower($type);
        
        // Schauen ob es eine Uebersetzung gibt
        $translation = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($keyPrefix.'.'.$languageKey, $extensionKey);
        if($translation===NULL) {
            $translation = $languageKey;
            \CodingMs\Ftm\Utility\Console::warn('missed language value '.$keyPrefix.'.'.$languageKey.' ('.$extensionKey.' locallang.xlf)');
        }
        return $translation;
    }

    protected function prepareView() {
        \CodingMs\Ftm\Utility\Console::log('prepareView()');
        $this->session['flashMessages'] = $this->messages;
        \CodingMs\Ftm\Utility\Console::log(json_encode($this->session['flashMessages']));
        $this->restoreMessages();
    }

    protected function restoreMessages() {
        \CodingMs\Ftm\Utility\Console::log('restoreMessages-start');
        // \CodingMs\Ftm\Utility\Console::log(json_encode($this->session['flashMessages']));

        if(isset($this->session['flashMessages']) && is_array($this->session['flashMessages']) && !empty($this->session['flashMessages'])) {
            
            // Wenn fuer eine Extension Nachrichten vorhanden sind
            foreach($this->session['flashMessages'] as $extensionKey=>$extensionMessages) {
                
                // Aber nur die Nachrichten der eigenen Extension wieder herstellen
                if(!empty($extensionMessages) && $extensionKey==$this->extensionName) {

                    // Wenn fuer einen Nachrichten-Typ Nachrichten vorhanden sind
                    foreach($extensionMessages as $type=>$messages) {
                        if(!empty($messages)) {
                            
                            // ..durchlaufe Nachrichten
                            foreach($messages as $message) {
                                $this->flashMessageContainer->add($message['translation'], '', constant($message['type']));
                            }
                            
                        }
                    }

                    // Am Ende leeren
                    $this->session['flashMessages'][$this->extensionName] = array();
                    $this->sessionHandler->writeToSession($this->session);
                }
            }
        }
        // if(isset($this->session['flashMessages']) && is_array($this->session['flashMessages']) && !empty($this->session['flashMessages'])) {
//             
            // // Wenn fuer eine Extension Nachrichten vorhanden sind
            // foreach($this->session['flashMessages'] as $extensionKey=>$extensionMessages) {
                // if(!empty($extensionMessages)) {
// 
                    // // Wenn fuer einen Nachrichten-Typ Nachrichten vorhanden sind
                    // foreach($extensionMessages as $type=>$messages) {
                        // if(!empty($messages)) {
//                             
                            // // ..durchlaufe Nachrichten
                            // foreach($messages as $message) {
                                // $this->flashMessageContainer->add($message['translation'], '', constant($message['type']));
                            // }
//                             
                        // }
                    // }
// 
                // }
            // }
        // }

        // \CodingMs\Ftm\Utility\Console::log('restoreMessages-end');
        // \CodingMs\Ftm\Utility\Console::log(json_encode($this->session['flashMessages']));
    }
    
}

?>