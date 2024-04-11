<?php

include("config.php");

if(!$_SESSION['logged']) die("Wypad");

if(isset($_POST['category_id'])){
	$sql = "SELECT * FROM questions WHERE subject_id = '{$_POST['category_id']}' AND level = '{$_POST['difficulty']}'";
	$result = $mysqli->query($sql);
	if ($result->num_rows >= 10){
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
					echo '<label for="option'.$key.'_'.$row_tmp['id'].'"><input type="radio" id="option'.$key.'_'.$row_tmp['id'].'" name="answer'.$row_tmp['id'].'" value="'.$key.'">'.$answer.'</label><br>';
				}
				echo '</div>
				<button class="hint-button">Podpowiedź</button>
			</div>
			';
		}
	}else{
		die('Niestety ten level nie jest jeszcze gotowy. <a href="index.php">Powrót</a>');
	}
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

<?php

$mysqli -> close();

?>