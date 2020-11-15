<link rel="stylesheet" href="style.css">
<?
$sessionid =$_GET["sessionid"];
$userid =$_GET["userid"];

echo"<h1>Student Page</h1>";
//logout button
echo"<form method='post' action='logout.php?sessionid=$sessionid'>
  <button type='submit' class='addButton'>Logout</button>
  </form>";

//change password
echo"<form method='post' action='password_input.php?sessionid=$sessionid&userid=$userid'>
  <button type='submit' class='addButton'>Change Your Password</button>
  </form>";
?>