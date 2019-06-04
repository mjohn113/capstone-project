DROP TABLE IF EXISTS tblBooks;

CREATE TABLE tblBooks (
	isbn varchar(255) NOT NULL,
	title varchar(255) NOT NULL,
	author varchar(255),
	edition varchar(255),
	publisher varchar(255),
	photoName varchar(255),
	PRIMARY KEY (isbn)
);