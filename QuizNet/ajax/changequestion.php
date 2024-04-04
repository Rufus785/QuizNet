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


$sql = "UPDATE questions SET question='{$_GET['nowe_pytanie']}', level='{$_GET['nowy_poziom']}', answer_1='{$_GET['nowa_odpowiedz1']}', answer_2='{$_GET['nowa_odpowiedz2']}', answer_3='{$_GET['nowa_odpowiedz3']}', answer_4='{$_GET['nowa_odpowiedz4']}' WHERE id = '{$_GET['id']}'";


if ($mysqli -> query($sql)) {
	echo '<p>Pomyślnie edytowano.</p>';
} else {
	echo '<p>Błąd edytowania:</p>';
	echo $mysqli -> error;
}

?>