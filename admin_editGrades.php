<link rel="stylesheet" href="style.css">
<?
$sessionid =$_GET["sessionid"];
$userid =$_GET["userid"];
$studentid = $_GET["studentid"];

$connection = oci_connect ("gq001", "whzycj", "gqiannew2:1521/pdborcl");
if ($connection == false){
   $e = oci_error(); 
   die($e['message']);
}
$sql = "SELECT s.CourseNo, s.SectionId, s.CourseTitle, s.Credits, s.Semester, s.Capacity, s.Schedule, s.Info, g.Grade
FROM v_SectionFullInfo s 
JOIN Enrolls e ON e.SectionId = s.SectionId
LEFT JOIN Grade g ON g.StudentId = e.StudentId AND g.SectionId = e.SectionId
WHERE e.StudentId = '$studentid'";



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



echo "<p>Please insert the number grade (A=4.0, B=3.0, C=2.0, D=1.0, F=0.0) and then click submit</p>";


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
        <th>Grade (number)</th>
        <th></th>
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
  $grade = $values[8];
  echo "
  <form method='post' action='admin_update_grade.php?sessionid=$sessionid&userid=$userid&studentid=$studentid'>
  <tr>
          <td>$courseNo</td>
          <td>$sectionId <input type='hidden' name='sectionId' value='$sectionId' /></td>
          <td>$courseTitle</td>
          <td>$credits</td>
          <td>$semester</td>
          <td>$capacity</td>
          <td>$schedule</td>
          <td>$info</td>
          <td><input type='text' value='$grade' maxlength='3' name='grade' /></td>
          <td><input type='submit' value='Submit'></td>
        </tr>
        </form>";
}
echo ("
        </table>
        
    
");

?>