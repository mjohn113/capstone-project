DELIMITER $$
DROP PROCEDURE IF EXISTS spSelectClassRequiresBook$$

CREATE PROCEDURE spSelectClassRequiresBook
(
    IN classCRN varchar(255)
)
BEGIN
    SELECT tblBooks.isbn,
        tblBooks.title,
        tblBooks.author,
        tblBooks.edition,
        tblBooks.publisher,
        tblBooks.photoName,
        tblClassesRequiresBook.isRequired
    FROM tblClassesRequiresBook
    LEFT OUTER JOIN tblBooks ON tblBooks.isbn = tblClassesRequiresBook.bookISBN
    WHERE tblClassesRequiresBook.classCRN = classCRN;
END$$
DELIMITER ;