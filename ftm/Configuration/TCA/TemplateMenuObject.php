<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_ftm_domain_model_templatemenuobject'] = array(
    'ctrl' => $TCA['tx_ftm_domain_model_templatemenuobject']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'hidden, menu_type, exp_all, std_wrap, std_wrap_html_special_chars, wrap, wrap_html_special_chars, menu_states',
    ),
    'types' => array(
        '1' => array('showitem' => 'hidden;;1, menu_type, exp_all, std_wrap, std_wrap_html_special_chars, wrap, wrap_html_special_chars, menu_states'),
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
                'foreign_table' => 'tx_ftm_domain_model_templatemenuobject',
                'foreign_table_where' => 'AND tx_ftm_domain_model_templatemenuobject.pid=###CURRENT_PID### AND tx_ftm_domain_model_templatemenuobject.sys_language_uid IN (-1,0)',
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
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenuobject.sorting',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'menu_type' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenuobject.menu_type',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => 'TMENU',
                'readOnly' => 1
            ),
        ),
        'exp_all' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenuobject.exp_all',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'std_wrap' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenuobject.std_wrap',
            'config' => array(
                'type' => 'input',
                'size' => 69,
                'eval' => 'trim'
            ),
        ),
        'std_wrap_html_special_chars' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenuobject.std_wrap_html_special_chars',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'wrap' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenuobject.wrap',
            'config' => array(
                'type' => 'input',
                'size' => 69,
                'eval' => 'trim'
            ),
        ),
        'wrap_html_special_chars' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenuobject.wrap_html_special_chars',
            'config' => array(
                'type' => 'check',
            ),
        ),
        
        // Menu-Ebenen
        'menu_states' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenuobject.menu_states',
            'config' => array(
                'type' => 'inline',
                'foreign_table'       =>          'tx_ftm_domain_model_templatemenustate',
                'foreign_table_where' => 'ORDER BY tx_ftm_domain_model_templatemenustate.sorting',
                'foreign_field'  => 'template_menu_object',
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
        
        'template_menu_container' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
    ),
);

?>