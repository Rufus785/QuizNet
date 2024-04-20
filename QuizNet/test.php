<?php

include("config.php");

if(!$_SESSION['logged']) die("Wypad");

if(isset($_POST['category_id'])){
	$sql = "SELECT * FROM questions WHERE subject_id = '{$_POST['category_id']}' AND level = '{$_POST['difficulty']}'";
	$result = $mysqli->query($sql);
	if ($result->num_rows >= 10){
		echo '<form action="test.php" method="POST" class="content">';

		//dodajemy informacje o podejsciu
		$currentTime = time();
		$sql_insert = "INSERT INTO attempts (user_id, subject_id, `level`, `start_time`) VALUES ('{$_SESSION['user_id']}', '{$_POST['category_id']}', '{$_POST['difficulty']}', $currentTime)";
		$mysqli->query($sql_insert);

		$sql_get_attempt_id = "SELECT id FROM attempts ORDER BY ID DESC LIMIT 1";
		$result_get_attempt_id = $mysqli->query($sql_get_attempt_id);
		$row_get_attempt_id = $result_get_attempt_id->fetch_assoc();
		$attempt_id = $row_get_attempt_id['id'];

		$id_tab = array();
		while($row = $result->fetch_assoc()){
			$id_tab[] = $row['id'];
		}
		
		shuffle($id_tab);
		
		$i = 1;
		for ($j = 0; $j < 10; $j++) {
			$sql_tmp = "SELECT * FROM questions WHERE id = '{$id_tab[$j]}'";
			$result_tmp = $mysqli->query($sql_tmp);
			$row_tmp = $result_tmp->fetch_assoc();

			//dodawanie informacji o pytaniach
			$sql_insert_answer = "INSERT INTO answers (attempt_id, question_id, was_hinted) VALUES ($attempt_id, {$row_tmp['id']}, '0')";
			$mysqli->query($sql_insert_answer);

			$answers = array(
				'A' => $row_tmp['answer_1'],
				'B' => $row_tmp['answer_2'],
				'C' => $row_tmp['answer_3'],
				'D' => $row_tmp['answer_4']
			);

			shuffle($answers);

			echo '
			<div class="quiz-container">
				<h1>Pytanie nr '.$i++.'</h1>
				<p>'.$row_tmp['question'].'</p>
				<div class="options">';
				foreach ($answers as $key => $answer) {
					echo '<label for="option'.$key.'_'.$row_tmp['id'].'" id="label'.$key.'_'.$row_tmp['id'].'">
					<input type="radio" id="option'.$key.'_'.$row_tmp['id'].'" name="answer'.$row_tmp['id'].'" value="'.$answer.'">'.$answer.'</label><br>';
				}
				echo '</div>
				<button type="button" class="hint-button" onclick="getHint('.$row_tmp['id'].', '.$attempt_id.')" id="hint'.$row_tmp['id'].'">Podpowiedź</button>
			</div>
			';
		}
		echo '<input type="hidden" name="attempt_id" value="'.$attempt_id.'"><input type="submit" name="wyslij" value="Wyślij" class="wyslij">
		</form>';
	}else{
		die('Niestety ten level nie jest jeszcze gotowy. <a href="index.php">Powrót</a>');
	}
}else if($_POST['wyslij']){
    foreach ($_POST as $key => $value) {
        // Pomijamy klucz równy "wyslij"
        if ($key === "wyslij" || $key === "attempt_id") {
            continue;
        }
        // Usuwamy część klucza "answer"
        $trimmed_key = substr($key, 6); // Usuwamy 6 pierwszych znaków ("answer")
		$sql = "UPDATE answers SET answer = '$value' WHERE attempt_id = '{$_POST['attempt_id']}' AND question_id = $trimmed_key";
		$mysqli->query($sql);
    }

	$currentTime = time();
	$sql = "UPDATE attempts SET end_time = $currentTime WHERE id = '{$_POST['attempt_id']}'";
	$mysqli->query($sql);

	echo 'Zakończono egzamin. Twój wynik znajdziesz w sekcji Wyniki';
}else{
	header('Location: index.php');
}

?>

<link rel="stylesheet" href="./css/questions.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script> 	
		<script src="js/hint.js"></script>

<?php

$mysqli -> close();

?>