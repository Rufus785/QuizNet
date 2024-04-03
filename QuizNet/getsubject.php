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

$sql = "SELECT * FROM subjects WHERE id = '{$_GET['q']}'";
$result = $mysqli -> query($sql);
$row = $result -> fetch_assoc();

echo '<p>Edytuj kategorie: '.$row['name'].'</p>
	<form action="admin-panel.php" method="POST">
	Nowa nazwa <input name="nowa-nazwa-kategorii">
	<input type="hidden" name="nowa-nazwa-kategoria-id" value="'.$row['id'].'">
	<input type="submit" name="zmien-nazwe-kategorii">
	</form>
';

?>

