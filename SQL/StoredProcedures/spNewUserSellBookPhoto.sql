DELIMITER $$
DROP PROCEDURE IF EXISTS spNewUserSellBookPhoto$$

CREATE PROCEDURE spNewUserSellBookPhoto
(
    IN id integer,
    IN photoName varchar(255)
)
BEGIN
    INSERT INTO tblUserSellBookPhoto(photoName)
    VALUES (photoName);
END$$
DELIMITER ;