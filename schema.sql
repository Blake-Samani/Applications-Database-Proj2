CREATE TABLE Person (
	UserId int PRIMARY KEY NOT NULL,
 	Pdw varchar(50),
	SSN int,
	UserName varchar(50),
	FirstName varchar(50),
	LastName varchar(50), 
	BirthDate date, 
	Addy varchar(50), 
	Sex varchar(1),
	adminFlag char(1),
	studentFlag char(1)
	);
COMMIT;
CREATE TABLE UserAdmin (
	AdminId int PRIMARY KEY NOT NULL,
	UserId int,
	CONSTRAINT FK_UserIdAdmin FOREIGN KEY (UserId) REFERENCES Person(UserId)
);
COMMIT;
CREATE TABLE StudentUser (
	StudentId varchar(8) PRIMARY KEY NOT NULL,
	UserId int,
	Standing varchar(50),
	StudentType varchar(50),
	CreditsRec int,
	GPA number(6,2),
	CoursesCompleted int,
	CONSTRAINT FK_UserIdStudent FOREIGN KEY (UserId) REFERENCES Person(UserId)
);
COMMIT;

CREATE SEQUENCE studentId_seq
 START WITH 100000
 INCREMENT BY 1
 NOCACHE
 NOCYCLE;
 COMMIT;

CREATE TABLE StudentAdmin (
	StudentAdminId int PRIMARY KEY NOT NULL,
	UserId int,
	StudentId varchar(8),
	AdminId int,
	CONSTRAINT FK_UserIdStudentAdmin FOREIGN KEY (UserId) REFERENCES Person(UserId),
	CONSTRAINT FK_StudentIdStudentAdmin FOREIGN KEY (StudentId) REFERENCES StudentUser(StudentId),
	CONSTRAINT FK_UserAdminIdStudentAdmin FOREIGN KEY (AdminId) REFERENCES UserAdmin(AdminId)
);
COMMIT;
CREATE TABLE UserSession (
	SessionId int PRIMARY KEY NOT NULL,
	SessionDate date,
	UserId int,
	CONSTRAINT FK_UserIdUserSession FOREIGN KEY (UserId) REFERENCES Person(UserId)
);
COMMIT;

CREATE TABLE Course(
	CourseNo int PRIMARY KEY NOT NULL,
	CourseTitle varchar(50),
	Credits int,
	Semester varchar(50)
);
COMMIT;

CREATE TABLE Section(
	SectionId int PRIMARY KEY NOT NULL,
	Capacity int,
	Schedule varchar(50),
	Info varchar(500),
	CourseNo int,
	CONSTRAINT FK_SectionCourse FOREIGN KEY (CourseNo) REFERENCES Course(CourseNo)
);
COMMIT;

CREATE TABLE Enrolls(
	SectionId int,
	StudentId varchar(8),
	CONSTRAINT FK_StudentSectionSection FOREIGN KEY (SectionId) REFERENCES Section(SectionId),
	CONSTRAINT FK_StudentSectionStudent FOREIGN KEY (StudentId) REFERENCES StudentUser(StudentId)
);
COMMIT;

CREATE VIEW v_SectionFullInfo (CourseNo, CourseTitle, Credits, Semester, SectionId, Capacity, Schedule, Info) AS 
SELECT c.CourseNo, c.CourseTitle, c.Credits, c.Semester, s.SectionId, s.Capacity, s.Schedule, s.Info
FROM Course c 
JOIN Section s ON s.CourseNo = c.CourseNo
ORDER BY c.CourseNo;
COMMIT;

