INSERT INTO  
Person(userid, pdw, ssn, username,firstname,lastname,birthdate,addy,sex,adminFlag,studentFlag)
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

INSERT INTO StudentUser(StudentID, userID)
SELECT CONCAT(CONCAT(SUBSTR(p.firstname, 1, 1),SUBSTR(p.lastname, 1, 1)),CAST(studentId_seq.NEXTVAL AS VARCHAR(6))), p.userID
FROM Person p
WHERE p.userID = 000000001;
commit;


INSERT INTO UserAdmin(AdminID,UserID)
values(
    20000000, 000000001
);
commit;

--Austin