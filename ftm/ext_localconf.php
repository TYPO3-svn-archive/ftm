<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

// Bei neuem TYPOScript-Snippet, verbinden mit Template
// Oder beim Speichern ggf. in Datei schreiben
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] 
       = 'EXT:ftm/Classes/Controller/PluginCloudBaseController.php:CodingMs\Ftm\Controller\PluginCloudBaseController';

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass'][]
    = 'EXT:ftm/Classes/Controller/PluginCloudBaseController.php:CodingMs\Ftm\Controller\PluginCloudBaseController';

?>