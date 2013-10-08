<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_ftm_domain_model_templatelessvariable'] = array(
    'ctrl' => $TCA['tx_ftm_domain_model_templatelessvariable']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'variable_title, variable_name, variable_type, category, variable_value, variable_string, variable_color',
    ),
    'types' => array(
        '1' => array('showitem' => 'variable_title, variable_name, variable_type, category, variable_value, variable_string, variable_color'),
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
                'foreign_table' => 'tx_ftm_domain_model_templatelessvariable',
                'foreign_table_where' => 'AND tx_ftm_domain_model_templatelessvariable.pid=###CURRENT_PID### AND tx_ftm_domain_model_templatelessvariable.sys_language_uid IN (-1,0)',
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
        'variable_title' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatelessvariable.variable_title',
            'config' => array(
                'type' => 'input',
                'size' => 255,
                'eval' => 'trim'
            )
        ),
        'variable_name' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatelessvariable.variable_name',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            )
        ),
        'variable_type' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatelessvariable.variable_type',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('String', 'string'),
                    array('Wert (bspw. 1px, 2%, etc.)', 'value'),
                    array('Color', 'color'),
                ),
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'required',
                'onChange' => 'reload'
            ),
        ),
        'category' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatelessvariable.category',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            )
        ),
        'variable_value' => array(
            'displayCond' => 'FIELD:variable_type:=:value',
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatelessvariable.variable_value',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'variable_string' => array(
            'displayCond' => 'FIELD:variable_type:=:string',
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatelessvariable.variable_string',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'variable_color' => array(
            'displayCond' => 'FIELD:variable_type:=:color',
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatelessvariable.variable_color',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'wizards' => array(
                    'colorpick' => array(
                        'type' => 'colorbox',
                        'title' => 'Color picker',
                       'script' => 'wizard_colorpicker.php',
                       'dim' => '20x20',
                       'tableStyle' => 'border: solid 1px black; margin-left: 20px;',
                       'JSopenParams' => 'height=550,width=365,status=0,menubar=0,scrollbars=1',
                       'exampleImg' => 'gfx/wizard_colorpickerex.jpg',
                   )
               )
            ),
        ),
        'template' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
    ),
);

?>