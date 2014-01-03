<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_ftm_domain_model_templateconfig'] = array(
    'ctrl' => $TCA['tx_ftm_domain_model_templateconfig']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'doctype, use_html5_js, base_u_r_l, link_vars, disable_charset_header, meta_charset, prefix_local_anchors, speaking_paths, google_analytics_tracking_code, language_uid, language_title, language, locale_all, spam_protect_email_addresses, spam_protect_email_addresses_at_subst, spam_protect_email_addresses_last_dot_subst',
    ),
    'types' => array(
        '1' => array('showitem' => 'doctype, base_u_r_l, dyn_css, use_html5_js, link_vars, disable_charset_header, meta_charset, prefix_local_anchors, speaking_paths, google_analytics_tracking_code, --div--;LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateconfig.tab_language_and_localization, language_uid, language_title, language, locale_all,--div--;LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateconfig.tab_spam_protect, spam_protect_email_addresses, spam_protect_email_addresses_at_subst, spam_protect_email_addresses_last_dot_subst'),
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
                'foreign_table' => 'tx_ftm_domain_model_templateconfig',
                'foreign_table_where' => 'AND tx_ftm_domain_model_templateconfig.pid=###CURRENT_PID### AND tx_ftm_domain_model_templateconfig.sys_language_uid IN (-1,0)',
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
        'doctype' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateconfig.doctype',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('HTML 5', 'html5'),
                    array('XHTML 1.0 Transitional', 'xhtml_trans'),
                    array('XHTML 1.0 Frameset', 'xhtml_frames'),
                    array('XHTML 1.0 Strict', 'xhtml_strict'),
                    array('XHTML 1.1', 'xhtml_11'),
                    array('XHTML 2.0', 'xhtml_20'),
                    array('none', 'none'),
                ),
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'required'
            ),
        ),
        'dyn_css' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateconfig.dyn_css',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    //    Label                                     Typ_Verzeichnis
                    array('CSS - Verzeichnis: Public/Stylesheets', 'css_stylesheets'),
                    array('LESS - Verzeichnis: Public/Less',       'less_less'),
                    array('SCSS - Verzeichnis: Public/Sass',       'scss_sass'),
                ),
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'required'
            ),
        ),
        'use_html5_js' => array(
            'displayCond' => 'FIELD:doctype:=:html5',
            'exclude' => 1,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateconfig.use_html5_js',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'base_u_r_l' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateconfig.base_u_r_l',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'link_vars' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateconfig.link_vars',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'disable_charset_header' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateconfig.disable_charset_header',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'meta_charset' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateconfig.meta_charset',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        
        
        'language_uid' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateconfig.language_uid',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'default' => 0,
                'readOnly' => 1,
                'eval' => 'trim'
            )
        ),
        'language_title' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateconfig.language_title',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'language' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateconfig.language',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'locale_all' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateconfig.locale_all',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        
        /**
         * @ToDo: headerComment erstellen
         * der dann mit unserem Komment verkettet wird
         * Hier kann bsp. der Template ersteller drinstehen
         */
        
        'spam_protect_email_addresses' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateconfig.spam_protect_email_addresses',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'spam_protect_email_addresses_at_subst' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateconfig.spam_protect_email_addresses_at_subst',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'spam_protect_email_addresses_last_dot_subst' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateconfig.spam_protect_email_addresses_last_dot_subst',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        
        
        'prefix_local_anchors' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateconfig.prefix_local_anchors',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('Alle (all)', 'all'),
                    array('Gecacht (cached)', 'cached'),
                    array('Ausgabe (output)', 'output'),
                ),
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'required'
            ),
        ),
        'speaking_paths' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateconfig.speaking_paths',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('Keine', 'none'),
                    array('Simulate Static (Extension simulatestatic erforderlich)', 'simulatestatic'),
                    array('RealURL (Extension RealURL ab Version 1.12.6 erforderlich)', 'realurl'),
                ),
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'required'
            ),
        ),
        
        'google_analytics_tracking_code' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateconfig.google_analytics_tracking_code',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        
    ),
);

?>