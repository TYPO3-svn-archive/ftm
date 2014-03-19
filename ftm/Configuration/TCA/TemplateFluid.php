<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_ftm_domain_model_templatefluid'] = array(
    'ctrl' => $TCA['tx_ftm_domain_model_templatefluid']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'template_title, template_type, template_file, backend_layout, template_code',
    ),
    'types' => array(
        '1' => array('showitem' => 'template_title, template_type, template_file, backend_layout, template_code;;;wizards[t3editorHtml]'),/* */
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
                'foreign_table' => 'tx_ftm_domain_model_templatefluid',
                'foreign_table_where' => 'AND tx_ftm_domain_model_templatefluid.pid=###CURRENT_PID### AND tx_ftm_domain_model_templatefluid.sys_language_uid IN (-1,0)',
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
        'sorting' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatefluid.sorting',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'template_title' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatefluid.template_title',
            'config' => array(
                'type' => 'input',
                'size' => 255,
                'eval' => 'trim'
            ),
        ),
        'template_type' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatefluid.template_type',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('Fluid-Template', 'template'),
                    array('Fluid-Layout', 'layout'),
                    array('Fluid-Partial', 'partial'),
                ),
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'required'
            )
        ),
        'template_file' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatefluid.template_file',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'template_code' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatefluid.template_code',
            'config' => array(
                'type' => 'text',
                'cols' => 112,
                'rows' => 36,
                'eval' => 'trim',
                'wizards' => array(
                    't3editorHtml' => array(
                        'enableByTypeConfig' => 1,
                        'type' => 'userFunc',
                        'userFunc' => 'EXT:t3editor/Classes/FormWizard.php:\TYPO3\CMS\T3editor\FormWizard->main',
                        'params' => array(
                            'format' => 'html',
                        ),
                    )/*,
                    't3editorTypoScript' => array(
                        'enableByTypeConfig' => 1,
                        'type' => 'userFunc',
                        'userFunc' => 'EXT:t3editor/Classes/FormWizard.php:\TYPO3\CMS\T3editor\FormWizard->main',
                        'params' => array(
                            'format' => 'ts',
                        ),
                    ),*/
                ),
            ),
        ),
        'backend_layout' => array(
            'exclude' => 0,
            'displayCond' => 'FIELD:template_type:=:template',
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatefluid.backend_layout',
            'config' => array(
                'type' => 'select', 
                'foreign_table' => 'backend_layout',   
                'foreign_table_where' => 'AND backend_layout.hidden=0 AND backend_layout.deleted=0  ORDER BY backend_layout.sorting',  
                'size' => 1,    
                'minitems' => 1,
                'maxitems' => 1,
                'eval' => 'required'
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
        $TCA['tx_ftm_domain_model_templatefluid']['columns']['template_code']['config']['wizards']['t3editorHtml']['userFunc'] = 
        'EXT:t3editor/classes/class.tx_t3editor_tceforms_wizard.php:tx_t3editor_tceforms_wizard->main';
    }
}

?>