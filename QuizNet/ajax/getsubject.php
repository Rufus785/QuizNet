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

$sql = "SELECT * FROM subjects WHERE id = '{$_GET['id']}'";
$result = $mysqli -> query($sql);
$row = $result -> fetch_assoc();

echo '<h5>Edytuj kategorie "'.$row['name'].'"</h5>
	Zmień nazwę: <input value="'.$row['name'].'" id="nowa-nazwa-kategorii"><button onclick="change_subject_name('.$row['id'].')">Zmień</button>
	<br><br>
	<h5>Pytania w danej kategorii:</h5>
';

$sql = "SELECT * FROM questions WHERE subject_id = '{$_GET['id']}'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
	echo "<ol>";
	while ($row = $result->fetch_assoc()) {
		echo '<li>' . $row['question'] . ' | <button onclick="get_question('.$row['id'].')">Edytuj</button> | <button onclick="delete_question('.$row['id'].', '.$_GET['id'].')">Usuń</button></li>';
	}
	echo "</ol>";
} else {
	echo "Brak pytań w tej kategorii.";
}

?>

