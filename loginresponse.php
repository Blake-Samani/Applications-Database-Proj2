<?
$userName = $_POST["userName"];
$pdw = $_POST["pdw"];

$connection = oci_connect ("gq001", "whzycj", "gqiannew2:1521/pdborcl");
if($connection == false){
  $e = oci_error(); 
  die($e['message']);
}

// connection OK - lookup the person
$sql = "select userId from person where userName = '$userName' and pdw = '$pdw'";
$cursor = oci_parse($connection, $sql);

if ($cursor == false) {
  $e = oci_error($connection);  
  echo $e['message']."<BR>";
  oci_close ($connection);
  // query failed - login impossible
  die("person Query Failed");
}

// query is OK - If we have any rows in the result set, we have
// found the person
$result = oci_execute($cursor);
if ($result == false){
  $e = oci_error($cursor);  
  echo $e['message']."<BR>";
  oci_close($connection);
  die("person Query Failed");
}

if(!$values = oci_fetch_array ($cursor)){
  oci_close ($connection);
  // person username not found
  die ("person not found.");
}

oci_free_statement($cursor);

// found the person
$userId = intval($values[0]);

// create a new session for this visitor
$sessionid = intval(md5(uniqid(rand())));

// store the link between the sessionid and the personid
// and when the session started in the session table

$sql = "insert into usersession (sessionid, userid, sessiondate) values ($sessionid, $userId, sysdate)";

$cursor = oci_parse($connection, $sql);

if($cursor == false){
  $e = oci_error($connection);  
  echo $e['message']."<BR>";
  oci_close ($connection);
  // insert Failed
  die ("Failed to create a new session");
}

$result = oci_execute($cursor);
if ($result == false){
  $e = oci_error($cursor);
  echo $e['message']."<BR>";
  oci_close($connection);
  die("Failed to create a new session");
}

// insert OK - we have created a new session
//oci_commit ($connection);
oci_close ($connection);
// jump to your welcome page
Header("Location:welcomepage.php?sessionid=$sessionid&userid=$userId");
?>
