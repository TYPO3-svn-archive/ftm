<?php
namespace CodingMs\Ftm\Hooks;

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

require_once(PATH_typo3.'/sysext/backend/Classes/Toolbar/ClearCacheActionsHookInterface.php');
require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('ftm').'Classes/Service/ClearCache.php');


/**
 * Hook fuer FTM-Cache leeren
 *
 * @package ftm
 * @subpackage Service
 * 
 * @author Thomas Deuling <typo3@coding.ms>
 * @since 1.0.0
 */
class CacheMenu implements \TYPO3\CMS\Backend\Toolbar\ClearCacheActionsHookInterface {

    /**
     * Adds the option to clear the RealURL cache in the back-end clear cache menu.
     *
     * @param array $a_cacheActions
     * @param array $a_optionValues
     * @return void
     * @see typo3/interfaces/backend_cacheActionsHook#manipulateCacheActions($cacheActions, $optionValues)
     */
    public function manipulateCacheActions(&$a_cacheActions, &$a_optionValues) {
        if(($GLOBALS['BE_USER']->isAdmin() || $GLOBALS['BE_USER']->getTSConfigVal('options.clearCache.ftm')) && $GLOBALS['TYPO3_CONF_VARS']['EXT']['extCache']) {
            $s_title = $GLOBALS['LANG']->sL('LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.clear_cache', true);
            $s_imagePath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('ftm').'Resources/Public/Icons/';
            if(strpos($s_imagePath,'typo3conf') !== false) $s_imagePath = '../'.$s_imagePath;
            $a_cacheActions[] = array(
                'id'    => 'ftm',
                'title' => $s_title,
                'href' => 'ajax.php?ajaxID=tx_ftm_service_clearcache::clear',
                'icon'  => '<img src="'.$s_imagePath.'clearCache.png" title="'.$s_title.'" alt="'.$s_title.'" />',
            );
            $a_optionValues[] = 'clearCacheFtm';
        }
    }
}

?>