INSERT INTO mentorDetails (firstName, lastName, emailAddress, strongSubject, yearLevel)
    VALUES ("Robert", "Fitzgerald", "rfitz@mail.com", "English", 11);
INSERT INTO mentorDetails (firstName, lastName, emailAddress, strongSubject, yearLevel)
    VALUES ("Darcy", "Wilson", "dwils@mail.com", "Science", 12);
INSERT INTO mentorDetails (firstName, lastName, emailAddress, strongSubject, yearLevel)
    VALUES ("Timothy", "Thompson" "tthom@mail.com", "Maths", 11);
INSERT INTO mentorDetails (firstName, lastName, emailAddress, strongSubject, yearLevel)
    VALUES ("Becky", "Mulbridge", "bmulb@mail.com", "Science", 11);
INSERT INTO mentorDetails (firstName, lastName, emailAddress, strongSubject, yearLevel)
    VALUES ("Daniel", "Pickering", "dpick@mail.com", "History", 12);

INSERT INTO menteeDetails (firstName, lastName, emailAddress, weakSubject, yearLevel)
    VALUES ("William", "Donkerbridge", "wdonk@mail.com", "Maths", 10);
INSERT INTO menteeDetails (firstName, lastName, emailAddress, weakSubject, yearLevel)
    VALUES ("Stephanie", "Plithers", "split@mail.com", "Science", 8);
INSERT INTO menteeDetails (firstName, lastName, emailAddress, weakSubject, yearLevel)
    VALUES ("Gary", "Blight", "gblig@mail.com", "History", 9);
INSERT INTO menteeDetails (firstName, lastName, emailAddress, weakSubject, yearLevel)
    VALUES ("Bob", "Jefferys", "bjeff@mail.com", "History", 9);
INSERT INTO menteeDetails (firstName, lastName, emailAddress, weakSubject, yearLevel)
    VALUES ("Teddy", "Blight", "tblig@mail.com", "Science", 9);

INSERT INTO supervisorDetails (firstName, lastName, emailAddress, dateOfBirth)
    VALUES ("Janine", "Muller", "jmull@mail.com", "1969-06-09");
INSERT INTO supervisorDetails (firstName, lastName, emailAddress, dateOfBirth)
    VALUES ("Karen", "Pendable", "kligm@mail.com", "1993-03-18");
INSERT INTO supervisorDetails (firstName, lastName, emailAddress, dateOfBirth)
    VALUES ("Robert", "Roberts", "rrobe@mail.com", "1984-12-13");
INSERT INTO supervisorDetails (firstName, lastName, emailAddress, dateOfBirth)
    VALUES ("Blake", "Korentale", "bkore@mail.com", "1975-08-04");
INSERT INTO supervisorDetails (firstName, lastName, emailAddress, dateOfBirth)
    VALUES ("Patricia", "Nondelance", "pnond@mail.com", "1997-07-12");

INSERT INTO sessionDetails (subjectName, mentorID, sessionDate, startingTime, isBooked);
    VALUES ("Science", 4, "2023-08-04", "09:30", 0);
INSERT INTO sessionDetails (subjectName, mentorID, sessionDate, startingTime, isBooked);
    VALUES ("Maths", 3, "2023-10-10", "12:30", 0);
INSERT INTO sessionDetails (subjectName, mentorID, sessionDate, startingTime, isBooked);
    VALUES ("English", 3, "2023-09-05", "07:35", 0);
INSERT INTO sessionDetails (subjectName, mentorID, sessionDate, startingTime, isBooked);
    VALUES ("History", 7, "2023-09-05", "14:35", 0);
INSERT INTO sessionDetails (subjectName, mentorID, sessionDate, startingTime, isBooked);
    VALUES ("Science", 4, "2023-12-25", "11:30", 0);

INSERT INTO bookingDetails (menteeID, sessionID, duration) VALUES (5, 5, 40);
INSERT INTO bookingDetails (menteeID, sessionID, duration) VALUES (2, 3, 20);
INSERT INTO bookingDetails (menteeID, sessionID, duration) VALUES (4, 4, 30);
INSERT INTO bookingDetails (menteeID, sessionID, duration) VALUES (1, 2, 20);
INSERT INTO bookingDetails (menteeID, sessionID, duration) VALUES (3, 1, 20);

INSERT INTO reviews (sessionID, menteeID, review) VALUES (3, 2, "Perhaps I could learn more about using Write That Essay to help me write my paragraphs.");
INSERT INTO reviews (sessionID, menteeID, review) VALUES (5, 5, "Dumb loser looks like ******** ******.");
INSERT INTO reviews (sessionID, menteeID, review) VALUES (2, 4, "Tim has helped me understand the Pythagoras Theorem and SOH/CAH/TOA. He is a great tutor.");

