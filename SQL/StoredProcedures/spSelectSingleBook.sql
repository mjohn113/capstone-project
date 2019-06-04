DELIMITER $$
DROP PROCEDURE IF EXISTS spSelectSingleBook$$

CREATE PROCEDURE spSelectSingleBook
(
    IN isbn varchar(255)
)
BEGIN

    SELECT tblBooks.isbn,
        tblBooks.title,
        tblBooks.author,
        tblBooks.edition,
        tblBooks.publisher,
        tblBooks.photoName
    FROM tblBooks
    WHERE tblBooks.isbn = isbn;
END$$
DELIMITER ;