<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}


/**
 * Registers a Backend Module
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
    'CodingMs.'.$_EXTKEY,
    'web',    // Make module a submodule of 'web'
    'ftm',    // Submodule key
    '999',    // Position
    array(
        'TemplateManager' => 'list,createTemplate,generateTypoScript,generateLessVariable,generateFluid,acceptDisclaimer,saveMarker,insertMarker,loadSnippets',
    ),
    array(
        'access' => 'user,group',
        'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
        'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_ftm.xml',
    )
);



// Version des FTM
// Diese muss vor dem TER-Upload bereits
// auf der geplanten Version stehen 
if(!defined('FTM_VERSION')) {
    define('FTM_VERSION', '1.1.0');
}
// Benoetigte Extensions
if(!defined('FTM_REQUIRED_EXTENSIONS')) {
    define('FTM_REQUIRED_EXTENSIONS', 't3_less;gridelements;t3editor;static_info_tables');
}






// Include flex forms
$pluginName='Ftm'; // siehe \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin
$extName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extName) . '_'.strtolower($pluginName);
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY.'/Configuration/FlexForms/ExtConf.xml');


// Include Static
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'FTM - Fluid Template Manager');



/**
 * FTM-Template
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ftm_domain_model_template', 'EXT:ftm/Resources/Private/Language/locallang_csh_tx_ftm_domain_model_template.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ftm_domain_model_template');
$TCA['tx_ftm_domain_model_template'] = array(
    'ctrl' => array(
        'title'    => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_template',
        'label' => 'template_dir',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'template_dir,config,meta,language,fluid,less_variable,menu_container',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Template.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ftm_domain_model_template.gif'
    ),
);

/**
 * Basis-Konfiguration
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ftm_domain_model_templateconfig', 'EXT:ftm/Resources/Private/Language/locallang_csh_tx_ftm_domain_model_templateconfig.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ftm_domain_model_templateconfig');
$TCA['tx_ftm_domain_model_templateconfig'] = array(
    'ctrl' => array(
        'title'    => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateconfig',
        'label' => 'doctype',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'doctype,disable_charset_header,meta_charset,spam_protect_email_addresses,',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/TemplateConfig.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ftm_domain_model_templateconfig.gif'
    ),
);

/**
 * Meta-Tags
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ftm_domain_model_templatemeta', 'EXT:ftm/Resources/Private/Language/locallang_csh_tx_ftm_domain_model_templatemeta.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ftm_domain_model_templatemeta');
$TCA['tx_ftm_domain_model_templatemeta'] = array(
    'ctrl' => array(
        'title'    => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemeta',
        'label' => 'author',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'author,copyright,robots,',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/TemplateMeta.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ftm_domain_model_templatemeta.gif'
    ),
);

/**
 * Website-Languages
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ftm_domain_model_templatelanguage', 'EXT:ftm/Resources/Private/Language/locallang_csh_tx_ftm_domain_model_templatelanguage.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ftm_domain_model_templatelanguage');
$TCA['tx_ftm_domain_model_templatelanguage'] = array(
    'ctrl' => array(
        'title'    => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatelanguage',
        
        'label' => 'language_uid',
        'label_alt' => 'language',
        'label_alt_force' => true,
        
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'language_uid,language,locale_all,',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/TemplateLanguage.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ftm_domain_model_templatelanguage.gif'
    ),
);

/**
 * Fluid Templates
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ftm_domain_model_templatefluid', 'EXT:ftm/Resources/Private/Language/locallang_csh_tx_ftm_domain_model_templatefluid.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ftm_domain_model_templatefluid');
$TCA['tx_ftm_domain_model_templatefluid'] = array(
    'ctrl' => array(
        'title'    => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatefluid',
        'label' => 'template_title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
        'dividers2tabs' => TRUE,

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'template_title,template_type,template_file,template_code,',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/TemplateFluid.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ftm_domain_model_templatefluid.gif'
    ),
);

/**
 * Less - Variablen
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ftm_domain_model_templatelessvariable', 'EXT:ftm/Resources/Private/Language/locallang_csh_tx_ftm_domain_model_templatelessvariable.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ftm_domain_model_templatelessvariable');
$TCA['tx_ftm_domain_model_templatelessvariable'] = array(
    'ctrl' => array(
        'title'    => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatelessvariable',
        
        'label' => 'variable_name',
        'label_alt' => 'variable_title',
        'label_alt_force' => true,
        
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
        'dividers2tabs' => TRUE,

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'variable_name,variable_type,variable_value,',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/TemplateLessVariable.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ftm_domain_model_templatelessvariable.gif'
    ),
);

/**
 * Menu - Container
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ftm_domain_model_templatemenucontainer', 'EXT:ftm/Resources/Private/Language/locallang_csh_tx_ftm_domain_model_templatemenucontainer.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ftm_domain_model_templatemenucontainer');
$TCA['tx_ftm_domain_model_templatemenucontainer'] = array(
    'ctrl' => array(
        'title' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenucontainer',
        'label' => 'menu_name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'menu_name,',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/TemplateMenuContainer.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ftm_domain_model_templatemenucontainer.gif'
    ),
);

/**
 * Menu - Objekte
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ftm_domain_model_templatemenuobject', 'EXT:ftm/Resources/Private/Language/locallang_csh_tx_ftm_domain_model_templatemenuobject.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ftm_domain_model_templatemenuobject');
$TCA['tx_ftm_domain_model_templatemenuobject'] = array(
    'ctrl' => array(
        'title' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenuobject',
        'label' => 'menu_type',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
        'dividers2tabs' => TRUE,

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'menu_type',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/TemplateMenuObject.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ftm_domain_model_templatemenuobject.gif'
    ),
);

/**
 * Menu - Zustaende
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ftm_domain_model_templatemenustate', 'EXT:ftm/Resources/Private/Language/locallang_csh_tx_ftm_domain_model_templatemenustate.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ftm_domain_model_templatemenustate');
$TCA['tx_ftm_domain_model_templatemenustate'] = array(
    'ctrl' => array(
        'title' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemenustate',
        'label' => 'menu_state',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
        'dividers2tabs' => TRUE,

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'menu_state',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/TemplateMenuState.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ftm_domain_model_templatemenustate.gif'
    ),
);

/**
 * Extension - Basis
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ftm_domain_model_templateext', 'EXT:ftm/Resources/Private/Language/locallang_csh_tx_ftm_domain_model_templateext.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ftm_domain_model_templateext');
$TCA['tx_ftm_domain_model_templateext'] = array(
    'ctrl' => array(
        'title' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateext',
        
        'label' => 'ext_key',
        'label_alt' => 'ext_name',
        'label_alt_force' => true,
        
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'ext_key,ext_name,ext_version,ext_conf_t3_less,',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/TemplateExt.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ftm_domain_model_templateext.gif'
    ),
);

/**
 * Extension: t3_less - Basis
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ftm_domain_model_templateextt3less', 'EXT:ftm/Resources/Private/Language/locallang_csh_tx_ftm_domain_model_templateextt3less.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ftm_domain_model_templateextt3less');
$TCA['tx_ftm_domain_model_templateextt3less'] = array(
    'ctrl' => array(
        'title' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateextt3less',
        'label' => 'path_to_less_files',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'path_to_less_files,output_folder,less_files,',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/TemplateExtT3Less.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ftm_domain_model_templateextt3less.gif'
    ),
);

/**
 * Extension: t3_less - Dateien
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ftm_domain_model_templateextt3lessfiles', 'EXT:ftm/Resources/Private/Language/locallang_csh_tx_ftm_domain_model_templateextt3lessfiles.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ftm_domain_model_templateextt3lessfiles');
$TCA['tx_ftm_domain_model_templateextt3lessfiles'] = array(
    'ctrl' => array(
        'title' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templateextt3lessfiles',
        
        'label' => 'name',
        'label_alt' => 'media',
        'label_alt_force' => true,
        
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,
        'sortby' => 'sorting',
        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'name,media,title,compress,force_on_top,all_wrap,exclude_from_concatenation,exclude_from_page_renderer,',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/TemplateExtT3LessFiles.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ftm_domain_model_templateextt3lessfiles.gif'
    ),
);

/**
 * Fluid Template-Marker
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ftm_domain_model_templatemarker', 'EXT:ftm/Resources/Private/Language/locallang_csh_tx_ftm_domain_model_templatemarker.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ftm_domain_model_templatemarker');
$TCA['tx_ftm_domain_model_templatemarker'] = array(
    'ctrl' => array(
        'title' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_db.xml:tx_ftm_domain_model_templatemarker',
        
        'label' => 'marker_name',
        'label_alt' => 'marker_type',
        'label_alt_force' => true,
        
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
        'dividers2tabs' => TRUE,

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'marker_name,marker_descriptiom,marker_typo_script,',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/TemplateMarker.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ftm_domain_model_templatemarker.gif'
    ),
);


// /**
 // * tt_content: Image-Hover-Effekte 
 // */
// $tmp_ftm_columns = array(
// 
    // 'ftm_image_hover_effect' => array(
        // 'displayCond' => 'FIELD:CType:=:image',
        // 'exclude' => 0,
        // 'label' => 'LLL:EXT:ftm/Resources/Private/Language/locallang_ftm.xml:ftm_image_hover_effect', 
        // 'config' => array (
            // 'type' => 'user',
            // 'userFunc' => 'CodingMs\Ftm\Backend\ImageHoverEffectRow->renderField'
        // )
    // )
// );
// 
// 
// // The handling of TCA was refactored, so that this global array is always loaded.
// // Thus calls to \TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA() are not needed anymore.
// // \TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA("tt_content"); 
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tmp_ftm_columns);
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes("tt_content","ftm_image_hover_effect",'','after:imageorient');






/**
 * tt_content: Image-Hover-Effekte 
 */
$tmp_ftm_columns = array(
    'tx_ftm_grid_elements_col_pos_bootstrap_header' => array(
        'displayCond' => array(
            'AND' => array(
                'FIELD:CType:=:gridelements_pi1',
                'OR' => array(
                    'FIELD:tx_gridelements_backend_layout:=:2001',
                    'FIELD:tx_gridelements_backend_layout:=:2002',
                    'FIELD:tx_gridelements_backend_layout:=:2003',
                    'FIELD:tx_gridelements_backend_layout:=:2004',
                    'FIELD:tx_gridelements_backend_layout:=:2005',
                    'FIELD:tx_gridelements_backend_layout:=:2006',
                    'FIELD:tx_gridelements_backend_layout:=:2007',
                    'FIELD:tx_gridelements_backend_layout:=:2008',
                    'FIELD:tx_gridelements_backend_layout:=:2009',
                    'FIELD:tx_gridelements_backend_layout:=:2010',
                    'FIELD:tx_gridelements_backend_layout:=:2011',
                    'FIELD:tx_gridelements_backend_layout:=:2012',
                ),
            ),
        ),
        'exclude' => 0,
        'config' => array (
            'type' => 'user',
            'userFunc' => 'CodingMs\Ftm\Backend\GridElementColPosBootstrapHeader->renderField'
        )
    ),
    'tx_ftm_grid_elements_col_pos_bootstrap_1' => array(
        'displayCond' => array(
            'AND' => array(
                'FIELD:CType:=:gridelements_pi1',
                'OR' => array(
                    'FIELD:tx_gridelements_backend_layout:=:2001',
                    'FIELD:tx_gridelements_backend_layout:=:2002',
                    'FIELD:tx_gridelements_backend_layout:=:2003',
                    'FIELD:tx_gridelements_backend_layout:=:2004',
                    'FIELD:tx_gridelements_backend_layout:=:2005',
                    'FIELD:tx_gridelements_backend_layout:=:2006',
                    'FIELD:tx_gridelements_backend_layout:=:2007',
                    'FIELD:tx_gridelements_backend_layout:=:2008',
                    'FIELD:tx_gridelements_backend_layout:=:2009',
                    'FIELD:tx_gridelements_backend_layout:=:2010',
                    'FIELD:tx_gridelements_backend_layout:=:2011',
                    'FIELD:tx_gridelements_backend_layout:=:2012',
                ),
            ),
        ),
        'exclude' => 0,
        'config' => array (
            'type' => 'user',
            'userFunc' => 'CodingMs\Ftm\Backend\GridElementColPosBootstrap->renderField'
        )
    ),
    'tx_ftm_grid_elements_col_pos_bootstrap_2' => array(
        'displayCond' => array(
            'AND' => array(
                'FIELD:CType:=:gridelements_pi1',
                'OR' => array(
                    'FIELD:tx_gridelements_backend_layout:=:2002',
                    'FIELD:tx_gridelements_backend_layout:=:2003',
                    'FIELD:tx_gridelements_backend_layout:=:2004',
                    'FIELD:tx_gridelements_backend_layout:=:2005',
                    'FIELD:tx_gridelements_backend_layout:=:2006',
                    'FIELD:tx_gridelements_backend_layout:=:2007',
                    'FIELD:tx_gridelements_backend_layout:=:2008',
                    'FIELD:tx_gridelements_backend_layout:=:2009',
                    'FIELD:tx_gridelements_backend_layout:=:2010',
                    'FIELD:tx_gridelements_backend_layout:=:2011',
                    'FIELD:tx_gridelements_backend_layout:=:2012',
                ),
            ),
        ),
        'exclude' => 0,
        'config' => array (
            'type' => 'user',
            'userFunc' => 'CodingMs\Ftm\Backend\GridElementColPosBootstrap->renderField'
        )
    ),
    'tx_ftm_grid_elements_col_pos_bootstrap_3' => array(
        'displayCond' => array(
            'AND' => array(
                'FIELD:CType:=:gridelements_pi1',
                'OR' => array(
                    'FIELD:tx_gridelements_backend_layout:=:2003',
                    'FIELD:tx_gridelements_backend_layout:=:2004',
                    'FIELD:tx_gridelements_backend_layout:=:2005',
                    'FIELD:tx_gridelements_backend_layout:=:2006',
                    'FIELD:tx_gridelements_backend_layout:=:2007',
                    'FIELD:tx_gridelements_backend_layout:=:2008',
                    'FIELD:tx_gridelements_backend_layout:=:2009',
                    'FIELD:tx_gridelements_backend_layout:=:2010',
                    'FIELD:tx_gridelements_backend_layout:=:2011',
                    'FIELD:tx_gridelements_backend_layout:=:2012',
                ),
            ),
        ),
        'exclude' => 0,
        'config' => array (
            'type' => 'user',
            'userFunc' => 'CodingMs\Ftm\Backend\GridElementColPosBootstrap->renderField'
        )
    ),
    'tx_ftm_grid_elements_col_pos_bootstrap_4' => array(
        'displayCond' => array(
            'AND' => array(
                'FIELD:CType:=:gridelements_pi1',
                'OR' => array(
                    'FIELD:tx_gridelements_backend_layout:=:2004',
                    'FIELD:tx_gridelements_backend_layout:=:2005',
                    'FIELD:tx_gridelements_backend_layout:=:2006',
                    'FIELD:tx_gridelements_backend_layout:=:2007',
                    'FIELD:tx_gridelements_backend_layout:=:2008',
                    'FIELD:tx_gridelements_backend_layout:=:2009',
                    'FIELD:tx_gridelements_backend_layout:=:2010',
                    'FIELD:tx_gridelements_backend_layout:=:2011',
                    'FIELD:tx_gridelements_backend_layout:=:2012',
                ),
            ),
        ),
        'exclude' => 0,
        'config' => array (
            'type' => 'user',
            'userFunc' => 'CodingMs\Ftm\Backend\GridElementColPosBootstrap->renderField'
        )
    ),
    'tx_ftm_grid_elements_col_pos_bootstrap_5' => array(
        'displayCond' => array(
            'AND' => array(
                'FIELD:CType:=:gridelements_pi1',
                'OR' => array(
                    'FIELD:tx_gridelements_backend_layout:=:2005',
                    'FIELD:tx_gridelements_backend_layout:=:2006',
                    'FIELD:tx_gridelements_backend_layout:=:2007',
                    'FIELD:tx_gridelements_backend_layout:=:2008',
                    'FIELD:tx_gridelements_backend_layout:=:2009',
                    'FIELD:tx_gridelements_backend_layout:=:2010',
                    'FIELD:tx_gridelements_backend_layout:=:2011',
                    'FIELD:tx_gridelements_backend_layout:=:2012',
                ),
            ),
        ),
        'exclude' => 0,
        'config' => array (
            'type' => 'user',
            'userFunc' => 'CodingMs\Ftm\Backend\GridElementColPosBootstrap->renderField'
        )
    ),
    'tx_ftm_grid_elements_col_pos_bootstrap_6' => array(
        'displayCond' => array(
            'AND' => array(
                'FIELD:CType:=:gridelements_pi1',
                'OR' => array(
                    'FIELD:tx_gridelements_backend_layout:=:2006',
                    'FIELD:tx_gridelements_backend_layout:=:2007',
                    'FIELD:tx_gridelements_backend_layout:=:2008',
                    'FIELD:tx_gridelements_backend_layout:=:2009',
                    'FIELD:tx_gridelements_backend_layout:=:2010',
                    'FIELD:tx_gridelements_backend_layout:=:2011',
                    'FIELD:tx_gridelements_backend_layout:=:2012',
                ),
            ),
        ),
        'exclude' => 0,
        'config' => array (
            'type' => 'user',
            'userFunc' => 'CodingMs\Ftm\Backend\GridElementColPosBootstrap->renderField'
        )
    ),
    'tx_ftm_grid_elements_col_pos_bootstrap_7' => array(
        'displayCond' => array(
            'AND' => array(
                'FIELD:CType:=:gridelements_pi1',
                'OR' => array(
                    'FIELD:tx_gridelements_backend_layout:=:2007',
                    'FIELD:tx_gridelements_backend_layout:=:2008',
                    'FIELD:tx_gridelements_backend_layout:=:2009',
                    'FIELD:tx_gridelements_backend_layout:=:2010',
                    'FIELD:tx_gridelements_backend_layout:=:2011',
                    'FIELD:tx_gridelements_backend_layout:=:2012',
                ),
            ),
        ),
        'exclude' => 0,
        'config' => array (
            'type' => 'user',
            'userFunc' => 'CodingMs\Ftm\Backend\GridElementColPosBootstrap->renderField'
        )
    ),
    'tx_ftm_grid_elements_col_pos_bootstrap_8' => array(
        'displayCond' => array(
            'AND' => array(
                'FIELD:CType:=:gridelements_pi1',
                'OR' => array(
                    'FIELD:tx_gridelements_backend_layout:=:2008',
                    'FIELD:tx_gridelements_backend_layout:=:2009',
                    'FIELD:tx_gridelements_backend_layout:=:2010',
                    'FIELD:tx_gridelements_backend_layout:=:2011',
                    'FIELD:tx_gridelements_backend_layout:=:2012',
                ),
            ),
        ),
        'exclude' => 0,
        'config' => array (
            'type' => 'user',
            'userFunc' => 'CodingMs\Ftm\Backend\GridElementColPosBootstrap->renderField'
        )
    ),
    'tx_ftm_grid_elements_col_pos_bootstrap_9' => array(
        'displayCond' => array(
            'AND' => array(
                'FIELD:CType:=:gridelements_pi1',
                'OR' => array(
                    'FIELD:tx_gridelements_backend_layout:=:2009',
                    'FIELD:tx_gridelements_backend_layout:=:2010',
                    'FIELD:tx_gridelements_backend_layout:=:2011',
                    'FIELD:tx_gridelements_backend_layout:=:2012',
                ),
            ),
        ),
        'exclude' => 0,
        'config' => array (
            'type' => 'user',
            'userFunc' => 'CodingMs\Ftm\Backend\GridElementColPosBootstrap->renderField'
        )
    ),
    'tx_ftm_grid_elements_col_pos_bootstrap_10' => array(
        'displayCond' => array(
            'AND' => array(
                'FIELD:CType:=:gridelements_pi1',
                'OR' => array(
                    'FIELD:tx_gridelements_backend_layout:=:2010',
                    'FIELD:tx_gridelements_backend_layout:=:2011',
                    'FIELD:tx_gridelements_backend_layout:=:2012',
                ),
            ),
        ),
        'exclude' => 0,
        'config' => array (
            'type' => 'user',
            'userFunc' => 'CodingMs\Ftm\Backend\GridElementColPosBootstrap->renderField'
        )
    ),
    'tx_ftm_grid_elements_col_pos_bootstrap_11' => array(
        'displayCond' => array(
            'AND' => array(
                'FIELD:CType:=:gridelements_pi1',
                'OR' => array(
                    'FIELD:tx_gridelements_backend_layout:=:2011',
                    'FIELD:tx_gridelements_backend_layout:=:2012',
                ),
            ),
        ),
        'exclude' => 0,
        'config' => array (
            'type' => 'user',
            'userFunc' => 'CodingMs\Ftm\Backend\GridElementColPosBootstrap->renderField'
        )
    ),
    'tx_ftm_grid_elements_col_pos_bootstrap_12' => array(
        'displayCond' => array(
            'AND' => array(
                'FIELD:CType:=:gridelements_pi1',
                'OR' => array(
                    'FIELD:tx_gridelements_backend_layout:=:2012',
                ),
            ),
        ),
        'exclude' => 0,
        'config' => array (
            'type' => 'user',
            'userFunc' => 'CodingMs\Ftm\Backend\GridElementColPosBootstrap->renderField'
        )
    ),
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tmp_ftm_columns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes("tt_content", "tx_ftm_grid_elements_col_pos_bootstrap_header",'','after:section_frame');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes("tt_content", "tx_ftm_grid_elements_col_pos_bootstrap_1",'','after:tx_ftm_grid_elements_col_pos_bootstrap_header');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes("tt_content", "tx_ftm_grid_elements_col_pos_bootstrap_2",'','after:tx_ftm_grid_elements_col_pos_bootstrap_1');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes("tt_content", "tx_ftm_grid_elements_col_pos_bootstrap_3",'','after:tx_ftm_grid_elements_col_pos_bootstrap_2');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes("tt_content", "tx_ftm_grid_elements_col_pos_bootstrap_4",'','after:tx_ftm_grid_elements_col_pos_bootstrap_3');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes("tt_content", "tx_ftm_grid_elements_col_pos_bootstrap_5",'','after:tx_ftm_grid_elements_col_pos_bootstrap_4');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes("tt_content", "tx_ftm_grid_elements_col_pos_bootstrap_6",'','after:tx_ftm_grid_elements_col_pos_bootstrap_5');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes("tt_content", "tx_ftm_grid_elements_col_pos_bootstrap_7",'','after:tx_ftm_grid_elements_col_pos_bootstrap_6');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes("tt_content", "tx_ftm_grid_elements_col_pos_bootstrap_8",'','after:tx_ftm_grid_elements_col_pos_bootstrap_7');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes("tt_content", "tx_ftm_grid_elements_col_pos_bootstrap_9",'','after:tx_ftm_grid_elements_col_pos_bootstrap_8');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes("tt_content", "tx_ftm_grid_elements_col_pos_bootstrap_10",'','after:tx_ftm_grid_elements_col_pos_bootstrap_9');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes("tt_content", "tx_ftm_grid_elements_col_pos_bootstrap_11",'','after:tx_ftm_grid_elements_col_pos_bootstrap_10');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes("tt_content", "tx_ftm_grid_elements_col_pos_bootstrap_12",'','after:tx_ftm_grid_elements_col_pos_bootstrap_11');
// Nach dem Layout-Wechsel einen Reload erzwingen
$TCA['tt_content']['ctrl']['requestUpdate'] = $TCA['tt_content']['ctrl']['requestUpdate'].',tx_gridelements_backend_layout';




// make static files field bigger
$TCA['sys_template']['columns']['include_static_file']['config']['size'] = 30;
$TCA['sys_template']['columns']['include_static_file']['config']['maxitems'] = 999;

// we need more than 20 tables to be edited by the backend users...
$TCA['be_groups']['columns']['tables_modify']['config']['maxitems'] = 99;
$TCA['be_groups']['columns']['tables_select']['config']['maxitems'] = 99;


?>