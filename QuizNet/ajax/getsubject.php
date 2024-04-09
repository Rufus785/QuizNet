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


$sql = "SELECT * FROM questions WHERE subject_id = '{$_GET['id']}' AND level = 0";
$result = $mysqli->query($sql);

echo '<h6>Poziom łatwy - '.$result->num_rows.' pytań.<h6>';
if($result->num_rows < 10){
	$brakuje = 10 - $result->num_rows;
	echo '<p style="color:red">BRAKUJE '.$brakuje.' PYTAŃ!<p>';
}
echo '<button onclick="Show(\'latwy\');">Pokaż</button><div id="latwy" style="display: none">';

if ($result->num_rows > 0) {
	echo "<ol>";
	while ($row = $result->fetch_assoc()) {
		echo '<li>' . $row['question'] . ' | <button onclick="get_question('.$row['id'].')">Edytuj</button> | <button onclick="delete_question('.$row['id'].', '.$_GET['id'].')">Usuń</button></li>';
	}
	echo "</ol>";
} else {
	echo "Brak pytań w tej kategorii.";
}

echo '</div>';

$sql = "SELECT * FROM questions WHERE subject_id = '{$_GET['id']}' AND level = 1";
$result = $mysqli->query($sql);

echo '<h6>Poziom średni - '.$result->num_rows.' pytań.<h6>';
if($result->num_rows < 10){
	$brakuje = 10 - $result->num_rows;
	echo '<p style="color:red">BRAKUJE '.$brakuje.' PYTAŃ!<p>';
}
echo '<button onclick="Show(\'sredni\');">Pokaż</button><div id="sredni" style="display: none">';

if ($result->num_rows > 0) {
	echo "<ol>";
	while ($row = $result->fetch_assoc()) {
		echo '<li>' . $row['question'] . ' | <button onclick="get_question('.$row['id'].')">Edytuj</button> | <button onclick="delete_question('.$row['id'].', '.$_GET['id'].')">Usuń</button></li>';
	}
	echo "</ol>";
} else {
	echo "Brak pytań w tej kategorii.";
}

echo '</div>';


$sql = "SELECT * FROM questions WHERE subject_id = '{$_GET['id']}' AND level = 2";
$result = $mysqli->query($sql);

echo '<h6>Poziom trudny - '.$result->num_rows.' pytań.<h6>';
if($result->num_rows < 10){
	$brakuje = 10 - $result->num_rows;
	echo '<p style="color:red">BRAKUJE '.$brakuje.' PYTAŃ!<p>';
}
echo '<button onclick="Show(\'trudny\');">Pokaż</button><div id="trudny" style="display: none">';

if ($result->num_rows > 0) {
	echo "<ol>";
	while ($row = $result->fetch_assoc()) {
		echo '<li>' . $row['question'] . ' | <button onclick="get_question('.$row['id'].')">Edytuj</button> | <button onclick="delete_question('.$row['id'].', '.$_GET['id'].')">Usuń</button></li>';
	}
	echo "</ol>";
} else {
	echo "Brak pytań w tej kategorii.";
}

echo '</div>';

echo '<br><br><h5>Dodaj pytanie<h5>
            <div class="question-div">
				<h4>Dodaj pytanie</h4>
                <div class="questions">
                    <label for="category">Wybierz kategorię:</label>
                    <select id="category" name="ktora_kategoria">';
                        $sql = "SELECT id, name FROM subjects";
                        $result = $mysqli->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                            }
                        } else {
                            echo '<option value="">Brak kategorii</option>';
                        }
						echo'
                    </select>
                    <br><br>
                    <label for="text">Pytanie</label>
                    <input type="text" id="pytanie" name="pytanie" required>
                    <p>Wybierz poziom trudności:</p>
                    <div class="difficulty">
						<select name="poziom" id="poziom">
							<option value="0">Łatwy</option>
							<option value="1">Średni</option>
							<option value="2">Trudny</option>
						</select>
                    </div>
                </div>
                <div class="answers">
    <table>
        <thead>
            <tr>
                <th>Odpowiedzi</th>
                <th>Komentarz</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="odpowiedz1" id="odpowiedz1" required></td>
                <td>Odpowiedz prawidlowa</td>
            </tr>
            <tr>
                <td><input type="text" name="odpowiedz2" id="odpowiedz2" required></td>
                <td>Odpowiedz prawdopodobna</td>
            </tr>
            <tr>
                <td><input type="text" name="odpowiedz3" id="odpowiedz3" required></td>
                <td>Odpowiedź błędna</td>
            </tr>
            <tr>
                <td><input type="text" name="odpowiedz4" id="odpowiedz4" required></td>
                <td>Odpowiedź błędna</td>
            </tr>
        </tbody>
    </table>
</div>
                <button onclick="add_question();">Dodaj pytanie</button>
            </div>
';



?>

