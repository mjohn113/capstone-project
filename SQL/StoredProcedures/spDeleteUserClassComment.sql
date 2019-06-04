DELIMITER $$
DROP PROCEDURE IF EXISTS spDeleteUserClassComment$$

CREATE PROCEDURE spDeleteUserClassComment
(
    IN email varchar(255),
    IN classCRN varchar(255)
)
BEGIN
    DELETE FROM tblUserClassComment
    WHERE tblUserClassComment.email = email
    AND tblUserClassComment.classCRN = classCRN;
END$$
DELIMITER ;