<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_ftm_domain_model_templatetyposcriptsnippet'] = array(
    'ctrl' => $TCA['tx_ftm_domain_model_templatetyposcriptsnippet']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, type, description, constants, setup',
    ),
    'types' => array(
        '1' => array('showitem' => 'typo_script_snippet_save, name, type, description, constants;;;wizards[t3editorTypoScript], setup;;;wizards[t3editorTypoScript]'),
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
    'columns' => array(
        'sys_language_uid' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_ftm_domain_model_templatetyposcriptsnippet',
                'foreign_table_where' => 'AND tx_ftm_domain_model_templatetyposcriptsnippet.pid=###CURRENT_PID### AND tx_ftm_domain_model_templatetyposcriptsnippet.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
        't3ver_label' => array(
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            )
        ),
        'hidden' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
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
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
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
        
        // TYPOScript-Snippet speichern
        'typo_script_snippet_save' => array (
            'exclude' => 0,
            'config' => array (
                'type' => 'user',
                'userFunc' => 'CodingMs\Ftm\Backend\InformationRow->renderField',
                'param1' => 'typo_script_snippet'
                
            )
        ),
        'name' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xlf:tx_ftm_domain_model_templatetyposcriptsnippet.name',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'type' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xlf:tx_ftm_domain_model_templatetyposcriptsnippet.type',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('-- Label --', 0),
                ),
                'size' => 1,
                'maxitems' => 1,
                'eval' => ''
            ),
        ),
        'description' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xlf:tx_ftm_domain_model_templatetyposcriptsnippet.description',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'wizards' => array(
                    'RTE' => array(
                        'icon' => 'wizard_rte2.gif',
                        'notNewRecords'=> 1,
                        'RTEonly' => 1,
                        'script' => 'wizard_rte.php',
                        'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
                        'type' => 'script'
                    )
                )
            ),
            'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
        ),
        'constants' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xlf:tx_ftm_domain_model_templatetyposcriptsnippet.constants',
            'config' => array(
                'type' => 'text',
                'cols' => 112,
                'rows' => 12,
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
        'setup' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xlf:tx_ftm_domain_model_templatetyposcriptsnippet.setup',
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
        $TCA['tx_ftm_domain_model_templatetyposcriptsnippet']['columns']['sonstants']['config']['wizards']['t3editorTypoScript']['userFunc'] = 
        'EXT:t3editor/classes/class.tx_t3editor_tceforms_wizard.php:tx_t3editor_tceforms_wizard->main';
        $TCA['tx_ftm_domain_model_templatetyposcriptsnippet']['columns']['setup']['config']['wizards']['t3editorTypoScript']['userFunc'] = 
        'EXT:t3editor/classes/class.tx_t3editor_tceforms_wizard.php:tx_t3editor_tceforms_wizard->main';
    }
}


?>