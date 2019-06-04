DELIMITER $$
DROP PROCEDURE IF EXISTS spSelectClasses$$

CREATE PROCEDURE spSelectClasses
(
    IN crn varchar(255),
    IN courseID varchar(255),
    IN title varchar(255),
    IN instructor varchar(255),
    IN credits varchar(255),
    IN campus varchar(255),
    IN startDate date,
    IN endDate date,
    IN startTime time,
    IN endTime time,
    IN meetDays varchar(255)
)
BEGIN
    -- Set optional parameters
    IF crn IS NULL || crn = "" THEN
        SET crn = "%";
    ELSE
        SET crn = CONCAT("%", crn, "%");
    END IF;
    IF courseID IS NULL || courseID = "" THEN
        SET courseID = "%";
    ELSE
        SET courseID = CONCAT("%", courseID, "%");
    END IF;
    IF title IS NULL || title = "" THEN
        SET title = "%";
    ELSE
        SET title = CONCAT("%", title, "%");
    END IF;
    IF credits IS NULL || credits = "" THEN
        SET credits = "%";
    ELSE
        SET credits = CONCAT("%", credits, "%");
    END IF;
    IF campus IS NULL || campus = "" THEN
        SET campus = "%";
    ELSE
        SET campus = CONCAT("%", campus, "%");
    END IF;
    IF startDate IS NULL THEN
        SET startDate = "2000-01-01";
    END IF;
    IF endDate IS NULL THEN
        SET endDate = "3000-01-01";
    END IF;
    IF instructor IS NULL || instructor = "" THEN
        SET instructor = "%";
    ELSE
        SET instructor = CONCAT("%", instructor, "%");
    END IF;
    IF startTime IS NULL || startTime = "" THEN
        SET startTime = "00:00:00";
    END IF;
    IF endTime IS NULL || endTime = "" THEN
        SET endTime = "23:59:59";
    END IF;
    IF meetDays IS NULL || meetDays = "" THEN
        SET meetDays = "%";
    ELSE
        SET meetDays = CONCAT("%", meetDays, "%");
    END IF;

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
        tblClasses.meetDays,
        tblClasses.totalSeats,
        tblClasses.seatsRemaining,
        tblClasses.description,
        tblClasses.lastUpdated
    FROM tblClasses
    WHERE tblClasses.crn LIKE crn
        AND tblClasses.courseID LIKE courseID
        AND tblClasses.title LIKE title
        AND tblClasses.instructor LIKE instructor
        AND tblClasses.credits LIKE credits
        AND tblClasses.campus LIKE campus
        AND tblClasses.startDate >= startDate
        AND tblClasses.endDate <= endDate
        AND tblClasses.startTime >= startTime
        AND tblClasses.endTime <= endTime
    ORDER BY tblClasses.courseID;
END$$
DELIMITER ;