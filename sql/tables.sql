CREATE TABLE mentorDetails
(
	mentorID INT(2) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	firstName VARCHAR(30) NOT NULL,
	lastName VARCHAR(30) NOT NULL,
	emailAddress VARCHAR(50) NOT NULL,
	strongSubject VARCHAR(30) NOT NULL,
	yearLevel INT(2) NOT NULL,
	UNIQUE (mentorID)
); 

CREATE TABLE menteeDetails
(
	menteeID INT(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	firstName VARCHAR(30) NOT NULL,
	lastName VARCHAR(30) NOT NULL,
	emailAddress VARCHAR(50) NOT NULL,
	weakSubject VARCHAR(30) NOT NULL,
	yearLevel INT(2) NOT NULL,
	UNIQUE (menteeID)
);

CREATE TABLE supervisorDetails
(
	supervisorID INT(2) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	firstName VARCHAR(30) NOT NULL,
	lastName VARCHAR(30) NOT NULL,
	emailAddress VARCHAR(30) NOT NULL,
	dateOfBirth DATE NOT NULL,
	UNIQUE(supervisorID)
);

CREATE TABLE sessionDetails
(
	sessionID INT(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	subjectName VARCHAR(30) NOT NULL,
	mentorID INT(2) NOT NULL,
	sessionDate DATE NOT NULL,
	startingTime TIME NOT NULL,
	isBooked TINYINT NOT NULL,
	UNIQUE (sessionID),
	FOREIGN KEY (mentorID) REFERENCES mentorDetails(mentorID)
);

CREATE TABLE bookingDetails
(
	bookingID INT(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	menteeID INT(3) NOT NULL,
	sessionID INT(3) NOT NULL,
	duration INT(3) NOT NULL,
	UNIQUE(bookingID),
	FOREIGN KEY (menteeID) REFERENCES menteeDetails(menteeID),
	FOREIGN KEY (sessionID) REFERENCES sessionDetails(sessionID)
);

CREATE TABLE reviews
(
	reviewID INT(2) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	sessionID INT(3) NOT NULL,
	menteeID INT(3) NOT NULL,
	review VARCHAR,
	UNIQUE(reviewID),
	FOREIGN KEY sessionID REFERENCES sessionDetails(sessionID),
	FOREIGN KEY menteeID REFERENCES bookingDetails(menteeID)
);