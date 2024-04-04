<link rel="stylesheet" href="admin-panel.css">
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

if(isset($_POST['kategoria'])){
    $nazwa_kategorii = $mysqli->real_escape_string($_POST['kategoria']);
    
    $sql = "SELECT name FROM subjects WHERE name = '$nazwa_kategorii'";
    $result = $mysqli -> query($sql);
    if($result -> num_rows == 0){
        $sql = "INSERT INTO subjects (name) VALUES ('$nazwa_kategorii')";
        
        if ($mysqli -> query($sql)) {
            echo '<p>Pomyślnie dodano.</p>';
        } else {
            echo '<p>Błąd dodania:</p>';
            echo $mysqli -> error;
        }
    } else {
        echo '<p>Jest już taka kategoria! :(</p>';
    }
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
            <div class="category-div">
                <h4>Dodaj kategorię pytań</h4>
                <form action="admin-panel.php" method="POST">
                    <input type="text" name="kategoria" id="">
                    <button type="submit" class="submit-button">Zatwierdź</button>
                </form>
            </div>
			<hr>
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
            <div class="question-div">
				<h4>Dodaj pytanie</h4>
                <div class="questions">
					<form action="admin-panel.php" method="POST">
                    <label for="category">Wybierz kategorię:</label>
                    <select id="category" name="ktora_kategoria">
                        <?php
                        $sql = "SELECT id, name FROM subjects";
                        $result = $mysqli->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                            }
                        } else {
                            echo '<option value="">Brak kategorii</option>';
                        }
                        ?>
                    </select>
                    <br><br>
                    <label for="text">Pytanie</label>
                    <input type="text" name="pytanie">
                    <p>Wybierz poziom trudności:</p>
                    <div class="difficulty">
						<select name="poziom">
							<option value="0">Łatwy</option>
							<option value="1">Średni</option>
							<option value="2">Trudny</option>
						</select>
                        <!-- <label><input type="radio" name="difficulty"> <p>Łatwy</p></label>
                        <label><input type="radio" name="difficulty"> <p>Średni</p></label>
                        <label><input type="radio" name="difficulty"> <p>Trudny</p></label>-->
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
                <td><input type="text" name="odpowiedz1"></td>
                <td>Odpowiedz prawidlowa</td>
            </tr>
            <tr>
                <td><input type="text" name="odpowiedz2"></td>
                <td>Odpowiedz prawdopodobna</td>
            </tr>
            <tr>
                <td><input type="text" name="odpowiedz3"></td>
                <td>Odpowiedź błędna</td>
            </tr>
            <tr>
                <td><input type="text" name="odpowiedz4"></td>
                <td>Odpowiedź błędna</td>
            </tr>
        </tbody>
    </table>
</div>



                <button class="submit">Dodaj pytanie</button>
				</form>
            </div>
        </div>
    </div>
	
	<br><br><hr><br><br>
	<h4>Strefa edycji</h4>
	<hr><br>
	
	<div id="category-div">
		<div id="subject_edit">
		</div>
		<div id="question_edit_info">
		</div>	
		<div id="question_edit">
		</div>
		<h4>Lista dodanych kategorii:</h4>
		<div id="subject_list">
		
		</div>
	</div>
</div>
</body>

<script src="script.js"></script>
<script src="js/admin-ajax.js"></script>