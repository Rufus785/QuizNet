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

$sql = "SELECT id, name FROM subjects";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
	echo "<ul>";
	while ($row = $result->fetch_assoc()) {
		echo '<li>' . $row['name'] . ' | <button onclick="edit_subject('.$row['id'].')">Edytuj</button> | <button onclick="delete_subject('.$row['id'].')">Usuń</button></li>';
	}
	echo "</ul>";
} else {
	echo "Brak istniejących kategorii.";
}

?>