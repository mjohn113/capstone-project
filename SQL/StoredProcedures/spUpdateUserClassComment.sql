DELIMITER $$
DROP PROCEDURE IF EXISTS spUpdateUserClassComment$$

CREATE PROCEDURE spUpdateUserClassComment
(
    IN email varchar(255),
    IN classCRN varchar(255),
    IN shortDescription varchar(2550),
    IN rating varchar(255),
    IN reviewDate date,
    IN instructor varchar(255),
    IN semester varchar(255),
    IN campus varchar(255)
)
BEGIN
    UPDATE tblUserClassComment
    SET tblUserClassComment.shortDescription = shortDescription,
    tblUserClassComment.rating = rating,
    tblUserClassComment.reviewDate = reviewDate,
    tblUserClassComment.instructor = instructor,
    tblUserClassComment.semester = semester,
    tblUserClassComment.campus = campus
    WHERE tblUserClassComment.email = email
    AND tblUserClassComment.classCRN = classCRN;
END$$
DELIMITER ;