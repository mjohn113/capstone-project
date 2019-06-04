DELIMITER $$
DROP PROCEDURE IF EXISTS spDeleteUserSellBook$$

CREATE PROCEDURE spDeleteUserSellBook
(
    IN id integer
)
BEGIN
    DELETE FROM tblUserSellBookPhoto WHERE tblUserSellBookPhoto.id = id;
    DELETE FROM tblUserSellBook WHERE tblUserSellBook.id = id;
END$$
DELIMITER ;