#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
    tx_ftm_grid_elements_col_pos_bootstrap_1 varchar(255) DEFAULT '' NOT NULL,
    tx_ftm_grid_elements_col_pos_bootstrap_2 varchar(255) DEFAULT '' NOT NULL,
    tx_ftm_grid_elements_col_pos_bootstrap_3 varchar(255) DEFAULT '' NOT NULL,
    tx_ftm_grid_elements_col_pos_bootstrap_4 varchar(255) DEFAULT '' NOT NULL,
    tx_ftm_grid_elements_col_pos_bootstrap_5 varchar(255) DEFAULT '' NOT NULL,
    tx_ftm_grid_elements_col_pos_bootstrap_6 varchar(255) DEFAULT '' NOT NULL,
    tx_ftm_grid_elements_col_pos_bootstrap_7 varchar(255) DEFAULT '' NOT NULL,
    tx_ftm_grid_elements_col_pos_bootstrap_8 varchar(255) DEFAULT '' NOT NULL,
    tx_ftm_grid_elements_col_pos_bootstrap_9 varchar(255) DEFAULT '' NOT NULL,
    tx_ftm_grid_elements_col_pos_bootstrap_10 varchar(255) DEFAULT '' NOT NULL,
    tx_ftm_grid_elements_col_pos_bootstrap_11 varchar(255) DEFAULT '' NOT NULL,
    tx_ftm_grid_elements_col_pos_bootstrap_12 varchar(255) DEFAULT '' NOT NULL,
);

#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_address (
    tx_ftm_map_latitude varchar(255) DEFAULT '' NOT NULL,
    tx_ftm_map_longitude varchar(255) DEFAULT '' NOT NULL,
    tx_ftm_map_zoom int(11) DEFAULT '0' NOT NULL,
    tx_ftm_map_tooltip varchar(255) DEFAULT '' NOT NULL,
    tx_ftm_map_link varchar(255) DEFAULT '' NOT NULL,
    tx_ftm_directions text NOT NULL,
);

#
# Table structure for table 'fe_users'
#
CREATE TABLE fe_users (
    tx_ftm_action_hash varchar(255) DEFAULT '' NOT NULL,
);

#
# Table structure for table 'tx_ftm_domain_model_template'
#
CREATE TABLE tx_ftm_domain_model_template (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    site_name varchar(255) DEFAULT '' NOT NULL,
    template_dir varchar(255) DEFAULT '' NOT NULL,
    template_type varchar(255) DEFAULT '' NOT NULL,
    template_mode varchar(255) DEFAULT 'development' NOT NULL,
    md5_hash_setup_ts varchar(255) DEFAULT '' NOT NULL,
    md5_hash_constants_ts varchar(255) DEFAULT '' NOT NULL,
    md5_hash_ts_config varchar(255) DEFAULT '' NOT NULL,
    md5_hash_template_data varchar(255) DEFAULT '' NOT NULL,

    disclaimer_accepted tinyint(4) unsigned DEFAULT '0' NOT NULL,

    config int(11) unsigned DEFAULT '0',
    meta int(11) unsigned DEFAULT '0',
    language int(11) unsigned DEFAULT '0' NOT NULL,
    fluid int(11) unsigned DEFAULT '0' NOT NULL,
    less_variable int(11) unsigned DEFAULT '0' NOT NULL,
    dyncss_file int(11) unsigned DEFAULT '0' NOT NULL,
    menu_container int(11) unsigned DEFAULT '0' NOT NULL,
    typo_script_snippet int(11) unsigned DEFAULT '0' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,

    t3ver_oid int(11) DEFAULT '0' NOT NULL,
    t3ver_id int(11) DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) DEFAULT '0' NOT NULL,

    t3_origuid int(11) DEFAULT '0' NOT NULL,
    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_ftm_domain_model_templateconfig'
#
CREATE TABLE tx_ftm_domain_model_templateconfig (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    doctype varchar(255) DEFAULT '' NOT NULL,
    use_html5_js tinyint(4) unsigned DEFAULT '0' NOT NULL,

    base_u_r_l varchar(255) DEFAULT '' NOT NULL,
    link_vars varchar(255) DEFAULT '' NOT NULL,
    disable_charset_header varchar(255) DEFAULT '' NOT NULL,
    dyncss varchar(255) DEFAULT '' NOT NULL,
    meta_charset varchar(255) DEFAULT '' NOT NULL,
    language_uid int(11) DEFAULT '0' NOT NULL,
    language varchar(255) DEFAULT '' NOT NULL,
    language_title varchar(255) DEFAULT '' NOT NULL,
    locale_all varchar(255) DEFAULT '' NOT NULL,
    spam_protect_email_addresses tinyint(4) unsigned DEFAULT '1' NOT NULL,
    spam_protect_email_addresses_at_subst varchar(255) DEFAULT '(at)' NOT NULL,
    spam_protect_email_addresses_last_dot_subst varchar(255) DEFAULT '(dot)' NOT NULL,
    google_analytics_tracking_code varchar(255) DEFAULT '' NOT NULL,

    prefix_local_anchors varchar(255) DEFAULT 'all' NOT NULL,
    speaking_paths varchar(255) DEFAULT 'none' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,

    t3ver_oid int(11) DEFAULT '0' NOT NULL,
    t3ver_id int(11) DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) DEFAULT '0' NOT NULL,

    t3_origuid int(11) DEFAULT '0' NOT NULL,
    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_ftm_domain_model_templatemeta'
#
CREATE TABLE tx_ftm_domain_model_templatemeta (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    abstract varchar(255) DEFAULT '' NOT NULL,
    keywords varchar(255) DEFAULT '' NOT NULL,
    description varchar(255) DEFAULT '' NOT NULL,
    author varchar(255) DEFAULT '' NOT NULL,
    author_email varchar(255) DEFAULT '' NOT NULL,
    
    copyright varchar(255) DEFAULT '' NOT NULL,
    robots varchar(255) DEFAULT 'index,follow' NOT NULL,
    revisit varchar(255) DEFAULT '7 days' NOT NULL,
    useCanonical tinyint(4) unsigned DEFAULT '1' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,

    t3ver_oid int(11) DEFAULT '0' NOT NULL,
    t3ver_id int(11) DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) DEFAULT '0' NOT NULL,

    t3_origuid int(11) DEFAULT '0' NOT NULL,
    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_ftm_domain_model_templatelanguage'
#
CREATE TABLE tx_ftm_domain_model_templatelanguage (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    template int(11) unsigned DEFAULT '0' NOT NULL,

    language_uid int(11) DEFAULT '0' NOT NULL,
    title varchar(255) DEFAULT '' NOT NULL,
    language varchar(255) DEFAULT '' NOT NULL,
    locale_all varchar(255) DEFAULT '' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,

    t3ver_oid int(11) DEFAULT '0' NOT NULL,
    t3ver_id int(11) DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) DEFAULT '0' NOT NULL,

    t3_origuid int(11) DEFAULT '0' NOT NULL,
    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)

);



#
# Table structure for table 'tx_ftm_domain_model_templatefluid'
#
CREATE TABLE tx_ftm_domain_model_templatefluid (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    template int(11) unsigned DEFAULT '0' NOT NULL,

    template_title varchar(255) DEFAULT '' NOT NULL,
    template_type varchar(255) DEFAULT '' NOT NULL,
    template_code text NOT NULL,
    template_file varchar(255) DEFAULT '' NOT NULL,
    backend_layout int(11) unsigned DEFAULT '0' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,

    t3ver_oid int(11) DEFAULT '0' NOT NULL,
    t3ver_id int(11) DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) DEFAULT '0' NOT NULL,

    t3_origuid int(11) DEFAULT '0' NOT NULL,
    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_ftm_domain_model_templatemenucontainer'
#
CREATE TABLE tx_ftm_domain_model_templatemenucontainer (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    template int(11) unsigned DEFAULT '0' NOT NULL,

    menu_name varchar(255) DEFAULT '' NOT NULL,
    special varchar(255) DEFAULT '' NOT NULL,
    entry_level varchar(255) DEFAULT '' NOT NULL,
    special_value_list text NOT NULL,
    exclude_uid_list text NOT NULL,
    include_not_in_menu tinyint(4) unsigned DEFAULT '0' NOT NULL,
    max_items int(11) unsigned DEFAULT '0' NOT NULL,
    min_items int(11) unsigned DEFAULT '0' NOT NULL,
    std_wrap text NOT NULL,
    wrap text NOT NULL,

    menu_objects int(11) unsigned DEFAULT '0' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,

    t3ver_oid int(11) DEFAULT '0' NOT NULL,
    t3ver_id int(11) DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) DEFAULT '0' NOT NULL,

    t3_origuid int(11) DEFAULT '0' NOT NULL,
    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_ftm_domain_model_templatemenuobject'
#
CREATE TABLE tx_ftm_domain_model_templatemenuobject (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    menu_type varchar(255) DEFAULT '' NOT NULL,
    exp_all tinyint(4) unsigned DEFAULT '0' NOT NULL,
    std_wrap varchar(255) DEFAULT '' NOT NULL,
    std_wrap_html_special_chars tinyint(4) unsigned DEFAULT '0' NOT NULL,
    wrap varchar(255) DEFAULT '' NOT NULL,
    wrap_html_special_chars tinyint(4) unsigned DEFAULT '0' NOT NULL,

    template_menu_container int(11) unsigned DEFAULT '0' NOT NULL,

    menu_states int(11) unsigned DEFAULT '0' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,

    t3ver_oid int(11) DEFAULT '0' NOT NULL,
    t3ver_id int(11) DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) DEFAULT '0' NOT NULL,

    t3_origuid int(11) DEFAULT '0' NOT NULL,
    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_ftm_domain_model_templatemenustate'
#
CREATE TABLE tx_ftm_domain_model_templatemenustate (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    menu_state varchar(255) DEFAULT '' NOT NULL,
    copy_from_state varchar(255) DEFAULT '' NOT NULL,
    std_wrap varchar(255) DEFAULT '' NOT NULL,
    std_wrap_html_special_chars tinyint(4) unsigned DEFAULT '0' NOT NULL,
    wrap varchar(255) DEFAULT '' NOT NULL,
    wrap_html_special_chars tinyint(4) unsigned DEFAULT '0' NOT NULL,
    
    append_before varchar(255) DEFAULT '' NOT NULL,
    append_after varchar(255) DEFAULT '' NOT NULL,
    do_not_link_it tinyint(4) unsigned DEFAULT '0' NOT NULL,

    template_menu_object int(11) unsigned DEFAULT '0' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,

    t3ver_oid int(11) DEFAULT '0' NOT NULL,
    t3ver_id int(11) DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) DEFAULT '0' NOT NULL,

    t3_origuid int(11) DEFAULT '0' NOT NULL,
    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_ftm_domain_model_templatetyposcriptsnippet'
#
CREATE TABLE tx_ftm_domain_model_templatetyposcriptsnippet (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    template int(11) unsigned DEFAULT '0' NOT NULL,

    name varchar(255) DEFAULT '' NOT NULL,
    filename varchar(255) DEFAULT '' NOT NULL,
    type varchar(255) DEFAULT '' NOT NULL,
    description text NOT NULL,
    constants text NOT NULL,
    setup text NOT NULL,
    public_readable tinyint(4) unsigned DEFAULT '0' NOT NULL,
    public_writeable tinyint(4) unsigned DEFAULT '0' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,

    t3ver_oid int(11) DEFAULT '0' NOT NULL,
    t3ver_id int(11) DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) DEFAULT '0' NOT NULL,

    t3_origuid int(11) DEFAULT '0' NOT NULL,
    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_ftm_domain_model_templatetyposcriptsnippet_mm'
#
CREATE TABLE tx_ftm_domain_model_templatetyposcriptsnippet_mm (
    uid_local int(11) unsigned DEFAULT '0' NOT NULL,
    uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) unsigned DEFAULT '0' NOT NULL,
    sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

    KEY uid_local (uid_local),
    KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_ftm_domain_model_templatedyncssfile'
#
CREATE TABLE tx_ftm_domain_model_templatedyncssfile (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    template int(11) unsigned DEFAULT '0' NOT NULL,

    name varchar(255) DEFAULT '' NOT NULL,
    filename varchar(255) DEFAULT '' NOT NULL,
    type varchar(255) DEFAULT '' NOT NULL,
    description text NOT NULL,
    variables text NOT NULL,
    dyncss text NOT NULL,
    public_readable tinyint(4) unsigned DEFAULT '0' NOT NULL,
    public_writeable tinyint(4) unsigned DEFAULT '0' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,

    t3ver_oid int(11) DEFAULT '0' NOT NULL,
    t3ver_id int(11) DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) DEFAULT '0' NOT NULL,

    t3_origuid int(11) DEFAULT '0' NOT NULL,
    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_ftm_domain_model_templatedyncssfile_mm'
#
CREATE TABLE tx_ftm_domain_model_templatedyncssfile_mm (
    uid_local int(11) unsigned DEFAULT '0' NOT NULL,
    uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) unsigned DEFAULT '0' NOT NULL,
    sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

    KEY uid_local (uid_local),
    KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_codingmsbase_domain_model_log'
#
CREATE TABLE tx_ftm_domain_model_log (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    frontend_user int(11) DEFAULT '0' NOT NULL,
    category varchar(255) DEFAULT '' NOT NULL,
    remote_address varchar(255) DEFAULT '' NOT NULL,
    text text NOT NULL,
    action varchar(255) DEFAULT '' NOT NULL,
    extension_name varchar(255) DEFAULT '' NOT NULL,
    request_arguments text NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,

    t3ver_oid int(11) DEFAULT '0' NOT NULL,
    t3ver_id int(11) DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) DEFAULT '0' NOT NULL,

    t3_origuid int(11) DEFAULT '0' NOT NULL,
    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)

);

