CREATE TABLE tx_l10nserver_domain_model_project (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(30) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l18n_parent int(11) DEFAULT '0' NOT NULL,
	l18n_diffsource mediumblob NOT NULL,
	
	name tinytext,
	description tinytext,
	version tinytext,

	labels int(11) unsigned DEFAULT '0'

	PRIMARY KEY (uid),
	KEY parent (pid),
);

CREATE TABLE tx_l10nserver_domain_model_label (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(30) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l18n_parent int(11) DEFAULT '0' NOT NULL,
	l18n_diffsource mediumblob NOT NULL,
	
	name tinytext,
	englishtext tinytext,
	filepath tinytext,
	
	suggestions int(11) unsigned DEFAULT '0'
	
	project_uid int(11) unsigned DEFAULT '0'

	PRIMARY KEY (uid),
	KEY parent (pid),
);

CREATE TABLE tx_l10nserver_domain_model_suggestion (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(30) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l18n_parent int(11) DEFAULT '0' NOT NULL,
	l18n_diffsource mediumblob NOT NULL,
	
	translation tinytext,
	translator int(11) unsigned DEFAULT '0'
	language int(11) unsigned DEFAULT '0'
    
    #   Is suggestion approved
	approved tinyint(1) unsigned DEFAULT '0' NOT NULL,
    #   Chief translator that approved suggestion
	ctranslator int(11) unsigned DEFAULT '0'
    #   When it was approved
	approvaldate int(11) unsigned DEFAULT '0',
	
	label_uid int(11) unsigned DEFAULT '0'

	PRIMARY KEY (uid),
	KEY parent (pid),
);

#CREATE TABLE tx_l10nserver_translator_language_mm (
#	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
#	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
#	tablenames varchar(255) DEFAULT '' NOT NULL,
#	sorting int(11) unsigned DEFAULT '0' NOT NULL,
#	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,
#
#	KEY uid_local (uid_local),
#	KEY uid_foreign (uid_foreign)
#);
