DELIMITER $$
DROP PROCEDURE IF EXISTS spNewUserClassComment$$

CREATE PROCEDURE spNewUserClassComment
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
    IF reviewDate IS NULL THEN
        SET reviewDate = NOW();
	END IF;
    
    INSERT INTO tblUserClassComment 
    (
        email,
        classCRN,
        shortDescription,
        rating,
        reviewDate,
        instructor,
        semester,
        campus
    )
    VALUES 
    (
        email,
        classCRN,
        shortDescription,
        rating,
        reviewDate,
        instructor,
        semester,
        campus
    );
END$$
DELIMITER ;
