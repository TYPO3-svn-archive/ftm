<?php

if (TYPO3_MODE === 'BE') {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['BackendLayoutFileProvider']['dir'][]
        =  'EXT:###templateDir###/Resources/Private/BackendLayouts/';
}