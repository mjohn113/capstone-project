DROP TABLE IF EXISTS tblUserSellBookPhoto;

CREATE TABLE tblUserSellBookPhoto (
	id integer NOT NULL,
	photoName varchar(255) NOT NULL,
	PRIMARY KEY(id, photoName),
	FOREIGN KEY(id) REFERENCES tblUserSellBook(id)
);