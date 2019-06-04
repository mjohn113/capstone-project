DELIMITER $$
DROP PROCEDURE IF EXISTS spSelectBooks$$

CREATE PROCEDURE spSelectBooks
(
    IN isbn varchar(255),
    IN title varchar(255),
    IN author varchar(255),
    IN edition varchar(255),
    IN publisher varchar(255)
)
BEGIN
    -- Set optional parameters
    IF isbn IS NULL || isbn = "" THEN
        SET isbn = "%";
    ELSE
        SET isbn = CONCAT("%", isbn, "%");
    END IF;
    IF title IS NULL || title = "" THEN
        SET title = "%";
    ELSE
        SET title = CONCAT("%", title, "%");
    END IF;
    IF author IS NULL || author = "" THEN
        SET author = "%";
    ELSE
        SET author = CONCAT("%", author, "%");
    END IF;
    IF edition IS NULL || edition = "" THEN
        SET edition = "%";
    ELSE
        SET edition = CONCAT("%", edition, "%");
    END IF;
    IF publisher IS NULL || publisher = "" THEN
        SET publisher = "%";
    ELSE
        SET publisher = CONCAT("%", publisher, "%");
    END IF;

    SELECT tblBooks.isbn,
        tblBooks.title,
        tblBooks.author,
        tblBooks.edition,
        tblBooks.publisher,
        tblBooks.photoName
    FROM tblBooks
    WHERE tblBooks.isbn LIKE isbn
        AND tblBooks.title LIKE title
        AND IFNULL(tblBooks.author, '') LIKE author
        AND IFNULL(tblBooks.edition, '') LIKE edition
        AND IFNULL(tblBooks.publisher, '') LIKE publisher
    ORDER BY tblBooks.title;
END$$
DELIMITER ;