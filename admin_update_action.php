<?
$sessionid =$_GET["sessionid"];
$userid = $_GET["userid"];
$username = $_POST["username"];
$pdw = $_POST["pdw"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$ssn = $_POST["ssn"];
$addy = $_POST["addy"];
$bday = $_POST["bday"];
$sex = $_POST["sex"];


$connection = oci_connect ("gq001", "whzycj", "gqiannew2:1521/pdborcl");
if ($connection == false){
   // For oci_connect errors, no handle needed
   $e = oci_error(); 
   die($e['message']);
}

// the sql string
$sql = "UPDATE Person SET username = '$username', pdw = '$pdw', firstname = '$fname', lastname = '$lname',
		ssn = $ssn, addy = '$addy', birthdate = TO_DATE('$bday','yyyy/mm/dd'),sex = '$sex'
		WHERE userid = $userid";
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

oci_commit ($connection);
// close the connection with oracle
oci_close ($connection);

Header("Location:admin.php?sessionid=$sessionid");

?>