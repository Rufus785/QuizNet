<?php

include("../config.php");

if(!$_SESSION['logged']){
	die("Wypad");
}

$sql = "SELECT count(id) as ilosc FROM answers WHERE attempt_id = '{$_GET['id']}' AND was_hinted = 1";

$result = $mysqli->query($sql);
$row = $result->fetch_assoc();

echo $row['ilosc'];


?>