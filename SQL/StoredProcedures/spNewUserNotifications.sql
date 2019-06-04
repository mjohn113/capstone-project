DELIMITER $$
DROP PROCEDURE IF EXISTS spNewUserNotifications$$

CREATE PROCEDURE spNewUserNotifications
(
    IN email varchar(255),
    IN notificationType varchar(255)
)
BEGIN
    INSERT INTO tblUserNotification(email, notificationType) 
    VALUES(email, notificationType) 
    ON DUPLICATE KEY UPDATE    
    email = email, notificationType = notificationType;
END$$
DELIMITER ;
