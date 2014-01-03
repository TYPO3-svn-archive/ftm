<?php
namespace CodingMs\Ftm\Backend;

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
 * Check for updates
 *
 * @package    TYPO3
 * @subpackage    ftm
 */
class UpdateCheckRow {

    /**
     * Render a Flexible Content Element type selection field
     *
     * @param array $parameters
     * @param mixed $parentObject
     * @return string
     */
    public function renderField(array &$parameters, &$parentObject) {
        
        // Vars
        $uid   = $parameters["row"]["uid"];
        $pid   = $parameters["row"]["pid"];
        $name  = $parameters['itemFormElName'];
        $value = $parameters['itemFormElValue'];
        
        global $TYPO3_CONF_VARS;
        
        $extensionKeyShort = str_replace('_', '', $parameters['fieldConf']['config']['extensionKey']);
        $translationKey = 'tx_'.$extensionKeyShort.'_message.'.$extensionKeyShort.'_update_available';
        $extensionKey = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($parameters['fieldConf']['config']['extensionKey']);
        $version = $TYPO3_CONF_VARS['EXTCONF'][$parameters['fieldConf']['config']['extensionKey']]['version'];
        
        $infotext = '';
        $updateMessage = \CodingMs\Ftm\Service\Updates::check($parameters['fieldConf']['config']['extensionKey'], explode('.', $version));
        if(is_string($updateMessage)) {
            $infotext = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_message.ftm_update_available", $extensionKey);
            if($infotext==NULL) {
                $infotext = '<span style="color: #C00"><b>Update available for extension '.$parameters['fieldConf']['config']['extensionKey'].'!</b></span><br/>';
                $infotext.= 'Click <a href="http://www.fluid-template-manager.de/extensions/" target="_blank"><u>here</u></a> for more information.<br/>';
                $infotext.= '<br/>';
            }
        } 
        
        return $infotext;
    }

}

?>