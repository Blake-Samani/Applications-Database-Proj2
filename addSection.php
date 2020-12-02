<link rel="stylesheet" href="style.css">
<?

$sessionid =$_GET["sessionid"];
$userid =$_GET["userid"];


$connection = oci_connect ("gq001", "whzycj", "gqiannew2:1521/pdborcl");
if ($connection == false){
   $e = oci_error(); 
   die($e['message']);
}

$studentSql = "SELECT s.StudentId FROM StudentUser s WHERE s.UserId = $userid";
$sql = "SELECT v.CourseNo, v.CourseTitle, v.Credits, v.Semester, v.SectionId, v.Capacity, v.Schedule, v.Info 
        FROM v_SectionFullInfo v 
        WHERE v.SectionId NOT IN (
            SELECT e.SectionId
            FROM Enrolls e
            JOIN StudentUser s ON s.StudentId = e.StudentId
            WHERE s.UserId = $userid
        )";


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


$cursorS = oci_parse ($connection, $studentSql);
if ($cursorS == false){
   // For oci_parse errors, pass the connection handle
   $e = oci_error($connection);  
   die($e['message']);
}

// execute the command
$resultS = oci_execute ($cursorS);
if ($resultS == false){
   // For oci_execute errors pass the cursor handle
   $e = oci_error($cursorS);  
   die($e['message']);
}

$valuesS = oci_fetch_array ($cursorS);
$studentId = $valuesS[0];

echo "<h1>Enroll in Section</h1>";
echo "<script>console.log('$studentId')</script>";
//table to show what sections are in enrolled in
echo "<table class='displayTable'>";
echo "<tr>
        <th>Course#</th>
        <th>Course Title</th>
        <th>Credits</th>
        <th>Semester</th>
        <th>SectionId</th>
        <th>Capacity</th>
        <th>Schedule</th>
        <th>Info</th>
        <th>Enroll</th>
      </tr>";

// fetch the result from the cursor one by one
while ($values = oci_fetch_array ($cursor)){
  $courseNo = $values[0];
  $courseTitle = $values[1];
  $credits = $values[2];
  $semester = $values[3];
  $sectionId = $values[4];
  $capacity = $values[5];
  $schedule = $values[6];
  $info = $values[7];


  echo "<tr>
          <td>$courseNo</td>
          <td>$courseTitle</td>
          <td>$credits</td>
          <td>$semester</td>
          <td>$sectionId</td>
          <td>$capacity</td>
          <td>$schedule</td>
          <td>$info</td>
          <td> 
            <form method='post' action='section_add_action.php?sessionid=$sessionid&userid=$userid'>
                <input type='hidden' name='sectionId' value=$sectionId>
                <input type='hidden' name='studentId' value='$studentId'> 
                <button type='submit'>Enroll</button>
            </form></td>
        </tr>";
}
echo ("</table>");

echo "<form method='post' action='student.php?sessionid=$sessionid&userid=$userid&studentId=$studentId'>
<input type='submit' value='Go Back'>
</form>";
?>