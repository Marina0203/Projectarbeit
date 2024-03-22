CREATE TABLE tx_szassets_domain_model_room
(
	uid       int(11) unsigned DEFAULT 0 NOT NULL auto_increment,
	pid       int(11) DEFAULT 0 NOT NULL,

	title     varchar(60) DEFAULT '' NOT NULL,
	seats     int(11) unsigned DEFAULT '0',
	css_class varchar(60) DEFAULT '' NOT NULL,

	tstamp    int(11) unsigned DEFAULT 0 NOT NULL,
	crdate    int(11) unsigned DEFAULT 0 NOT NULL,
	deleted   tinyint(4) unsigned DEFAULT 0 NOT NULL,
	hidden    tinyint(4) unsigned DEFAULT 0 NOT NULL,

	PRIMARY KEY (uid),
	KEY       parent (pid),
);

CREATE TABLE tx_szassets_domain_model_seat
(
	uid         int(11) unsigned DEFAULT 0 NOT NULL auto_increment,
	pid         int(11) DEFAULT 0 NOT NULL,

	parentid    int(11) DEFAULT '0' NOT NULL,
	parenttable varchar(255) DEFAULT '' NOT NULL,

	tstamp      int(11) unsigned DEFAULT 0 NOT NULL,
	crdate      int(11) unsigned DEFAULT 0 NOT NULL,
	deleted     tinyint(4) unsigned DEFAULT 0 NOT NULL,
	hidden      tinyint(4) unsigned DEFAULT 0 NOT NULL,

	PRIMARY KEY (uid),
	KEY         parent (pid),
);

CREATE TABLE tx_szassets_domain_model_booking
(
	uid             int(11) unsigned DEFAULT 0 NOT NULL auto_increment,
	pid             int(11) DEFAULT 0 NOT NULL,

	room            int(11) unsigned DEFAULT '0',
	seat            int(11) unsigned DEFAULT '0',
	user_first_name varchar(60) DEFAULT '' NOT NULL,
	user_last_name  varchar(60) DEFAULT '' NOT NULL,
	user_email      varchar(60) DEFAULT '' NOT NULL,
	start_date      int(11) unsigned DEFAULT 0 NOT NULL,

	tstamp          int(11) unsigned DEFAULT 0 NOT NULL,
	crdate          int(11) unsigned DEFAULT 0 NOT NULL,
	deleted         tinyint(4) unsigned DEFAULT 0 NOT NULL,
	hidden          tinyint(4) unsigned DEFAULT 0 NOT NULL,

	PRIMARY KEY (uid),
	KEY             parent (pid),
);
