DROP TABLE IF EXISTS tblClassRequiresBook;

CREATE TABLE tblClassRequiresBook (
	classCRN varchar(255) NOT NULL,
	bookISBN varchar(255) NOT NULL,
	isRequired boolean,
	PRIMARY KEY(classCRN, bookISBN),
	FOREIGN KEY(classCRN) REFERENCES tblClasses(crn),
	FOREIGN KEY(bookISBN) REFERENCES tblBooks(isbn)
);