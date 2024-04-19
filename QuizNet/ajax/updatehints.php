<?php

include("../config.php");

if(!$_SESSION['logged']){
	die("Wypad");
}

$sql = "UPDATE answers SET was_hinted = 1 WHERE attempt_id = '{$_GET['id']}' AND question_id = '{$_GET['q_id']}'";

$mysqli->query($sql);

echo $sql;

?>