<?php
// Encoding type
header('Content-Type: text/html; charset=UTF-8');

echo "<link rel = \"stylesheet\" href = \"homework3.css\">";
echo "<input class = \"button\" type = \"button\" name = \"back\" value = \"돌아가기\" onclick = \"javascript:location='homework3.html'\"><br>";

$server="localhost";
$username="root";
$password="apmsetup";
// connect to mysql DB
$connect = mysql_connect($server, $username, $password) or die("connect fail");
// Exception handling
if(!connect) die ('Not connected : '.mysql_error());
// select DB (schema)
mysql_select_db("homework3",$connect);


$input = $_GET[work];
if ($input == "list"){
	$sql = listTheTable();
	$result = mysql_query($sql, $connect);
	showTable($result);
	mysql_free_result($result);
}
else if ($input == "search"){
	$sql = findFromTable($_GET[input]);
	$result = mysql_query($sql, $connect);
	showTable($result);
	mysql_free_result($result);
}
else if ($input == "input"){
	$input_name = $_GET[name];
	$input_email = $_GET[email];
	$input_phone = $_GET[phone];

	if (!empty($input_name) && !empty($input_email) && !empty($input_phone)){
		$sql = insertToTable($input_name, $input_email, $input_phone);
		mysql_query($sql, $connect);
	
		echo "테이블에 입력 완료";
	}
	else {
		echo "빈 입력이 있습니다";
	}
}
else if ($input == "delete"){
	$input_name = $_GET[input];
	$sql = deleteFromTable($input_name);
	mysql_query($sql, $connect);
}
else if ($input == "update"){
	$update_target = $_GET[targetname];

	$input_name = $_GET[name];
	$input_email = $_GET[email];
	$input_phone = $_GET[phone];

	if (!empty($input_name) && !empty($input_email) && !empty($input_phone)){
		$sql = updateTable($update_target, $input_name, $input_email, $input_phone);
		mysql_query($sql, $connect);
	
		echo "테이블에 갱신 완료";
	}
	else {
		echo "빈 입력이 있습니다";
	}
}


mysql_close($connect);

function showTable($query_result){
	echo "<table border=1>";
	while($row = mysql_fetch_assoc($query_result)){
		echo "<tr><td>".$row['name']."</td><td>".$row['email']."</td><td>".$row['phone']."</td></td><br>";
	}
}

function insertToTable($input_name, $input_email, $input_phone){
	$retsql = "insert into homework3.hw3_db (name, email , phone)
					values( '".$input_name."', '".$input_email."', '".$input_phone."')";

	//INSERT INTO `homework3`.`hw3_db` (`name`, `email`, `phone`)
					//VALUES ('기만왕', 'giman@cau.ac.kr', '010-4321-8765');

	return $retsql;
}

function deleteFromTable($input_name){
	$retsql = 'delete from homework3.hw3_db where name = "'.$input_name.'"';

	return $retsql;
}

function findFromTable($input){
	$retsql = 'select * from homework3.hw3_db where name like "%'.$input.
								'%" or email like "%'.$input.
								'%" or phone like "%'. $input.'%"'; 
	return $retsql;
}

function updateTable($target_name, $input_name, $input_email, $input_phone){
	$retsql = 'update homework3.hw3_db set name = "'.$input_name.
										'", email = "'.$input_email.
										'", phone = "'.$input_phone.
										'" where name = "'.$target_name.'"';

	return $retsql;
}

function listTheTable(){
	$retsql = 'select * from homework3.hw3_db';

	return $retsql;
}



?>