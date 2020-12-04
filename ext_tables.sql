#
# Table structure for table 'tx_socialservices_domain_model_helpdesk'
#
CREATE TABLE tx_socialservices_domain_model_helpdesk (
	title varchar(255) DEFAULT '' NOT NULL,
	path_segment varchar(2048) DEFAULT '' NOT NULL,
	street varchar(255) DEFAULT '' NOT NULL,
	house_number varchar(255) DEFAULT '' NOT NULL,
	zip varchar(255) DEFAULT '' NOT NULL,
	city varchar(255) DEFAULT '' NOT NULL,
	telephone varchar(255) DEFAULT '' NOT NULL,
	fax varchar(255) DEFAULT '' NOT NULL,
	contact_person varchar(255) DEFAULT '' NOT NULL,
	contact_times text NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	website varchar(255) DEFAULT '' NOT NULL,
	barrier_free tinyint(1) unsigned DEFAULT '0' NOT NULL,
	description text NOT NULL,
	facebook varchar(255) DEFAULT '' NOT NULL,
	twitter varchar(255) DEFAULT '' NOT NULL,
	instagram varchar(255) DEFAULT '' NOT NULL,
	tags varchar(255) DEFAULT '' NOT NULL,
	district int(11) unsigned DEFAULT '0'
);

#
# Table structure for table 'tx_socialservices_domain_model_district'
#
CREATE TABLE tx_socialservices_domain_model_district (
	district varchar(255) DEFAULT '' NOT NULL
);
