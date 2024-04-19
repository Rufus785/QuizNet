<?php

include("../config.php");

if(!$_SESSION['logged']){
	die("Wypad");
}


$sql = "SELECT id FROM questions WHERE id = '{$_GET['id']}' AND answer_3 = '{$_GET['answer']}'";
$result = $mysqli->query($sql);
if ($result->num_rows > 0){
    echo "1";
}

$sql = "SELECT id FROM questions WHERE id = '{$_GET['id']}' AND answer_4 = '{$_GET['answer']}'";
$result = $mysqli->query($sql);
if ($result->num_rows > 0){
    echo "1";
}

?>