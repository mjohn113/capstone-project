DELIMITER $$
DROP PROCEDURE IF EXISTS spUpdateUserSellBook$$

CREATE PROCEDURE spUpdateUserSellBook
(
    IN id integer,
    IN bookISBN varchar(255),
    IN shortDescription varchar(255),
    IN longDescription varchar(2550),
    IN bookCondition varchar(255),
    IN price double
)
BEGIN
    UPDATE tblUserSellBook
    SET tblUserSellBook.bookISBN = bookISBN,
    tblUserSellBook.shortDescription = shortDescription,
    tblUserSellBook.longDescription = longDescription,
    tblUserSellBook.bookCondition = bookCondition,
    tblUserSellBook.price = price
    WHERE tblUserSellBook.id = id;
END$$
DELIMITER ;