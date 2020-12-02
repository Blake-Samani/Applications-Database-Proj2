<link rel="stylesheet" href="style.css">
<?
$sessionid = $_GET["sessionid"];
$userid = $_GET["userid"];
$adminid = $_GET["adminid"];
$studentid = $_GET["studentid"];
// setup connection with Oracle
$connection = oci_connect ("gq001", "whzycj", "gqiannew2:1521/pdborcl");
if ($connection == false){
   // For oci_connect errors, no handle needed
   $e = oci_error(); 
   die($e['message']);
}


if($sessionid != ""){
	$sesh = "DELETE FROM usersession WHERE userid = $userid";
	$csesh = oci_parse ($connection, $sesh);
	oci_execute ($csesh);
}
if($adminid != ""){
	$a = "DELETE FROM useradmin WHERE userid = $userid";
	$ca = oci_parse ($connection, $a);
	oci_execute ($ca);
}
if($studentid != ""){
	$s = "DELETE FROM studentuser WHERE userid = $userid";
	$cs = oci_parse ($connection, $s);
	oci_execute ($cs);
}
if($adminid != "" && $studentid != ""){
	$sa = "DELETE FROM studentadmin WHERE userid = $userid";
	$csa = oci_parse ($connection, $sa);
	oci_execute ($csa);
}


// this is the SQL command to be executed
$query = "DELETE FROM person WHERE userid = $userid";

echo($a);
echo($s);
echo($sa);
echo($query);

// parse the SQL command
$cursor = oci_parse ($connection, $query);
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
oci_commit ($connection);
// close the connection with oracle
oci_close ($connection);
header("Location:admin.php");
?>