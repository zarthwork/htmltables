CREATE TABLE tt_content (
		htmltables_row int(11) DEFAULT '0' NOT NULL,
		table_summary varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_htmltables_table_row(
		title varchar(30) DEFAULT '' NOT NULL,
		htmltables_col int(11) DEFAULT '0' NOT NULL,
		parentid int(11) DEFAULT '0' NOT NULL,
		parenttable varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_htmltables_table_cell(
		title varchar(30) DEFAULT '' NOT NULL,
		parentid int(11) DEFAULT '0' NOT NULL,
		parenttable varchar(255) DEFAULT '' NOT NULL,
		bodytext mediumtext,
		records text,
		headercell tinyint(3) DEFAULT '0' NOT NULL,
		scope varchar(10) DEFAULT '' NOT NULL,
		abbr varchar(30) DEFAULT '' NOT NULL,
		class varchar(30) DEFAULT '' NOT NULL,
		headers varchar(10) DEFAULT '' NOT NULL,
		id varchar(10) DEFAULT '' NOT NULL,
		rowspan int(11) unsigned DEFAULT '0' NOT NULL,
		colspan int(11) unsigned DEFAULT '0' NOT NULL
);
