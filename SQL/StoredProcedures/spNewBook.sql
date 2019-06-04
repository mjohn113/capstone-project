DELIMITER $$
DROP PROCEDURE IF EXISTS spNewBook$$

CREATE PROCEDURE spNewBook
(
    IN isbn varchar(255),
    IN title varchar(255),
    IN author varchar(255),
    IN edition varchar(255),
    IN publisher varchar(255),
    IN photoName varchar(255)
)
BEGIN
    INSERT INTO tblBooks (isbn, title, author, edition, publisher, photoName)
    VALUES (isbn, title, author, edition, publisher, photoName);
END$$
DELIMITER ;