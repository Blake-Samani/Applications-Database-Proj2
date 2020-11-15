<link rel="stylesheet" href="style.css">
<?
$sessionid =$_GET["sessionid"];
$userid =$_GET["userid"];

$connection = oci_connect ("gq001", "whzycj", "gqiannew2:1521/pdborcl");
if($connection == false){
  $e = oci_error(); 
  die($e['message']);
}
// display the results
$query = "select p.userid,p.username,p.pdw,s.studentid,a.adminid,p.firstname,p.lastname,p.ssn,p.birthdate,p.addy,p.sex " .
	  "from person p ". 
	  "left join studentuser s on p.userid = s.userid ". 
	  "left join useradmin a on p.userid = a.userid";
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

echo"<h1>Admin User Page</h1>";
//logout button
echo"<div class='wrapper'>";
echo"<form method='post' action='logout.php?sessionid=$sessionid'>
  <button type='submit' class='addButton'>Logout</button>
  </form>";

//change password
echo"<form method='post' action='password_input.php?sessionid=$sessionid&userid=$userid'>
  <button type='submit' class='addButton'>Change Your Password</button>
  </form>";

//addbutton
echo"<form method='post' action='admin_add.php?sessionid=$sessionid'>
  <button type='submit' class='addButton'>Add</button>
  </form>";
echo"</div>";

echo "<table class='displayTable'>";
echo "<tr>
        <th>userid</th>
        <th>username</th>
        <th>password</th>
        <th>firstname</th>
        <th>lastname</th>
        <th>ssn</th>
        <th>sex</th>
        <th>bday</th>
        <th>address</th>
        <th>studentid</th>
        <th>adminid</th>
        <th></th>
        <th></th>
      </tr>";
// fetch the result from the cursor one by one
while ($values = oci_fetch_array ($cursor)){
  $userid = $values[0];
  $username = $values[1];
  $password = $values[2];
  $studentid = $values[3];
  $adminid = $values[4];
  $fname = $values[5];
  $lname = $values[6];
  $ssn = $values[7];
  $bday = $values[8];
  $addy = $values[9];
  $sex = $values[10];

  echo "<tr>
  <td>$userid</td>
  <td>$username</td>
  <td>$password</td>
  <td>$fname</td>
  <td>$lname</td>
  <td>$ssn</td>
  <td>$sex</td>
  <td>$bday</td>
  <td>$addy</td>
  <td>$studentid</td>
  <td>$adminid</td>
  <td>
    <form method='post' action='admin_update.php?sessionid=$sessionid'>
    <input type='hidden' name='userid' value='$userid'>
    <input type='hidden' name='username' value='$username'>
    <input type='hidden' name='password' value='$password'>
    <input type='hidden' name='fname' value='$fname'>
    <input type='hidden' name='lname' value='$lname'>
    <input type='hidden' name='ssn' value='$ssn'>
    <input type='hidden' name='sex' value='$sex'>
    <input type='hidden' name='bday' value='$bday'>
    <input type='hidden' name='addy' value='$addy'>
    <button type='submit'>Update</button>
    </form>
  </td>
  <td>
    <form method='post' action='admin_delete.php?sessionid=$sessionid&userid=$userid&adminid=$adminid&studentid=$studentid'>
     <button type='submit'>Delete</button>
    </form>
  </td>
  </tr>";
}
echo ("</table>");

?>


