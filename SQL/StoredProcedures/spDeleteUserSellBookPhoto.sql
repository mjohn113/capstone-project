DELIMITER $$
DROP PROCEDURE IF EXISTS spDeleteUserSellBookPhoto$$

CREATE PROCEDURE spDeleteUserSellBookPhoto
(
    IN id integer,
    IN photoName varchar(255)
)
BEGIN
    DELETE FROM tblUserSellBookPhoto
    WHERE tblUserSellBookPhoto.id = id
    AND tblUserSellBookPhoto.photoName = photoName;
END$$
DELIMITER ;