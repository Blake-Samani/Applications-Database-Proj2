
<?
$sessionid =$_GET["sessionid"];
$userid =$_GET["userid"];
$password =$_GET["password"];


// display the insertion form.
echo("
<form method='post' action='changePdw.php?sessionid=$sessionid&userid=$userid'>
New Password: <input type='text' value ='$password' name='password'> <br /> 

<input type='submit' value='Update'>
<input type='reset' value='Reset'>
</form>")

?>