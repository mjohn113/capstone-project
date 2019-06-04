DROP TABLE IF EXISTS tblNotifications;

CREATE TABLE tblNotifications (
	type varchar(255),
	description varchar(255),
	PRIMARY KEY (type)
);