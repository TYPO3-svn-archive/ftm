<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}



// Cache leeren
//$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['additionalBackendItems']['cacheActions'][]
//= 'CodingMs\Ftm\Hooks\CacheMenu';
//$TYPO3_CONF_VARS['BE']['AJAX']['tx_ftm_service_clearcache::clear']
//= 'EXT:ftm/Classes/Service/ClearCache.php:CodingMs\Ftm\Service\ClearCache->clear';

// $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/template.php']['docHeaderButtonsHook'][] 
// = 'EXT:ftm/Classes/Service/ClearCache.php:CodingMs\Ftm\Service\ClearCache->pageIcon';

// Bei neuem TYPOScript-Snippet, verbinden mit Template
// Oder beim Speichern ggf. in Datei schreiben
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] 
       = 'EXT:ftm/Classes/Controller/PluginCloudBaseController.php:CodingMs\Ftm\Controller\PluginCloudBaseController';


?>