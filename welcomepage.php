<link rel="stylesheet" href="style.css">
<?
// include the verification PHP script
include "verifysession.php";

$connection = oci_connect ("gq001", "whzycj", "gqiannew2:1521/pdborcl");
if($connection == false){
  $e = oci_error(); 
  die($e['message']);
}

$studentSQL = "select userid from studentuser where userid = $userid";
$adminSQL = "select userid from useradmin where userid = $userid";
$studentadminSQL = "select userid from studentadmin where userid = $userid";

$studentC = oci_parse($connection, $studentSQL);
$adminC = oci_parse($connection, $adminSQL);
$studentadminC = oci_parse($connection, $studentadminSQL);

oci_execute($studentC);
oci_execute($adminC);
oci_execute($studentadminC);

$studentValues = oci_fetch_array ($studentC);
$adminValues = oci_fetch_array ($adminC);
$studentadminValues = oci_fetch_array ($studentadminC);

$studentUID = $studentValues[0];
$adminUID = $adminValues[0];
$studentadminUID = $studentadminValues[0];

if ($sessionid == "") { 
  // no active session - clientid is unknown
  echo("Invalid session!");
} 
else {
  // here we can generate the content of the welcome page
  if($studentadminUID == $userid){
    echo"<h1>Student Admin User Page</h1>";
    //logout button
    echo"<form method='post' action='logout.php?sessionid=$sessionid'>
    <button type='submit' class='addButton'>Logout</button>
    </form>";

    //change password
    echo"<form method='post' action='password_input.php?sessionid=$sessionid&userid=$userid'>
    <button type='submit' class='addButton'>Change Your Password</button>
    </form>";
    echo("<a href='student.php?sessionid=$sessionid&userid=$userid'>Student Page</a> <br/>");
    echo("<a href='admin.php?sessionid=$sessionid&userid=$userid'>Admin Page</a>");
  }
  else if($adminUID == $userid){
    Header("Location:admin.php?sessionid=$sessionid&userid=$userid");
  }
  else  if($studentUID == $userid){
    Header("Location:student.php?sessionid=$sessionid&userid=$userid");
  }
  else{
    echo("Invalid user! User is not a student or admin");
  }
}
?>
