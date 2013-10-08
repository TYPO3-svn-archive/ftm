<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_ftm_domain_model_templatemarker'] = array(
    'ctrl' => $TCA['tx_ftm_domain_model_templatemarker']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'marker_save, marker_name, marker_type, marker_description, marker_typo_script',
    ),
    'types' => array(
        '1' => array('showitem' => 'marker_save, marker_name, marker_type, marker_description, marker_typo_script;;;wizards[t3editorTypoScript]'),/* */
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
    'columns' => array(
        'sys_language_uid' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_ftm_domain_model_templatemarker',
                'foreign_table_where' => 'AND tx_ftm_domain_model_templatemarker.pid=###CURRENT_PID### AND tx_ftm_domain_model_templatemarker.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
        't3ver_label' => array(
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            )
        ),
        'hidden' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
            ),
        ),
        'endtime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
            ),
        ),
        
        // Marker
        'marker_save' => array (
            'exclude' => 0,
            //'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.marker', 
            'config' => array (
                'type' => 'user',
                'userFunc' => 'CodingMs\Ftm\Backend\InformationRow->renderField',
                'param1' => 'marker'
                
            )
        ),
        'marker_description' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemarker.marker_description',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'marker_name' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemarker.marker_name',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'marker_type' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemarker.marker_type',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('TEXT - Text-Marker',                        'TEXT'),
                    array('FILE - Datei-Marker',                       'FILE'),
                    array('IMAGE - Bild-Marker',                       'IMAGE'),
                    array('COA - Content Object Array',                'COA'),
                    array('COA_INT - Content Object Array (nicht gecacht)', 'COA_INT'),
                    array('CARRAY - Content-Array',                    'CARRAY'),
                    array('CASE - Switch-Case',                        'CASE'),
                    array('CONTENT - Inhalt aus der Datenbank',        'CONTENT'),
                    array('IMGTEXT - Bild mit Text-Marker',            'IMGTEXT'),
                    array('IMG_RESOURCE - Bild-Marker(nur Resource)',  'IMG_RESOURCE'),
                    array('LOAD_REGISTER - Register-Zugriff',          'LOAD_REGISTER'),
                    array('RESTORE_REGISTER - Register-Zurücksetzen',  'RESTORE_REGISTER'),
                    array('MULTIMEDIA - Multimedia-Marker',            'MULTIMEDIA'),
                    array('RECORDS - Content-Marker',                  'RECORDS'),
                    array('USER - PHP-Funktion/Methode aufrufen',      'USER'),
                    array('USER_INT - PHP-Funktion/Methode aufrufen (nicht gecacht)', 'USER_INT'),
                ),
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'required'
            ),
        ),
        'marker_typo_script' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemarker.marker_typo_script',
            'config' => array(
                'type' => 'text',
                'cols' => 112,
                'rows' => 36,
                'eval' => 'trim',
                'wizards' => array(
                    /*'t3editorHtml' => array(
                        'enableByTypeConfig' => 1,
                        'type' => 'userFunc',
                        'userFunc' => 'EXT:t3editor/classes/class.tx_t3editor_tceforms_wizard.php:tx_t3editor_tceforms_wizard->main',
                        'params' => array(
                            'format' => 'html',
                        ),
                    ),*/
                    't3editorTypoScript' => array(
                        'enableByTypeConfig' => 1,
                        'type' => 'userFunc',
                        'userFunc' => 'EXT:t3editor/Classes/class.tx_t3editor_tceforms_wizard.php:tx_t3editor_tceforms_wizard->main',
                        'params' => array(
                            'format' => 'ts',
                        ),
                    ),
                ),
            ),
        ),
       
        'template' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
    ),
);


if(isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['compat_version'])) {
    if((float)$GLOBALS['TYPO3_CONF_VARS']['SYS']['compat_version']<6) {
        $TCA['tx_ftm_domain_model_templatemarker']['columns']['marker_typo_script']['config']['wizards']['t3editorTypoScript']['userFunc'] = 
        'EXT:t3editor/classes/class.tx_t3editor_tceforms_wizard.php:tx_t3editor_tceforms_wizard->main';
    }
}


?>