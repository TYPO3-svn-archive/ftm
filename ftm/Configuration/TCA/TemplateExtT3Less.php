<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_ftm_domain_model_templateextt3less'] = array(
    'ctrl' => $TCA['tx_ftm_domain_model_templateextt3less']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'extension_t3_less_info, path_to_less_files, output_folder, less_files',
    ),
    'types' => array(
        '1' => array('showitem' => 'extension_t3_less_info, path_to_less_files, output_folder, less_files'),
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
                'foreign_table' => 'tx_ftm_domain_model_templateextt3less',
                'foreign_table_where' => 'AND tx_ftm_domain_model_templateextt3less.pid=###CURRENT_PID### AND tx_ftm_domain_model_templateextt3less.sys_language_uid IN (-1,0)',
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
        'path_to_less_files' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateextt3less.path_to_less_files',
            'config' => array(
                'type' => 'input',
                'readOnly' => 1,
                'size' => 69,
                'eval' => 'trim,required'
            ),
        ),
        
        'extension_t3_less_info' => array (
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.extension_t3_less', 
            'config' => array (
                'type' => 'user',
                'userFunc' => 'CodingMs\Ftm\Backend\InformationRow->renderField',
                'param1' => 'extensions'
                
            )
        ),
        'output_folder' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateextt3less.output_folder',
            'config' => array(
                'type' => 'input',
                'readOnly' => 1,
                'size' => 69,
                'eval' => 'trim,required'
            ),
        ),
        'less_files' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateextt3less.less_files',
            'config' => array(
                'type' => 'inline',
                'foreign_table'       =>          'tx_ftm_domain_model_templateextt3lessfiles',
                'foreign_table_where' => 'ORDER BY tx_ftm_domain_model_templateextt3lessfiles.sorting',
                'foreign_field'  => 'template_ext_t3_less',
                'foreign_sortby' => 'sorting',

                'maxitems'      => 9999,
                'appearance' => array(
                    'collapseAll' => 1,
                    'levelLinksPosition' => 'bottom',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1,
                    
                    'useSortable' => 1,
                    
                    /* Loeschen, Erstellen, etc Buttons ausblenden */
                    'enabledControls' => array(
                        'info'     => true,
                        'new'      => true,
                        'dragdrop' => true,
                        'sort'     => true,
                        'hide'     => false,
                        'delete'   => true
                  ),
                ),
            ),
        ),
    ),
);

?>