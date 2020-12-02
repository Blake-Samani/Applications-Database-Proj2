<?
$sessionid =$_GET["sessionid"];
$userid = $_POST["userid"];
$username = $_POST["username"];
$pdw = $_POST["pdw"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$ssn = $_POST["ssn"];
$addy = $_POST["addy"];
$bday = $_POST["bday"];
$sex = $_POST["sex"];
$isStudent = $_POST["isStudent"];
$isAdmin = $_POST["isAdmin"];

$connection = oci_connect ("gq001", "whzycj", "gqiannew2:1521/pdborcl");
if ($connection == false){
   // For oci_connect errors, no handle needed
   $e = oci_error(); 
   die($e['message']);
}

// the sql string
$sql = "INSERT INTO person (userid,username,pdw,firstname,lastname,birthdate,addy,sex,ssn) " . 
"VALUES ($userid, '$username', '$pdw','$fname','$lname',TO_DATE('$bday','yyyy/mm/dd'),'$addy','$sex',$ssn)";
//echo($sql);



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

if ($result == false){
  echo "<B>Insertion Failed.</B> <BR />";
  display_oracle_error_message($cursor);
}

if($isStudent){
  $studentSQL = "INSERT INTO StudentUser(StudentID, userID)
  SELECT CONCAT(CONCAT(SUBSTR(p.firstname, 1, 1),SUBSTR(p.lastname, 1, 1)),CAST(studentId_seq.NEXTVAL AS VARCHAR(6))), p.userID
  FROM Person p
  WHERE p.userID = $userid";
  $sCursor = oci_parse ($connection, $studentSQL);
  oci_execute ($sCursor);
}

if($isAdmin){
  $adminSQL = "INSERT INTO UserAdmin (AdminID, userID) VALUES ((SELECT MAX(AdminID) FROM UserAdmin)+1,$userid)";
  $aCursor = oci_parse ($connection, $adminSQL);
  oci_execute ($aCursor);
}

if($isAdmin && $isStudent){
  $saSQL = "INSERT INTO studentadmin (studentadminid, userid, studentid, adminid) " . 
  "VALUES ($admin . $studentid,$userid, $studentid, $adminid)";
  $saCursor = oci_parse ($connection, $saSQL);
  oci_execute ($saCursor);
}
oci_commit ($connection);
// close the connection with oracle
oci_close ($connection);

Header("Location:admin.php?sessionid=$sessionid");

?>