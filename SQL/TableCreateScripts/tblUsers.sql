DROP TABLE IF EXISTS tblUsers;

CREATE TABLE tblUsers (
	email varchar(255) NOT NULL,
	password varchar(255) NOT NULL,
	name varchar(255) NOT NULL,
	id integer NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (email),
	UNIQUE(id)
);