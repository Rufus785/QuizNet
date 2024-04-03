<?php

include("config.php");

if($_SESSION['logged']){
	$sql = "SELECT * FROM users WHERE id = '{$_SESSION['user_id']}'";
	$result = $mysqli -> query($sql);
	$row = $result -> fetch_assoc();
	if($row['admin'] == 0) die("Wypad");
}else{
	die("Wypad");
}

$sql = "DELETE FROM subjects WHERE id = '{$_GET['q']}'";
if ($mysqli -> query($sql)) {
	echo '<p>Pomyślnie usunięto!';
}else{
	echo '<p>Błąd dodania:</p>';
	echo $mysqli -> error;
}

?>

