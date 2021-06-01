<?php 
  if(isset($_POST['submit'])){ 
  if(isset($_GET['go'])){ 
  if(preg_match("/^[  a-zA-Z0-9]+/", $_POST['ip'])){ 
  $name=$_POST['ip']; 
  $db = new PDO('mysql:host=localhost;dbname=databasename', 'login', 'password');

  $sql = $db->prepare("SELECT ID, mhash1, mhash2, hash, ipaddr FROM Contacts WHERE ipaddr LIKE ?");
    if (!$sql) {
	var_dump($db->errorInfo());
  }
  $array = array("%" . $name . "%");
  $sql->execute($array);
  while ($row = $sql->fetch()) {
          $ip  =$row['ipaddr'];
          $hash=$row['mhash1'];
          $hash2=$row['mhash2'];
          $hw=$row['hash'];
          $ID=$row['ID'];
  echo "<ul>\n"; 
  echo "<li>" . "<a  href=\"search.php?id=$ID\">"   .$ip . "</a></li>\n"; 
  echo "</ul>"; 
  }
  } 
  else{ 
  echo  "<p>Please enter a search query</p>"; 
  } 
  } 
  } 
  
  if(isset($_POST['submit'])){ 
  if(isset($_GET['go1'])){ 
  if(preg_match("/^[  a-zA-Z0-9]+/", $_POST['hash'])){ 
  $name=$_POST['hash']; 
  $db = new PDO('mysql:host=localhost;dbname=databasename', 'login', 'password');
    $sql = $db->prepare("SELECT ID, mhash1, mhash2, hash, ipaddr FROM Contacts WHERE mhash1 LIKE ? OR mhash2 LIKE ? OR hash LIKE ?");
    if (!$sql) {
	var_dump($db->errorInfo());
  }
  $array = array("%" . $name . "%", "%" . $name . "%", "%" . $name . "%");
  $sql->execute($array);
  while ($row = $sql->fetch()) {
          $ip  =$row['ipaddr'];
          $hash=$row['mhash1'];
          $hash2=$row['mhash2'];
          $hw=$row['hash'];
          $ID=$row['ID'];
  echo "<ul>\n"; 
  echo "<li>" . "<a  href=\"search.php?id=$ID\">"   .$ip . "</a></li>\n"; 
  echo "</ul>"; 
  }
  } 
  else{ 
  echo  "<p>Please enter a search query</p>"; 
  } 
  } 
  }

if(isset($_GET['id'])){ 
$contactid=$_GET['id']; 
  $db = new PDO('mysql:host=localhost;dbname=databasename', 'login', 'password');

    $sql = $db->prepare("SELECT * FROM Contacts WHERE ID = ?");
    if (!$sql) {
	var_dump($db->errorInfo());
  }
  $array = array("$contactid");
  $sql->execute($array);
while($row = $sql->fetch()){ 
          $ip  =$row['ipaddr'];
          $hash=$row['mhash1'];
          $hash2=$row['mhash2'];
          $hw=$row['hash'];
echo  "<ul>\n"; 
echo  "<li> hash 1: " . $hash . "</li>\n"; 
echo  "<li>hash 2: " . $hash2 . "</li>\n";
echo  "<li>HWID: " . $hw . "</li>\n";  
echo  "<li>Ip Address: " . $ip . "</li>\n";  
echo  "</ul>"; 
} 
}


?>
