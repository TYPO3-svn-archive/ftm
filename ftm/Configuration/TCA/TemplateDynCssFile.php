<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_ftm_domain_model_templatedyncssfile'] = array(
    'ctrl' => $TCA['tx_ftm_domain_model_templatedyncssfile']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, type, filename, description, variables, dyn_css, public_readable, public_writeable',
    ),
    'types' => array(
        '1' => array('showitem' =>
            '--div--;LLL:EXT:ftm/Resources/Private/Language/locallang_db_templatedyncssfile.xlf:tx_ftm_templatedyncssfile.tab_dyncss, name, type, filename, variables;;;wizards[t3editorCss], dyn_css;;;wizards[t3editorCss],'.
            '--div--;LLL:EXT:ftm/Resources/Private/Language/locallang_db_templatedyncssfile.xlf:tx_ftm_templatedyncssfile.tab_description, description,'.
            '--div--;LLL:EXT:ftm/Resources/Private/Language/locallang_db_templatedyncssfile.xlf:tx_ftm_templatedyncssfile.tab_synchronization, dyn_css_file_save, public_readable, public_writeable, dyn_css_file_load'
        ),
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
                'foreign_table' => 'tx_ftm_domain_model_templatedyncssfile',
                'foreign_table_where' => 'AND tx_ftm_domain_model_templatedyncssfile.pid=###CURRENT_PID### AND tx_ftm_domain_model_templatedyncssfile.sys_language_uid IN (-1,0)',
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

        'name' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db_templatedyncssfile.xlf:tx_ftm_templatedyncssfile.name',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'filename' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db_templatedyncssfile.xlf:tx_ftm_templatedyncssfile.filename',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'type' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db_templatedyncssfile.xlf:tx_ftm_templatedyncssfile.type',
            'config' => array(
                'type' => 'select',
                'items' => array(

                    array('Libraryd', 'Variables'),
                    array('Variables', 'Variables'),
                    array('Menu', 'Menu'),
                    array('Plugin', 'Plugin'),
                    array('ContentLayouts',     'ContentLayouts'),
                    array('GridElementLayouts', 'GridElementLayouts'),

                ),
                'size' => 1,
                'maxitems' => 1,
                'eval' => ''
            ),
        ),
        'description' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db_templatedyncssfile.xlf:tx_ftm_templatedyncssfile.description',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
//                'wizards' => array(
//                    'RTE' => array(
//                        'icon' => 'wizard_rte2.gif',
//                        'notNewRecords'=> 1,
//                        'RTEonly' => 1,
//                        'script' => 'wizard_rte.php',
//                        'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
//                        'type' => 'script'
//                    )
//                )
            ),
            'defaultExtras' => 'fixed-font',
        ),
        'variables' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db_templatedyncssfile.xlf:tx_ftm_templatedyncssfile.variables',
            'config' => array(
                'type' => 'text',
                'cols' => 112,
                'rows' => 12,
                'eval' => 'trim',
                'wizards' => array(
                    't3editorCss' => array(
                        'enableByTypeConfig' => 1,
                        'type' => 'userFunc',
                        'userFunc' => 'EXT:t3editor/Classes/FormWizard.php:\TYPO3\CMS\T3editor\FormWizard->main',
                        'params' => array(
                            'format' => 'css',
                            'style' => 'width: 98%; height: 300px',
                        ),
                    ),
                ),
            ),
        ),
        'dyn_css' => array(
            'displayCond' => array(
                'OR' => array(
                    'FIELD:type:=:Menu',
                    'FIELD:type:=:Plugin',
                    'FIELD:type:=:ContentLayouts',
                    'FIELD:type:=:GridElementLayouts',
                ),
            ),
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db_templatedyncssfile.xlf:tx_ftm_templatedyncssfile.dyn_css',
            'config' => array(
                'type' => 'text',
                'cols' => 112,
                'rows' => 16,
                'eval' => 'trim',
                'wizards' => array(
                    't3editorCss' => array(
                        'enableByTypeConfig' => 1,
                        'type' => 'userFunc',
                        'userFunc' => 'EXT:t3editor/Classes/FormWizard.php:\TYPO3\CMS\T3editor\FormWizard->main',
                        'params' => array(
                            'format' => 'css',
                            'style' => 'width: 98%; height: 600px',
                        ),
                    ),
                ),
            ),
        ),

        // DynCss-Datei speichern
        'dyn_css_file_save' => array (
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db_templatedyncssfile.xlf:tx_ftm_templatedyncssfile.save_file',
            'config' => array (
                'type' => 'user',
                'userFunc' => 'CodingMs\Ftm\Backend\DynCssFileSaveRow->renderField',
                'param1' => 'typo_script_snippet'

            )
        ),
        'public_readable' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db_templatedyncssfile.xlf:tx_ftm_templatedyncssfile.public_readable',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'public_writeable' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db_templatedyncssfile.xlf:tx_ftm_templatedyncssfile.public_writeable',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'dyn_css_file_load' => array (
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db_templatedyncssfile.xlf:tx_ftm_templatedyncssfile.load_file',
            'config' => array (
                'type' => 'user',
                'userFunc' => 'CodingMs\Ftm\Backend\DynCssFileLoadRow->renderField',
                'param1' => 'typo_script_snippet'

            )
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
        $TCA['tx_ftm_domain_model_templatedyncssfile']['columns']['dyn_css']['config']['wizards']['t3editorCss']['userFunc'] =
        'EXT:t3editor/classes/class.tx_t3editor_tceforms_wizard.php:tx_t3editor_tceforms_wizard->main';
    }
}


?>