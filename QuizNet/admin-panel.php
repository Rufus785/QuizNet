<link rel="stylesheet" href="./css/admin-panel.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
		<body onload="show_subjects();">
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

?>

<div class="admin-panel-content">
    <a href="index.php">Strona główna</a>
    <h3>Witaj 
	<?php
		$sql = "SELECT login FROM users WHERE id = '{$_SESSION['user_id']}'";
		$result = $mysqli -> query($sql);
		$row = $result -> fetch_assoc();
		echo $row['login'];
	?>	
	!</h3>
    <p>Wybierz co chcesz zrobić</p>


    <!-- <div class="header-buttons">
        <button class="category" onclick="showCategory()">Dodaj kategorię</button>
        <button class="question" onclick="showQuestions()">Dodaj pytanie</button>
    </div> -->

    <div class="panel-group">
        <div class="panel-content">
			<?php
			
			if(isset($_POST['odpowiedz1'])){
				$sql = "INSERT INTO questions (question, answer_1, answer_2, answer_3, answer_4, subject_id, level) VALUES ('{$_POST['pytanie']}', '{$_POST['odpowiedz1']}', '{$_POST['odpowiedz2']}', '{$_POST['odpowiedz3']}', '{$_POST['odpowiedz4']}', '{$_POST['ktora_kategoria']}', '{$_POST['poziom']}')";
					
				if ($mysqli -> query($sql)) {
					echo '<p>Pomyślnie dodano.</p>';
				} else {
					echo '<p>Błąd dodania:</p>';
					echo $mysqli -> error;
				}
			}
			
			?>
        </div>
    </div>
	
	<br><br><hr><br><br>
	<h4>Strefa edycji</h4>
	<hr><br>
	
	<div id="category-div">
		<div id="question_edit_info">
		</div>	
		<div id="question_edit">
		</div>
		<div id="subject_edit">
		</div>
		<hr>
		<h4>Lista dodanych kategorii:</h4>
		<div id="subject_list">
		
		</div>
		<div id="subject_add_info">
		</div>
		<div id="subject_add">
		Dodaj kategorię: <input id="nazwa-nowej-kategorii"><button onclick="add_subject()">Dodaj</button>
		</div>
	</div>
</div>
</body>

<script src="./js/script-admin-panel.js"></script>
<script src="js/admin-ajax.js"></script>