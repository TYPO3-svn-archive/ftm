<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_ftm_domain_model_template'] = array(
    'ctrl' => $TCA['tx_ftm_domain_model_template']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'site_name, template_mode, template_type, template_dir, config, meta, language, fluid, marker, less_variable_info, less_variable, menu_container, extensions_info, extensions',
    ),
    'types' => array(
        '1' => array('showitem' => 'site_name, template_mode, template_type, template_dir, config, meta, language,--div--;LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.tab_fluid, fluid,--div--;LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.tab_marker, marker_info, marker,--div--;LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.tab_menu, menu_container,--div--;LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.tab_less, less_variable_info, less_variable,--div--;LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.tab_extensions, extensions_info, extensions'),
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
                'foreign_table' => 'tx_ftm_domain_model_template',
                'foreign_table_where' => 'AND tx_ftm_domain_model_template.pid=###CURRENT_PID### AND tx_ftm_domain_model_template.sys_language_uid IN (-1,0)',
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
        'template_mode' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.template_mode',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('Development', 'development'),
                    array('Production', 'production'),
                ),
                'size' => 1,
                'maxitems' => 1
            ),
        ),
        'site_name' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.site_name',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'template_type' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.template_type',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('', ''),
                    array('YAML', 'yaml'),
                    array('Twitter Bootstrap', 'bootstrap'),
                ),
                'size' => 1,
                'maxitems' => 1
            ),
        ),
        'template_dir' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.template_dir',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'md5_hash_setup_ts' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.md5_hash_setup_ts',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'md5_hash_constants_ts' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.md5_hash_constants_ts',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'md5_hash_ts_config' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.md5_hash_ts_config',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'md5_hash_template_data' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.md5_hash_template_data',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'disclaimer_accepted' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.disclaimer_accepted',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'config' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.config',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_ftm_domain_model_templateconfig',
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
                        'info'     => false,
                        'new'      => false,
                        'dragdrop' => false,
                        'sort'     => false,
                        'hide'     => false,
                        'delete'   => false
                  ),
                ),
            ),
        ),
        
        // Meta-Angaben
        'meta' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.meta',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_ftm_domain_model_templatemeta',
                'minitems' => 0,
                'maxitems' => 1,
                'appearance' => array(
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'none',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1,
                    
                    /* Loeschen, Erstellen, etc Buttons ausblenden */
                    'enabledControls' => array(
                        'info'     => false,
                        'new'      => false,
                        'dragdrop' => false,
                        'sort'     => false,
                        'hide'     => false,
                        'delete'   => false
                  ),
                ),
            ),
        ),
        
        // Website-Sprachen
        'language' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.language',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_ftm_domain_model_templatelanguage',
                'foreign_field' => 'template',
                'maxitems'      => 9999,
                'appearance' => array(
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'bottom',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ),
            ),
        ),
        
        // Less-Variablen
        'less_variable_info' => array (
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.less_variable', 
            'config' => array (
                'type' => 'user',
                'userFunc' => 'CodingMs\Ftm\Backend\InformationRow->renderField',
                'param1' => 'less_variable'
                
            )
        ),
        'less_variable' => array(
            'exclude' => 0,
            //'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.less_variable',
            'config' => array(
                'type' => 'inline',
                'foreign_table'       =>          'tx_ftm_domain_model_templatelessvariable',
                'foreign_table_where' => 'ORDER BY tx_ftm_domain_model_templatelessvariable.sorting',
                'foreign_field'  => 'template', 
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
        
        // Fluid-Templates
        'fluid' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.fluid_headline_with_info',
            'config' => array(
                'type' => 'inline',
                'foreign_table'       =>          'tx_ftm_domain_model_templatefluid',
                'foreign_table_where' => 'ORDER BY tx_ftm_domain_model_templatefluid.sorting',
                'foreign_field'  => 'template',
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
        
        // Menus
        'menu_container' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.menu_container',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_ftm_domain_model_templatemenucontainer',
                'foreign_field' => 'template',
                'maxitems'      => 9999,
                'appearance' => array(
                    'levelLinksPosition' => 'bottom',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ),
            ),
        ),
        
        // Marker
        'marker_info' => array (
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.marker',
            'config' => array (
                'type' => 'user',
                'userFunc' => 'CodingMs\Ftm\Backend\InformationRow->renderField',
                'param1' => 'marker'
                
            )
        ),
        'marker' => array(
            'exclude' => 0,
            //'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.marker',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_ftm_domain_model_templatemarker',
                'foreign_field' => 'template',
                'maxitems'      => 9999,
                'appearance' => array(
                    'collapseAll' => 1,
                    'levelLinksPosition' => 'bottom',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ),
            ),
        ),
        
        // Extensions
        'extensions_info' => array (
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.extensions', 
            'config' => array (
                'type' => 'user',
                'userFunc' => 'CodingMs\Ftm\Backend\InformationRow->renderField',
                'param1' => 'extensions'
                
            )
        ),
        'extensions' => array(
            'exclude' => 0,
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_ftm_domain_model_templateext',
                'foreign_field' => 'template',
                'maxitems'      => 9999,
                'appearance' => array(
                    'collapseAll' => 1,
                    'levelLinksPosition' => 'none',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1,
                    
                    'useSortable' => 1,
        
                    /* Loeschen, Erstellen, etc Buttons ausblenden */
                    'enabledControls' => array(
                        'info'     => true,
                        'new'      => false,
                        'dragdrop' => true,
                        'sort'     => true,
                        'hide'     => true,
                        'delete'   => false
                  ),
                ),
            ),
        ),
        
        
    ),
);

?>