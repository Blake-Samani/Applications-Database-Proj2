<link rel="stylesheet" href="style.css">
<?
$sessionid =$_GET["sessionid"];
$userid =$_GET["userid"];
$sectionId = $_POST["sectionId"];
$studentId = $_POST["studentId"];

$connection = oci_connect ("gq001", "whzycj", "gqiannew2:1521/pdborcl");
if ($connection == false){
   // For oci_connect errors, no handle needed
   $e = oci_error(); 
   die($e['message']);
}

// $preReq = "";
// $seats = "";
// $passed = "";
// $deadline = "";


$sql = "INSERT INTO Enrolls (SectionId,StudentId) VALUES ($sectionId, '$studentId')";
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

Header("Location:addSection.php?sessionid=$sessionid&userid=$userid");
?>