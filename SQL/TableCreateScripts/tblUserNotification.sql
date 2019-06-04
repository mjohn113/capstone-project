DROP TABLE IF EXISTS tblUserNotification;

CREATE TABLE tblUserNotification (
	email varchar(255) NOT NULL,
	notificationType varchar(255) NOT NULL,
	PRIMARY KEY(email, notificationType),
	FOREIGN KEY(email) REFERENCES tblUsers(email) ON UPDATE CASCADE,
	FOREIGN KEY(notificationType) REFERENCES tblNotifications(type)
);