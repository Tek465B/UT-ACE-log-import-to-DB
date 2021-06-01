<?php
error_reporting(-1); ini_set('display_errors', true);

$db = new PDO('mysql:host=localhost;dbname=databasename', 'username', 'password');

$total = 0;
$skipped = 0;
$time_start = microtime(TRUE);
$file = "~/logs.log";
if (file_exists($file)) {
$output = file('~/logs.log');

$stop = count($output) - 1;

for($i = 0; $i < $stop; $i += 13){
if (preg_match("/True/", $output[$i + 2])) {
$mip = explode(" ", $output[$i]);
$m2 = explode(" ", $output[$i + 7]);
$mhash = explode(" ", $output[$i + 8]);
$m1 = explode(" ", $output[$i + 6]);
$i += 1;
} else {
$mip = explode(" ", $output[$i]);
$m2 = explode(" ", $output[$i + 6]);
$mhash = explode(" ", $output[$i + 7]);
$m1 = explode(" ", $output[$i + 5]);
}
$mac1 = $m1[3];
$mac2 = $m2[3];
$machash = $mhash[3];
$macip = $mip[3];


$query = $db->prepare("SELECT ipaddr FROM Contacts WHERE ipaddr LIKE ?");
if (!$query) {
	var_dump($db->errorInfo());
}
$array = array("$macip");
$query->execute($array);
$donnees = $query->fetch();
$sresult = $donnees['ipaddr'];
if ($sresult != $macip) {
$total += 1;
$query2 = $db->prepare('INSERT INTO Contacts (mhash1, mhash2, hash, ipaddr) VALUES (?, ?, ?, ?)');
if (!$query2) {
	var_dump($db->errorInfo());
}
$queryy = array("$mac1", "$mac2", "$machash", "$macip");
$query2->execute($queryy);
} else {
$skipped += 1;
}
}
$skipped = $skipped - $total;
unlink($file);
echo "done<br />" . $total . " Player added<br />" . $skipped . " Player already into Database<br />";
$time_end = microtime(TRUE);
$time = $time_end - $time_start;
echo "Script execution time: " . $time;
} else { 
  echo "No File<br />"; 
$time_end = microtime(TRUE);
$time = $time_end - $time_start;
echo "Script execution time: " . $time;
}
?>
