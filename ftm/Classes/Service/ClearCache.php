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
 * Leert den Cache
 *
 * @package ftm
 * @subpackage Service
 * 
 * @author Thomas Deuling <typo3@coding.ms>
 * @since 1.0.0
 */
class ClearCache {

    /**
     * Template Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\TemplateRepository
     */
    protected static $fluidTemplateRepository;

    /**
     * Clears the FTM-Cache
     *
     * @return  void
     */
    public static function clear() {

        // Alle vorhandenen FTM-Templates ermitteln
        self::$fluidTemplateRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('CodingMs\Ftm\Domain\Repository\TemplateRepository');
        $templates = self::$fluidTemplateRepository->findAllForClearCache();
        
        $templateArray = array();
        if(!empty($templates)) {
            foreach($templates as $template) {
                
                // Less-Pfad ermitteln
                $relPath = \CodingMs\Ftm\Utility\Tools::getDirectory("Less", $template->getTemplateDir());
                $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
                
                // Pruefen ob es das Less-Verzeichnis gibt
                if(file_exists($absPath)) {
                    $templateArray[$template->getTemplateDir()] = $absPath;
                }
                
            }
        }
        
        
        
        if(!empty($templateArray)) {
            foreach($templateArray as $template => $path) {


                // Alle Less-Dateien veraendern und touchen
                // Damit der Less-Compiler sie neu schreibt
                if($handle=opendir($path)) {
                    while($file=readdir($handle)){
                        if(substr($file , 0, 1) != ".") {
                            file_put_contents($path.$file, ' ', FILE_APPEND);
                            touch($path.$file);
                        }
                    }
                }

            }
        }
        
        
    }
    
    /**
     * Adds the icons for clearing a single pages' RealURL caches
     * 
     * @param array $a_params
     * @param object $o_parent
     * @return void
     */
    public function pageIcon(&$a_params,$o_parent) {
        // // Check if we are actually inside the list view, we don't want the icon to end 
        // // up inside the page tree list
        // if(!self::isInsideDbList()) return;
//         
        // // Clear cache on command 
        // if(\TYPO3\CMS\Core\Utility\GeneralUtility::_GET('realurl_clearcache') == 'page') {
            // $this->clearPageCache();
        // }
        
        // Seperate all links
        $s_buttonsMarker = str_replace(
            array(
                '</a>',
                '<a ',
            ),
            array(
                '</a>|',
                '|<a ',
            ),
            $a_params['markers']['BUTTONLIST_RIGHT']
        );
        $a_seperatedItems = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode('|',$s_buttonsMarker);
        
        // Check if there are any link items, if not we will not add ours either
        if(count($a_seperatedItems) <= 1) return;
        
        // Generate cache clearing URL
        $s_clearCacheCmdUri = \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('SCRIPT_NAME');
        $a_queryStringParts = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode('&',\TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('QUERY_STRING'));
        if(\TYPO3\CMS\Core\Utility\GeneralUtility::_GET('ftm') != 'page') $a_queryStringParts[] = 'ftm=page';
        $s_clearCacheCmdUri .= '?'.implode('&',$a_queryStringParts);
        
        // Generate our own link
        $s_title = $GLOBALS['LANG']->sL('LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.clear_cache', TRUE);
        $s_imagePath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('ftm').'Resources/Public/Icons/';
        //if(strpos($s_imagePath,'typo3conf') !== FALSE) $s_imagePath = '../'.$s_imagePath;
        $s_imagePath = str_replace('../', '/', $s_imagePath);
        $s_image = '<img src="'.$s_imagePath.'clearCache.png" title="'.$s_title.'" alt="'.$s_title.'" />';
        $s_pageIconLink = '<a href="'.$s_clearCacheCmdUri.'">'.$s_image.'</a>';
        $a_seperatedItems[2] = $s_pageIconLink;
        
        $a_params['markers']['BUTTONLIST_RIGHT'] = implode('',$a_seperatedItems);
    }

    
}

/**
 * XCLASS Inclusion
 */
if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/ftm/Classes/Service/ClearCache.php']) {
    include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/ftm/Classes/Service/ClearCache.php']);
}

?>