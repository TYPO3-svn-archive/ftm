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
 * E-Mail versenden in eigener Utiltiy, um bei
 * jeder verschicken E-Mail Aktionen ausfuehren zu
 * koennen.
 * Bspw. einen Log schreiben oder eine Kopie verschicken.
 *
 * @package ftm
 * @subpackage Utility
 */
class SendMail {

    /**
     * E-Mail als Log in DB speichern
     *
     * @var boolean
     */
    protected static $log = FALSE;

    /**
     * E-Mail Kopie immer an den Admin schicken?
     *
     * @var boolean
     */
    protected static $emailCopy = FALSE;

    /**
     * E-Mail Kopie Adresse von Admin
     *
     * @ToDo muss aus settings kommen
     * @var boolean
     */
    protected static $adminEmail = array('typo3@coding.ms' => 'Thomas Deuling');
    
    /**
     * Merkt sich ob die E-Mail als Log in der DB gespeichert wird
     * @param boolean $active An oder aus!?
     */
    public static function setLog($log=FALSE) {
        self::$log = $log;
    }
    
    /**
     * Merkt sich ob die E-Mail als Kopie an den Admin geschickt wird
     * @param boolean $active An oder aus!?
     */
    public static function setEmailCopy($emailCopy=FALSE) {
        self::$emailCopy = $emailCopy;
    }
    
    /**
     * Merkt sich ob die Admin E-Mailadresse
     * @param array $adminEmail Admin E-Mailadresse
     */
    public static function setAdminEmail(array $adminEmail=array()) {
        self::$adminEmail = $adminEmail;
    }

    /**
     * SendMail 
     *
     * 
     * $emailData example:
     * $emailData['toEmail']     = "typo3@coding.ms";
     * $emailData['toName']      = "Thomas Deuling";
     * $emailData['fromEmail']   = "bestellung@riederverlag.de";
     * $emailData['fromName']    = "Bestellung auf www.riederverlag.de";
     * $emailData['subject']     = "Bestellung";
     * $emailData['message']     = "Hier der Nachrichten-Text";
     * 
     * Links:
     * - http://buzz.typo3.org/teams/core/article/your-first-blog/
     * - http://swiftmailer.org/ | Dokumentation zum Swiftmailer
     *
     * @param string $type Data type to unify
     * @return boolean Erfolgreich versandt, ja/nein
     */
    static public function send(array $emailData=array(), array $attachments=array()) {
        
        
        
        $logEntry = '';
        $paramsFailed = FALSE;
        
        if(!isset($emailData['fromEmail']) || empty($emailData['fromEmail'])) {
            \CodingMs\Ftm\Utility\Console::error("SendMail->send() fromEmail failed");
            $paramsFailed = TRUE;
        }
        if(!isset($emailData['fromName']) || empty($emailData['fromName'])) {
            \CodingMs\Ftm\Utility\Console::error("SendMail->send() fromName failed");
            $paramsFailed = TRUE;
        }
        if(!isset($emailData['toEmail']) || empty($emailData['toEmail'])) {
            \CodingMs\Ftm\Utility\Console::error("SendMail->send() toEmail failed");
            $paramsFailed = TRUE;
        }
        if(!isset($emailData['toName']) || empty($emailData['toName'])) {
            \CodingMs\Ftm\Utility\Console::error("SendMail->send() toName failed");
            $paramsFailed = TRUE;
        }
        if(!isset($emailData['subject']) || empty($emailData['subject'])) {
            \CodingMs\Ftm\Utility\Console::error("SendMail->send() subject failed");
            $paramsFailed = TRUE;
        }
        if(!isset($emailData['message']) || empty($emailData['message'])) {
            \CodingMs\Ftm\Utility\Console::error("SendMail->send() message failed");
            $paramsFailed = TRUE;
        }
        
        // Wenn alle Parameter ok sind,
        // sende die E-Mail
        if(!$paramsFailed) {
            
            // Normale E-Mail versenden
            $mail = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('t3lib_mail_Message');
            $mail->setFrom(array($emailData['fromEmail'] => $emailData['fromName']));
            $mail->setTo(array($emailData['toEmail'] => $emailData['toName']));
            $mail->setSubject($emailData['subject']);
            $mail->setBody($emailData['message']);
            
            
            
            // Eine Kopie an den Admin senden
            if(self::$emailCopy) {
                // Bcc hatte nicht funktioniert!?
                // -> Doch, GMail filtert nur wieder doppelte Mails ;)
                $mail->setBcc(self::$adminEmail);
            }
            
            // Possible attachments here
            foreach($attachments as $attachment) {
                
                if($attachment['type']=="dynamic") {
                    $mail->attach( Swift_Attachment::newInstance($attachment['body'], $attachment['fileName'], $attachment['contentType']));
                }
                else {
                    die('static attachment not available');
                }
                
            }
            
            
            // mail->send() returns integer the number of recipients who were accepted for delivery
            /**
             * @ToDo: Erfolg weiter pruefen anhand eines Vergleichs der recipients
             */
            if($mail->send()>0) {
                $success = TRUE;
            }
            else {
                $success = FALSE;
            }
        
        }
        else {
            \CodingMs\Ftm\Utility\Console::error("SendMail->send() E-Mail not send!");
            $success = FALSE;
        }
        
        // E-Mail Daten ggf. in den DB-Log schreiben
        // if(self::$log) {
            // $newLog = new Tx_CodingMsBase_Domain_Model_Log();
            // $newLog->initialize('send', 'SendMail');
            // $newLog->setText($logEntry);
            // //Tx_CodingMsBase_Utility_Log::add($newLog, TRUE); 
        // }
        $emailData['success'] = $success;
        \CodingMs\Ftm\Utility\Console::log(json_encode($emailData));
        
        return $success;
    }

    /**
     * Rendert die Texte von E-Mails
     * 
     * @param string $templatePath Path of the Templates within the typo3conf/ext directory
     * @param string $templateName Der Dateiname des Templates
     * @param array $emailData Daten die in der E-Mail ersetzt werden sollen
     * @param array $settings Einstellungen der jeweiligen Extension
     * @return array
     */
    static public function renderEmail($templatePath='ftm/Resources/Private/Templates/', $templateName = 'default', array $emailData=array(), array $settings=array()) {

        $emailView = new \TYPO3\CMS\Fluid\View\StandaloneView();
        // $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        
        
        // Template-Pfad an die Sub-Extension anpassen
        // $templateRootPath = str_replace("coding_ms_base", $this->baseSettings['belongsToExtension'], $extbaseFrameworkConfiguration['view']['templateRootPath']);
        // Zur Sicherheit den Pfad replacen
//        $templatePath = str_replace('typo3conf/ext/', '', $templatePath);
//        if(strstr($templatePath, 'fileadmin')===FALSE) {
//            $templatePath = 'typo3conf/ext/'.$templatePath;
//        }
        $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($templatePath);
        $templatePathAndFilename = $templateRootPath.'Email/' . $templateName . '.html';
        
        
        // Wenn das Template gefunden wurde
        if(file_exists($templatePathAndFilename)) {
            \CodingMs\Ftm\Utility\Console::log("SendMail->renderEmail() render ".$templatePathAndFilename);
            $emailView->setTemplatePathAndFilename($templatePathAndFilename);
            $emailView->assign('settings', $settings);
            $emailView->assign('data', $emailData);
            
            // Subject rendern
            $emailView->assign('part', 'subject');
            $emailData['subject'] = $emailView->render();
            
            // Message rendern
            $emailView->assign('part', 'message');
            $emailData['message'] = $emailView->render();

        }
        else {
            \CodingMs\Ftm\Utility\Console::error("SendMail->renderEmail() file not found: ".$templatePathAndFilename);
            $emailData['subject'] = 'file not found: '.$templatePathAndFilename;
            $emailData['message'] = 'file not found: '.$templatePathAndFilename;
        }
        return $emailData;
    }
    
}
?>