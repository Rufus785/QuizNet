<?php

include("../config.php");

if($_SESSION['logged']){
	$sql = "SELECT * FROM users WHERE id = '{$_SESSION['user_id']}'";
	$result = $mysqli -> query($sql);
	$row = $result -> fetch_assoc();
	if($row['admin'] == 0) die("Wypad");
}else{
	die("Wypad");
}

$nazwa_kategorii = $mysqli->real_escape_string($_GET['value']);

$sql = "SELECT name FROM subjects WHERE name = '$nazwa_kategorii'";
$result = $mysqli -> query($sql);
if($result -> num_rows == 0){
	$sql = "UPDATE subjects SET name='$nazwa_kategorii' WHERE id = '{$_GET['id']}'";
	
	if ($mysqli -> query($sql)) {
		echo '<p>Pomyślnie edytowano.</p>';
	} else {
		echo '<p>Błąd edytowania:</p>';
		echo $mysqli -> error;
	}
} else {
	echo '<p>Jest już taka kategoria! :(</p>';
}

?>