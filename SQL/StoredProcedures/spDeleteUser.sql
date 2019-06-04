DELIMITER $$
DROP PROCEDURE IF EXISTS spDeleteUser$$

CREATE PROCEDURE spDeleteUser
(
    IN email varchar(255)
)
BEGIN
    START TRANSACTION;
    DELETE FROM tblUserNotification WHERE tblUserNotification.email = email;
    DELETE FROM tblUserRegisteredClasses WHERE tblUserRegisteredClasses.email = email;
    DELETE FROM tblUserClassComment WHERE tblUserClassComment.email = email;

    DELETE FROM tblUserSellBookPhoto
    WHERE tblUserSellBookPhoto.id IN 
    (
        SELECT tblUserSellBook.id FROM tblUserSellBook
        WHERE tblUserSellBook.email = email
    );

    DELETE FROM tblUserSellBook WHERE tblUserSellBook.email = email;
    DELETE FROM tblUsers WHERE tblUsers.email = email;
    COMMIT;
END$$
DELIMITER ;