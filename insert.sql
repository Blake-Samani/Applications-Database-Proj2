INSERT INTO  
Person
	(userid, pdw, ssn, username,firstname,lastname,birthdate,addy,sex,adminFlag,studentFlag)
values(
		000000001,
		'123456789',
		111111111,
		'janeslogin',
		'Jane',
		'Doe',
		TO_DATE('1999-10-15','yyyy/mm/dd'),
		'1400 Test Dr.',
		'F',
		'Y',
		'Y');
commit;

INSERT INTO  
Person
	(userid, pdw, ssn, username,firstname,lastname,birthdate,addy,sex,adminFlag,studentFlag)
values(
		000000002,
		'123456789',
		111111112,
		'testlogin',
		'Test',
		'Case',
		TO_DATE('1999-10-15','yyyy/mm/dd'),
		'1401 Test Dr.',
		'F',
		'N',
		'Y');
commit;

INSERT INTO  
Person
	(userid, pdw, ssn, username,firstname,lastname,birthdate,addy,sex,adminFlag,studentFlag)
values(
		000000003,
		'123456789',
		111111113,
		'b',
		'Blake',
		'samani',
		TO_DATE('1999-10-15','yyyy/mm/dd'),
		'1402 Test Dr.',
		'F',
		'N',
		'Y');
commit;

INSERT INTO  
Person
	(userid, pdw, ssn, username,firstname,lastname,birthdate,addy,sex,adminFlag,studentFlag)
values(
		000000004,
		'123456789',
		111111114,
		'nicklogin',
		'Nick',
		'Marinez',
		TO_DATE('1999-10-15','yyyy/mm/dd'),
		'1403 Test Dr.',
		'F',
		'N',
		'Y');
commit;

INSERT INTO  
Person
	(userid, pdw, ssn, username,firstname,lastname,birthdate,addy,sex,adminFlag,studentFlag)
values(
		000000005,
		'123456789',
		111111115,
		'jasonlogin',
		'Jason',
		'Hunter',
		TO_DATE('1999-10-15','yyyy/mm/dd'),
		'1404 Test Dr.',
		'F',
		'N',
		'Y');
commit;



INSERT INTO StudentUser
	(StudentId, UserId, Standing, StudentType, CreditsRec, GPA, CoursesCompleted)
SELECT CONCAT(CONCAT(SUBSTR(p.firstname, 1, 1),SUBSTR(p.lastname, 1, 1)),CAST(studentId_seq.NEXTVAL AS VARCHAR(6))), p.userID, 'Good','UnderGraduate',21, 2.5, 7
FROM Person p
WHERE p.userID <= 000000005;
commit;


INSERT INTO UserAdmin
	(AdminID,UserID)
values(
		20000000, 000000001
);
commit;


INSERT INTO Course
	(CourseNo, CourseTitle, Credits, PreReq)
VALUES(
		1, 'Database', 3, NULL
);
commit;

INSERT INTO Section
	(SectionId, Capacity, Schedule, Info, CourseNo,Semester)
VALUES(
		2, 25, 'TR 4:15pm-5:30pm', 'Learn how to database', 1, 'Fall 2020'
);
commit;
INSERT INTO Section
	(SectionId, Capacity, Schedule, Info, CourseNo, Semester)
VALUES(
		3, 25, 'TR 5:45pm-8:00pm', 'Learn how to database', 1, 'Fall 2020'
);
commit;
INSERT INTO Section
	(SectionId, Capacity, Schedule, Info, CourseNo, Semester)
VALUES(
		1, 25, 'MWF 11:00-11:50pm', 'Marie with Sung', 1, 'Spring 2020'
);
commit;


INSERT INTO Course
	(CourseNo, CourseTitle, Credits,PreReq)
VALUES(
		2, 'Programming 1', 3, 1
);
commit;
INSERT INTO Section
	(SectionId, Capacity, Schedule, Info, CourseNo, Semester)
VALUES(
		5, 25, 'MWF 9:00am-9:50pm', 'Learn the ++ to C', 2, 'Fall 2020'
);
commit;
INSERT INTO Section
	(SectionId, Capacity, Schedule, Info, CourseNo, Semester)
VALUES(
		4, 25, 'MWF 11:00-11:50pm', 'Learn the ++ to C', 2, 'Fall 2020'
);
commit;
INSERT INTO Section
	(SectionId, Capacity, Schedule, Info, CourseNo, Semester)
VALUES(
		6, 25, 'MWF 11:00-11:50pm', 'Marie with Sung', 2, 'Spring 2020'
);
commit;




INSERT INTO Course
	(CourseNo, CourseTitle, Credits,PreReq)
VALUES(
		3, 'Software Engineering I', 3, NULL
);
commit;
INSERT INTO Section
	(SectionId, Capacity, Schedule, Info, CourseNo, Semester)
VALUES(
		7, 25, 'MWF 9:00am-9:50pm', 'Diagnose Breastcancer with fu', 3, 'Fall 2020'
);
commit;
INSERT INTO Section
	(SectionId, Capacity, Schedule, Info, CourseNo, Semester)
VALUES(
		8, 25, 'MWF 11:00-11:50pm', 'Diagnose Brestcancer with fu', 3, 'Fall 2020'
);
commit;
INSERT INTO Section
	(SectionId, Capacity, Schedule, Info, CourseNo, Semester)
VALUES(
		9, 25, 'MWF 11:00-11:50pm', 'Marie with Sung', 3, 'Spring 2020'
);
commit;


INSERT INTO Course
	(CourseNo, CourseTitle, Credits, PreReq)
VALUES(
		4, 'Object Orient Programming', 3, NULL
);
commit;

INSERT INTO Section
	(SectionId, Capacity, Schedule, Info, CourseNo, Semester)
VALUES(
		12, 25, 'TR 1:00pm-2:15pm', 'Creating games with sung', 4, 'Fall 2020'
);
commit;
INSERT INTO Section
	(SectionId, Capacity, Schedule, Info, CourseNo, Semester)
VALUES(
		13, 25, 'MWF 11:00-11:50pm', 'Learning OOP with Qian', 4, 'Fall 2020'
);
commit;
INSERT INTO Section
	(SectionId, Capacity, Schedule, Info, CourseNo, Semester)
VALUES(
		14, 25, 'MWF 11:00-11:50pm', 'Marie with Sung', 4, 'Spring 2020'
);
commit;


INSERT INTO Course
	(CourseNo, CourseTitle, Credits, PreReq)
VALUES(
		5, 'Computer Organization', 3, NULL
);
commit;


INSERT INTO Section
	(SectionId, Capacity, Schedule, Info, CourseNo, Semester)
VALUES(
		15, 25, 'TR 11:00am-12:15pm', 'Monotone Marie with Rhee', 5, 'Fall 2020'
);
commit;
INSERT INTO Section
	(SectionId, Capacity, Schedule, Info, CourseNo, Semester)
VALUES(
		16, 25, 'MWF 11:00-11:50pm', 'Marie with Sung', 5, 'Fall 2020'
);
commit;
INSERT INTO Section
	(SectionId, Capacity, Schedule, Info, CourseNo, Semester)
VALUES(
		17, 25, 'MWF 11:00-11:50pm', 'Marie with Sung', 5, 'Spring 2020'
);
commit;






INSERT INTO Enrolls
	(SectionId, StudentId)
VALUES(
		7, 'JD100000'
);
commit;

INSERT INTO Enrolls
	(SectionId, StudentId)
VALUES(
		5, 'JD100000'
);
commit;

INSERT INTO Enrolls
	(SectionId, StudentId)
VALUES(
		17, 'JH100004'
);
commit;

INSERT INTO Deadline
	(Semester, Deadline)
VALUES(
	'Fall 2020', TO_DATE('2020-08-31', 'YYYY-MM-DD')
);
COMMIT;

INSERT INTO Deadline
	(Semester, Deadline)
VALUES(
	'Spring 2020', TO_DATE('2021-01-31', 'YYYY-MM-DD')
);
COMMIT;

INSERT INTO Grade (Grade,StudentId,SectionId)
VALUES (0.0,'JD100000',7);
COMMIT;
INSERT INTO Grade (Grade,StudentId,SectionId)
VALUES (0.0,'JD100000',5);
COMMIT;
INSERT INTO Grade (Grade,StudentId,SectionId)
VALUES (0.0,'JH100004',17);
COMMIT;