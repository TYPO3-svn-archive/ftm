<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_ftm_domain_model_template'] = array(
    'ctrl' => $TCA['tx_ftm_domain_model_template']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'site_name, template_mode, template_type, template_dir, config, meta, language, fluid, typo_script_snippet, dyn_css_info, dyn_css_files, menu_container', // , extensions_info, extensions
    ),
    'types' => array(
        '1' => array('showitem' => 'site_name, template_mode, template_type, template_dir, config, meta, language,'.
            '--div--;LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.tab_fluid, fluid,'.
            '--div--;LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.tab_typoscript_snippets, typo_script_snippet_info, typo_script_snippet,'.
            '--div--;LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.tab_menu, menu_container,'.
            '--div--;LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.tab_dyncss, dyn_css_info, dyn_css_file'),
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
                #'type' => 'select',
                #'items' => array(
                #    array('', ''),
                #    array('YAML', 'yaml'),
                #    array('Twitter Bootstrap 2.x', 'bootstrap'),
                #    array('Twitter Bootstrap 3.x', 'bootstrap_3'),
                #),
                #'size' => 1,
                #'maxitems' => 1
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
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
        
        // DynCss
        'dyn_css_info' => array (
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.dyn_css_info',
            'config' => array (
                'type' => 'user',
                'userFunc' => 'CodingMs\Ftm\Backend\InformationRow->renderField',
                'param1' => 'dyn_css_info'
                
            )
        ),
        'dyn_css_file' => array(
            'exclude' => 0,
            //'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.dyn_css_file',
            'config' => array(
                'type' => 'select',
                'size' => 25,
                'internal_type' => 'db',
                'allowed' => 'tx_ftm_domain_model_templatedyncssfile',
                'foreign_table' => 'tx_ftm_domain_model_templatedyncssfile',
                'MM' => 'tx_ftm_domain_model_templatedyncssfile_mm',
                'foreign_table_where' => 'AND tx_ftm_domain_model_templatedyncssfile.pid=###CURRENT_PID### ORDER BY tx_ftm_domain_model_templatedyncssfile.name', //sorting',
                'foreign_field'  => 'template',
                'foreign_sortby' => 'sorting',
                'minitems' => 0,
                'maxitems' => 999,
                'multiple' => 0,
                'wizards' => array(
                    '_PADDING' => 1,
                    '_VERTICAL' => 1,
                    'edit' => array(
                        'type' => 'popup',
                        'title' => 'Edit', // @todo: Translation
                        'script' => 'wizard_edit.php',
                        'icon' => 'edit2.gif',
                        'popup_onlyOpenIfSelected' => 1,
                        'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
                    ),
                    'add' => Array(
                        'type' => 'script',
                        'title' => 'Create new', // @todo: Translation
                        'icon' => 'add.gif',
                        'params' => array(
                            'table' => 'tx_ftm_domain_model_templatedyncssfile',
                            'pid' => '###CURRENT_PID###',
                            'setValue' => 'prepend'
                        ),
                        'script' => 'wizard_add.php',
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
                'foreign_table'       =>     'tx_ftm_domain_model_templatefluid',
                'foreign_table_where' => 'AND tx_ftm_domain_model_templatefluid.pid=###CURRENT_PID### ORDER BY tx_ftm_domain_model_templatefluid.sorting',
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
        
        // TYPOScript-Snippets
        'typo_script_snippet_info' => array (
            'exclude' => 1,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.typoscript_snippets',
            'config' => array (
                'type' => 'user',
                'userFunc' => 'CodingMs\Ftm\Backend\InformationRow->renderField',
                'param1' => 'typo_script_snippet'
                
            )
        ),
        'typo_script_snippet' => array(
            'exclude' => 1,
            //'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template.typoscript_snippet',
            'config' => array(
                'type' => 'select',
                // 'type' => 'inline',
                'size' => 25,
                'internal_type' => 'db',
                'allowed' => 'tx_ftm_domain_model_templatetyposcriptsnippet',
                'foreign_table'       =>          'tx_ftm_domain_model_templatetyposcriptsnippet',
                'MM' => 'tx_ftm_domain_model_templatetyposcriptsnippet_mm',
                'foreign_table_where' => 'AND tx_ftm_domain_model_templatetyposcriptsnippet.pid=###CURRENT_PID### ORDER BY tx_ftm_domain_model_templatetyposcriptsnippet.sorting',
                'foreign_field'  => 'template',
                'foreign_sortby' => 'sorting',
                'foreign_label' => 'name',
                'minitems' => 0,
                'maxitems' => 999,
                'multiple' => 0,
                'wizards' => array(
                    '_PADDING' => 1,
                    '_VERTICAL' => 1,
                    'edit' => array(
                        'type' => 'popup',
                        'title' => 'Edit', // @todo: Translation
                        'script' => 'wizard_edit.php',
                        'icon' => 'edit2.gif',
                        'popup_onlyOpenIfSelected' => 1,
                        'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
                        ),
                    'add' => Array(
                        'type' => 'script',
                        'title' => 'Create new', // @todo: Translation
                        'icon' => 'add.gif',
                        'params' => array(
                            'table' => 'tx_ftm_domain_model_templatetyposcriptsnippet',
                            'pid' => '###CURRENT_PID###',
                            'setValue' => 'prepend'
                            ),
                        'script' => 'wizard_add.php',
                    ),
                ),
            ),
        ),
        
    ),
);

?>