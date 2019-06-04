DROP TABLE IF EXISTS tblClasses;

CREATE TABLE tblClasses (
	crn varchar(255) NOT NULL,
	courseID varchar(255) NOT NULL,
	title varchar(255) NOT NULL,
	instructor varchar(255) NOT NULL,
	credits varchar(255) NOT NULL,
	campus varchar(255) NOT NULL,
	location varchar(255) NOT NULL,
	startDate date NOT NULL,
	endDate date NOT NULL,
	startTime time,
	endTime time,
	meetDays varchar(255),
	totalSeats integer,
	seatsRemaining integer,
	description varchar (255),
	lastUpdated datetime,
	PRIMARY KEY (crn)
);