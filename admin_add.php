
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
$studentid = $_POST["studentid"];
$adminid = $_POST["adminid"];


// display the insertion form.
echo("
<form method='post' action='admin_add_action.php?sessionid=$sessionid'>
UserId (Required Up to 7 digits): <input type='text' value = '$userid' maxlength='5' name='userid'> <br /> 
First Name: <input type='text' value = '$fname' maxlength='50' name='fname'> <br /> 
Last Name: <input type='text' value = '$lname' maxlength='50' name='lname'> <br /> 
SSN (No dashes): <input type='text' value = '$ssn' maxlength='9' name='ssn'> <br />
Address: <input type='text' value = '$addy' maxlength='50' name='addy'> <br />
Birthday: <input type='date' value = '$bday' name='bday'> <br />
Sex (M/F): <input type='text' value = '$sex' maxlength='1' name='sex'> <br /> 
Username (Required): <input type='text' value = '$username' maxlength='50' name='username'>  <br />
Password (Required): <input type='text' value = '$pdw'  maxlength='100' name='pdw'>  <br />

AdminId (Up to 7 digits): <input type='text' value = '$adminid' maxlength='7' name='adminid'>  <br />
StudentId (Up to 7 digits): <input type='text' value = '$studentid' maxlength='7' name='studentid'>  <br />
(If both are filled out you will be a StudentAdmin) <br />

<input type='submit' value='Submit'>
<input type='reset' value='Reset to Original Value'>
</form>

  <form method='post' action='admin.php?sessionid=$sessionid'>
    <input type='submit' value='Go Back'>
  </form>");

?>