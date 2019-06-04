DELIMITER $$
DROP PROCEDURE IF EXISTS spNewUserRegisteredClass$$

CREATE PROCEDURE spNewUserRegisteredClass
(
    IN email varchar(255),
    IN classCRN varchar(255)
)
BEGIN
    INSERT INTO tblUserRegisteredClasses(email, classCRN)
    VALUES (email, classCRN);
END$$
DELIMITER ;