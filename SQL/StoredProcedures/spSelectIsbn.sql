DELIMITER $$
DROP PROCEDURE IF EXISTS spSelectIsbn$$

CREATE PROCEDURE spSelectIsbn
(
    IN isbn varchar(255)
)
BEGIN
    SELECT tblBooks.isbn
    FROM tblBooks
    WHERE tblBooks.isbn = isbn;
END$$
DELIMITER ;
