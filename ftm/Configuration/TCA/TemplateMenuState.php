<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_ftm_domain_model_templatemenustate'] = array(
    'ctrl' => $TCA['tx_ftm_domain_model_templatemenustate']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'hidden, menu_state, copy_from_state, std_wrap, std_wrap_html_special_chars, wrap, wrap_html_special_chars',
    ),
    'types' => array(
        '1' => array('showitem' => 'hidden;;1, menu_state, copy_from_state, std_wrap, std_wrap_html_special_chars, wrap, wrap_html_special_chars'),
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
                'foreign_table' => 'tx_ftm_domain_model_templatemenustate',
                'foreign_table_where' => 'AND tx_ftm_domain_model_templatemenustate.pid=###CURRENT_PID### AND tx_ftm_domain_model_templatemenustate.sys_language_uid IN (-1,0)',
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
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenustate.sorting',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'menu_state' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenustate.menu_state',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    //array('NO',         'NO - Normal - Muss immer angegeben werden'),
                    array('NO - Normal - Muss immer angegeben werden',                                             'NO'),
                    array('ACT - Einstellungen für Menü-Objekte auf der Rootline',                                 'ACT'),
                    array('ACTRO - MouseOver für Menü-Objekte auf der Rootline',                                   'ACTRO'),
                    array('ACTIFSUB - Einstellungen für Menü-Objekte auf der Rootline, die Unterseiten haben',     'ACTIFSUB'),
                    array('ACTIFSUBRO - MouseOver für Menü-Objekte auf der Rootline, die Unterseiten haben',       'ACTIFSUBRO'),
                    array('CUR - Einstellungen der aktuellen Seite/Menü-Objektes',                                 'CUR'),
                    array('CURRO - MouseOver der aktuellen Seite/Menü-Objektes',                                   'CURRO'),
                    array('CURIFSUB - Einstellungen der aktuellen Seite/Menü-Objekt, wenn dieser Unterseiten hat', 'CURIFSUB'),
                    array('CURIFSUBRO - MouseOver der aktuellen Seite/Menü-Objekt, wenn diese Unterseiten hat',    'CURIFSUBRO'),
                    array('IFSUB - Einstellungen wenn Menü-Objekt Unterseiten besitzt',                            'IFSUB'),
                    array('IFSUBRO - MouseOver wenn Menü-Objekt Unterseiten besitzt',                              'IFSUBRO'),
                    array('SPC - Einstellungen für Menü-Trenner',                                                  'SPC'),
                ),
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'required'
            ),
        ),
        
        'copy_from_state' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenustate.copy_from_state',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('Von keinem kopieren',                                                                   'NONE'),
                    array('NO - Normal - Muss immer angegeben werden',                                             'NO'),
                    array('ACT - Einstellungen für Menü-Objekte auf der Rootline',                                 'ACT'),
                    array('ACTRO - MouseOver für Menü-Objekte auf der Rootline',                                   'ACTRO'),
                    array('ACTIFSUB - Einstellungen für Menü-Objekte auf der Rootline, die Unterseiten haben',     'ACTIFSUB'),
                    array('ACTIFSUBRO - MouseOver für Menü-Objekte auf der Rootline, die Unterseiten haben',       'ACTIFSUBRO'),
                    array('CUR - Einstellungen der aktuellen Seite/Menü-Objektes',                                 'CUR'),
                    array('CURRO - MouseOver der aktuellen Seite/Menü-Objektes',                                   'CURRO'),
                    array('CURIFSUB - Einstellungen der aktuellen Seite/Menü-Objekt, wenn dieser Unterseiten hat', 'CURIFSUB'),
                    array('CURIFSUBRO - MouseOver der aktuellen Seite/Menü-Objekt, wenn diese Unterseiten hat',    'CURIFSUBRO'),
                    array('IFSUB - Einstellungen wenn Menü-Objekt Unterseiten besitzt',                            'IFSUB'),
                    array('IFSUBRO - MouseOver wenn Menü-Objekt Unterseiten besitzt',                              'IFSUBRO'),
                    array('SPC - Einstellungen für Menü-Trenner',                                                  'SPC'),
                ),
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'required'
            )
        ),
        'std_wrap' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenustate.std_wrap',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'std_wrap_html_special_chars' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenustate.std_wrap_html_special_chars',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'wrap' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenustate.wrap',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'wrap_html_special_chars' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenustate.wrap_html_special_chars',
            'config' => array(
                'type' => 'check',
            ),
        ),
        
        'template_menu_object' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
    ),
);

?>