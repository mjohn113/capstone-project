DELIMITER $$
DROP PROCEDURE IF EXISTS spNewUser$$

CREATE PROCEDURE spNewUser
(
    IN email varchar(255),
    IN name varchar(255),
    IN password varchar(255)
)
BEGIN
    INSERT INTO tblUsers (email, name, password)
    VALUES (email, name, password);
END$$
DELIMITER ;