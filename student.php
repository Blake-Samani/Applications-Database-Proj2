<link rel="stylesheet" href="style.css">
<?
$sessionid =$_GET["sessionid"];
$userid =$_GET["userid"];
$studentId = $_GET["studentId"];

$connection = oci_connect ("gq001", "whzycj", "gqiannew2:1521/pdborcl");
if ($connection == false){
   $e = oci_error(); 
   die($e['message']);
}

$sql = "SELECT s.CourseNo, s.SectionId, s.CourseTitle, s.Credits, s.Semester, s.Capacity, s.Schedule, s.Info 
FROM v_SectionFullInfo s 
JOIN Enrolls e ON e.SectionId = s.SectionId 
WHERE e.StudentId = '$studentId'";
$studentInfoSql = "SELECT su.StudentId, p.FirstName, p.LastName, p.BirthDate, p.addy, su.StudentType, su.Standing, su.GPA, su.CreditsRec, su.CoursesCompleted FROM Person p JOIN StudentUser su ON su.UserId = p.userid WHERE su.StudentId = '$studentId'";

$cursor = oci_parse ($connection, $sql);
if ($cursor == false){
   // For oci_parse errors, pass the connection handle
   $e = oci_error($connection);  
   die($e['message']);
}

// execute the command
$result = oci_execute ($cursor);
if ($result == false){
   // For oci_execute errors pass the cursor handle
   $e = oci_error($cursor);  
   die($e['message']);
}

$StudentCursor = oci_parse ($connection, $studentInfoSql);
if ($cursor == false){
   // For oci_parse errors, pass the connection handle
   $e = oci_error($connection);  
   die($e['message']);
}

$StudentResult = oci_execute ($StudentCursor);
if ($result == false){
   // For oci_execute errors pass the cursor handle
   $e = oci_error($StudentCursor);  
   die($e['message']);
}

$studentValues = oci_fetch_array ($StudentCursor);

 $sId = $studentValues[0];
 $fName = $studentValues[1];
 $lName = $studentValues[2];
 $birthday = $studentValues[3];
 $addy = $studentValues[4];
 $type = $studentValues[5];
 $standing = $studentValues[6];
 $gpa = $studentValues[7];
 $credits = $studentValues[8];
 $completed = $studentValues[9];



 echo "<h1>$fName $lName</h1>";
 echo "<p>Id: $sId &nbsp; Birthday: $birthday &nbsp; Address: $addy &nbsp; Type: $type &nbsp; <b>Status: $standing</b> &nbsp; GPA: $gpa</p>";
 echo "<p>Courses completed: $completed &nbsp; Total Credit Hours Earned: $credits </p>";

//table to show what sections are in enrolled in
echo "<table class='displayTable'>";
echo "<tr>
        <th>Course#</th>
        <th>Section#</th>
        <th>Course Title</th>
        <th>Credits</th>
        <th>Semester</th>
        <th>Capacity</th>
        <th>Schedule</th>
        <th>Info</th>
      </tr>";
// fetch the result from the cursor one by one
while ($values = oci_fetch_array ($cursor)){
  $courseNo = $values[0];
  $sectionId = $values[1];
  $courseTitle = $values[2];
  $credits = $values[3];
  $semester = $values[4];
  $capacity = $values[5];
  $schedule = $values[6];
  $info = $values[7];
  echo "<tr>
          <td>$courseNo</td>
          <td>$sectionId</td>
          <td>$courseTitle</td>
          <td>$credits</td>
          <td>$semester</td>
          <td>$capacity</td>
          <td>$schedule</td>
          <td>$info</td>
        </tr>";
}
echo ("</table>");

//Add Section button
echo"<form method='post' action='addSection.php?sessionid=$sessionid&userid=$userid'>
  <button type='submit' class='addButton'>Add Section</button>
  </form>";

//logout button
echo"<form method='post' action='logout.php?sessionid=$sessionid'>
  <button type='submit' class='addButton'>Logout</button>
  </form>";

//change password
echo"<form method='post' action='password_input.php?sessionid=$sessionid&userid=$userid'>
  <button type='submit' class='addButton'>Change Your Password</button>
  </form>";
?>