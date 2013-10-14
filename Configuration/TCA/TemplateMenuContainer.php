<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_ftm_domain_model_templatemenucontainer'] = array(
    'ctrl' => $TCA['tx_ftm_domain_model_templatemenucontainer']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'hidden, menu_name, special, special_value_list, entry_level, exclude_uid_list, include_not_in_menu, max_items, min_items, std_wrap, wrap, menu_objects',
    ),
    'types' => array(
        '1' => array('showitem' => 'hidden;;1, menu_name, special, special_value_list, entry_level, exclude_uid_list, include_not_in_menu, max_items, min_items, std_wrap, wrap, menu_objects'),
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
                'foreign_table' => 'tx_ftm_domain_model_templatemenucontainer',
                'foreign_table_where' => 'AND tx_ftm_domain_model_templatemenucontainer.pid=###CURRENT_PID### AND tx_ftm_domain_model_templatemenucontainer.sys_language_uid IN (-1,0)',
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
        'menu_name' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenucontainer.menu_name',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'special' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenucontainer.special',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('Menü nach Seitenbaum', ''),
                    array('Liste von ausgewählten Seiten', 'list'),
                ),
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'required'
            )
        ),
        
        'entry_level' => array(
            'displayCond' => 'FIELD:special:=:',
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenucontainer.entry_level',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('0', '0'),
                    array('1', '1'),
                    array('2', '2'),
                    array('3', '3'),
                    array('4', '4'),
                    array('5', '5'),
                    array('6', '6'),
                    array('7', '7'),
                    array('8', '8'),
                    array('9', '9'),
                    array('-9', '-9'),
                    array('-8', '-8'),
                    array('-7', '-7'),
                    array('-6', '-6'),
                    array('-5', '-5'),
                    array('-4', '-4'),
                    array('-3', '-3'),
                    array('-2', '-2'),
                    array('-1', '-1'),
                ),
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'required'
            )
        ),
        'special_value_list' => array(
            'displayCond' => 'FIELD:special:=:list',
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenucontainer.special_value_list',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'pages',
                'size' => 5,
                'maxitems' => 999,
                'minitems' => 0,
                'show_thumbs' => 1,
                'wizards' => array(
                    'suggest' => array(
                        'type' => 'suggest',
                    ),
                ),
            ),
        ),
        'exclude_uid_list' => array(
            'displayCond' => 'FIELD:special:=:',
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenucontainer.exclude_uid_list',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'pages',
                'size' => 5,
                'maxitems' => 999,
                'minitems' => 0,
                'show_thumbs' => 1,
                'wizards' => array(
                    'suggest' => array(
                        'type' => 'suggest',
                    ),
                ),
            ),
        ),
        'include_not_in_menu' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenucontainer.include_not_in_menu',
            'config' => array(
                'type' => 'check',
            ),
        ),
        
        'max_items' => array(
            'displayCond' => 'FIELD:special:=:',
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenucontainer.max_items',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'min_items' => array(
            'displayCond' => 'FIELD:special:=:',
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenucontainer.min_items',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'std_wrap' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenucontainer.std_wrap',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'wrap' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenucontainer.wrap',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        
        // Menu-Ebenen
        'menu_objects' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenucontainer.menu_objects',
            'config' => array(
                'type' => 'inline',
                'foreign_table'       =>          'tx_ftm_domain_model_templatemenuobject',
                'foreign_table_where' => 'ORDER BY tx_ftm_domain_model_templatemenuobject.sorting',
                'foreign_field'  => 'template_menu_container',
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
        
        'template' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),

    ),
);

?>