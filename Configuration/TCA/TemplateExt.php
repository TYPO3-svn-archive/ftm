<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_ftm_domain_model_templateext'] = array(
    'ctrl' => $TCA['tx_ftm_domain_model_templateext']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'hidden, ext_key, ext_name, ext_version, ext_conf_t3_less',
    ),
    'types' => array(
        '1' => array('showitem' => 'hidden;;1, ext_key, ext_name, ext_version, ext_conf_t3_less'),
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
                'foreign_table' => 'tx_ftm_domain_model_templateext',
                'foreign_table_where' => 'AND tx_ftm_domain_model_templateext.pid=###CURRENT_PID### AND tx_ftm_domain_model_templateext.sys_language_uid IN (-1,0)',
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
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateext.hidden',
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
        'ext_key' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateext.ext_key',
            'config' => array(
                'type' => 'input',
                'readOnly' => 1,
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'ext_name' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateext.ext_name',
            'config' => array(
                'type' => 'input',
                'readOnly' => 1,
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'ext_version' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateext.ext_version',
            'config' => array(
                'type' => 'input',
                'readOnly' => 1,
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'ext_conf_t3_less' => array(
            'displayCond' => 'FIELD:ext_key:=:t3_less',
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateext.ext_conf_t3_less',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_ftm_domain_model_templateextt3less',
                'minitems' => 0,
                'maxitems' => 1,
                'appearance' => array(
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'bottom',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1,
                    
                    /* Loeschen, Erstellen, etc Buttons ausblenden */
                    'enabledControls' => array(
                        'info'     => true,
                        'new'      => false,
                        'dragdrop' => false,
                        'sort'     => false,
                        'hide'     => false,
                        'delete'   => false
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

?>