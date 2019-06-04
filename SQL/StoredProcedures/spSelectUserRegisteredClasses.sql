DELIMITER $$
DROP PROCEDURE IF EXISTS spSelectUserRegisteredClasses$$

CREATE PROCEDURE spSelectUserRegisteredClasses
(
    IN email varchar(255)
)
BEGIN
    SELECT tblClasses.crn,
        tblClasses.courseID,
        tblClasses.title,
        tblClasses.instructor,
        tblClasses.credits,
        tblClasses.campus,
        tblClasses.location,
        tblClasses.startDate,
        tblClasses.endDate,
        tblClasses.startTime,
        tblClasses.endTime,
        tblClasses.totalSeats,
        tblClasses.seatsRemaining,
        tblClasses.meetDays,
        tblClasses.description,
        tblClasses.lastUpdated
    FROM tblUserRegisteredClasses
    LEFT OUTER JOIN tblClasses ON tblClasses.crn = tblUserRegisteredClasses.classCRN
    WHERE tblUserRegisteredClasses.email = email;
END$$
DELIMITER ;
