
<?
$sessionid =$_GET["sessionid"];
$userid =$_GET["userid"];


$connection = oci_connect ("gq001", "whzycj", "gqiannew2:1521/pdborcl");

if($connection == false){
  $e = oci_error(); 
  echo $e['message']."<BR>";
  $sessionid=""; 
} 
else { 
  // connection OK - validate current sessionid 
  if (!isset($sessionid) or ($sessionid=="")) { 
    // no session to maintain 
    $sessionid=""; 
  }
  else{ 
    // lookup the sessionid in the session table to get the clientid 
    $sql = "select userid from usersession where sessionid=$sessionid";  

    $cursor = oci_parse($connection, $sql);
    if($cursor == false){
      $e = oci_error($connection);  
      echo $e['message']."<BR>";
      // query failed - login impossible
      $sessionid="";
    }
    else{       
      $result = oci_execute($cursor);
      if ($result == false){
        $e = oci_error($cursor);  
        echo $e['message']."<BR>";
        $sessionid="";
      }
      else{
        if($values = oci_fetch_array ($cursor)){
          // found the sessionid
          $userid = $values[0];
        } 
        else { 
          // invalid sessionid 
          $sessionid = ""; 
        } 
      } 
      oci_free_statement($cursor);
    }
  } 
  oci_close($connection);
} 
?>
