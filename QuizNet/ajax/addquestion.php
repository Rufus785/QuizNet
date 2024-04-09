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


$sql = "INSERT INTO questions (question, level, answer_1, answer_2, answer_3, answer_4, subject_id) VALUES ('{$_GET['nowe_pytanie']}', '{$_GET['nowy_poziom']}', '{$_GET['nowa_odpowiedz1']}', '{$_GET['nowa_odpowiedz2']}', '{$_GET['nowa_odpowiedz3']}', '{$_GET['nowa_odpowiedz4']}', '{$_GET['subject']}')";


if ($mysqli -> query($sql)) {
	echo '<p>Pomyślnie dodano.</p>';
} else {
	echo '<p>Błąd dodania:</p>';
	echo $mysqli -> error;
}

?>