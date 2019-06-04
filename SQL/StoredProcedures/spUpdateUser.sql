DELIMITER $$
DROP PROCEDURE IF EXISTS spUpdateUser$$

CREATE PROCEDURE spUpdateUser
(
    IN id integer,
    IN email varchar(255),
    IN name varchar(255),
    IN password varchar(255)
)
BEGIN
    UPDATE tblUsers
    SET tblUsers.email = email, tblUsers.name = name, tblUsers.password = password
    WHERE tblUsers.id = id;
END$$
DELIMITER ;