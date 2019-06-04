DELIMITER $$
DROP PROCEDURE IF EXISTS spSelectUserClassComment$$

CREATE PROCEDURE spSelectUserClassComment
(
    IN courseID varchar(255)
)
BEGIN
	SET courseID = CONCAT(courseID, "%");

    SELECT tblUsers.name,
        tblUserClassComment.classCRN,
        tblUserClassComment.shortDescription,
        tblUserClassComment.rating,
        tblUserClassComment.reviewDate,
        tblUserClassComment.instructor,
        tblUserClassComment.semester,
        tblUserClassComment.campus
    FROM tblUserClassComment
    LEFT OUTER JOIN tblClasses ON tblClasses.crn = tblUserClassComment.classCrn
    LEFT JOIN tblUsers on tblUsers.email = tblUserClassComment.email
    WHERE tblClasses.courseID LIKE courseID
    ORDER BY tblUserClassComment.reviewDate;
    END$$
DELIMITER ;
