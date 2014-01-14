<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}



// Cache leeren
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['additionalBackendItems']['cacheActions'][] 
= 'CodingMs\Ftm\Hooks\CacheMenu';
$TYPO3_CONF_VARS['BE']['AJAX']['tx_ftm_service_clearcache::clear'] 
= 'EXT:ftm/Classes/Service/ClearCache.php:CodingMs\Ftm\Service\ClearCache->clear';

// $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/template.php']['docHeaderButtonsHook'][] 
// = 'EXT:ftm/Classes/Service/ClearCache.php:CodingMs\Ftm\Service\ClearCache->pageIcon';

// Bei neuem TYPOScript-Snippet, verbinden mit Template
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] 
       = 'EXT:ftm/Classes/Controller/TypoScriptSnippetController.php:CodingMs\Ftm\Controller\TypoScriptSnippetController';

/*
 * Hook um eigenes JavaScript im BE hinzuzufügen
 * -> Fuer Tabs
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/template.php']['preHeaderRenderHook'][]
= 'EXT:ftm/Classes/Service/AddBackendJavaScript.php:CodingMs\Ftm\Service\AddBackendJavaScript->addBackendJavaScript';

?>