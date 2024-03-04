CREATE TABLE tx_szassets_domain_model_room
(
	uid        int(11) unsigned DEFAULT 0 NOT NULL auto_increment,
	pid        int(11) DEFAULT 0 NOT NULL,

	title      varchar(60) NOT NULL,
	seat_count int(11) DEFAULT '0' NOT NULL,

	tstamp     int(11) unsigned DEFAULT 0 NOT NULL,
	crdate     int(11) unsigned DEFAULT 0 NOT NULL,
	deleted    tinyint(4) unsigned DEFAULT 0 NOT NULL,
	hidden     tinyint(4) unsigned DEFAULT 0 NOT NULL,

	PRIMARY KEY (uid),
	KEY        parent (pid),
);

CREATE TABLE tx_szassets_domain_model_room
(
	uid             int(11) unsigned DEFAULT 0 NOT NULL auto_increment,
	pid             int(11) DEFAULT 0 NOT NULL,

	room            int(11) unsigned DEFAULT '0',
	user_first_name varchar(60) NOT NULL,
	user_last_name  varchar(60) NOT NULL,
	user_email      varchar(60) NOT NULL,
	end_date        int(11) unsigned DEFAULT 0 NOT NULL,

	tstamp          int(11) unsigned DEFAULT 0 NOT NULL,
	crdate          int(11) unsigned DEFAULT 0 NOT NULL,
	deleted         tinyint(4) unsigned DEFAULT 0 NOT NULL,
	hidden          tinyint(4) unsigned DEFAULT 0 NOT NULL,

	PRIMARY KEY (uid),
	KEY             parent (pid),
);
