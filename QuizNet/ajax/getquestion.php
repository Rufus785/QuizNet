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

$sql = "SELECT * FROM questions WHERE id = '{$_GET['id']}'";
$result = $mysqli -> query($sql);
$row = $result -> fetch_assoc();

echo 'Pytanie: <input id="nowe_pytanie" value="'.$row['question'].'"><br>
Poziom trudności: 
<select id="nowy_poziom">
	<option value="0" '; 
	if($row['level'] == 0) echo 'selected';
	echo'>Łatwy</option>
	<option value="1" ';
	if($row['level'] == 1) echo 'selected';
	echo'>Średni</option>
	<option value="2" ';
	if($row['level'] == 2) echo 'selected';
	echo'>Trudny</option>
</select>
    <table>
        <thead>
            <tr>
                <th>Odpowiedzi</th>
                <th>Komentarz</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" id="nowa_odpowiedz1" value="'.$row['answer_1'].'"></td>
                <td>Odpowiedz prawidlowa</td>
            </tr>
            <tr>
                <td><input type="text" id="nowa_odpowiedz2" value="'.$row['answer_2'].'"></td>
                <td>Odpowiedz prawdopodobna</td>
            </tr>
            <tr>
                <td><input type="text" id="nowa_odpowiedz3" value="'.$row['answer_3'].'"></td>
                <td>Odpowiedź błędna</td>
            </tr>
            <tr>
                <td><input type="text" id="nowa_odpowiedz4" value="'.$row['answer_4'].'"></td>
                <td>Odpowiedź błędna</td>
            </tr>
        </tbody>
    </table>
<button onclick="change_question('.$row['id'].')">Zmień pytanie</button>
';

echo '<br><br>';
?>