<?php

header('Content-Type: text/html; charset=UTF-8');

echo "<input class = \"button\" type = \"button\" name = \"back\" value = \"돌아가기\" onclick = \"javascript:location='homework3.html'\">";

$server="localhost";
$username="root";
$password="apmsetup";

$connect = mysql_connect($server, $username, $password) or die("connection failed");

if(!connect) die ('Not connected : '.mysql_error());

mysql_select_db("homework3",$connect);


$sql = 'select * from homework3.hw3_db';


echo "<table border=1>";
$result = mysql_query($sql, $connect);
while($row = mysql_fetch_assoc($result)){
	echo "<tr><td>".$row['name']."</td><td>".$row['email']."</td><td>".$row['phone']."</td></td><br>";
}
mysql_free_result($result);


mysql_close($connect);

?>