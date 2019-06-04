DELIMITER $$
DROP PROCEDURE IF EXISTS spSelectNotifications$$

CREATE PROCEDURE spSelectNotifications
(

)
BEGIN
    SELECT tblNotifications.type,
        tblNotifications.description
    FROM tblNotifications;
END$$
DELIMITER ;