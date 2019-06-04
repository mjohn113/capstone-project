DELIMITER $$
DROP PROCEDURE IF EXISTS spSelectUserSellBookPhoto$$

CREATE PROCEDURE spSelectUserSellBookPhoto
(
    IN id integer
)
BEGIN
    SELECT photoName
    FROM tblUserSellBookPhoto
    WHERE tblUserSellBookPhoto.id = id;
END$$
DELIMITER ;