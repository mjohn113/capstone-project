DROP TABLE IF EXISTS tblUserSellBook;

CREATE TABLE tblUserSellBook (
	id integer NOT NULL AUTO_INCREMENT,
	email varchar(255) NOT NULL,
	bookISBN varchar(255) NOT NULL,
	shortDescription varchar(255),
	longDescription varchar(2550),
	bookCondition varchar(255),
	price double NOT NULL,
	postDate datetime,
	PRIMARY KEY(id),
	FOREIGN KEY(email) REFERENCES tblUsers(email) ON UPDATE CASCADE,
	FOREIGN KEY(bookISBN) REFERENCES tblBooks(isbn)
);