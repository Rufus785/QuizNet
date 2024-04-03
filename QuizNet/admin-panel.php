<link rel="stylesheet" href="admin-panel.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
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
	
	<script>
	
	function edit_subject(id) {
		if (id == "") {
		document.getElementById("subject_edit").innerHTML = "";
		return;
		}
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function() {
		document.getElementById("subject_edit").innerHTML = this.responseText;
		}
		xhttp.open("GET", "getsubject.php?q="+id);
		xhttp.send();
	}
	
	function delete_subject(id) {
		var confirmation = window.confirm("Czy na pewno chcesz to zrobić?");
		
		if (confirmation) {
			if (id == "") {
			document.getElementById("subject_edit").innerHTML = "";
			return;
			}
			const xhttp = new XMLHttpRequest();
			xhttp.onload = function() {
			document.getElementById("subject_edit").innerHTML = this.responseText;
			}
			xhttp.open("GET", "deletesubject.php?q="+id);
			xhttp.send();
		} else {
			alert("To co zawracasz gitare :)");
		}
	}
	
	function confirmAction() {
    var confirmation = window.confirm("Czy na pewno chcesz to zrobić?");
    
    if (confirmation) {
    } else {
		alert("To co zawracasz gitare :)");
    }
}
	
	</script>
	
	<div id="category-div">
		<div id="subject_edit">
		<?php
		
		if(isset($_POST['nowa-nazwa-kategorii'])){
			$nazwa_kategorii = $mysqli->real_escape_string($_POST['nowa-nazwa-kategorii']);
			
			$sql = "SELECT name FROM subjects WHERE name = '$nazwa_kategorii'";
			$result = $mysqli -> query($sql);
			if($result -> num_rows == 0){
				$sql = "UPDATE subjects SET name='$nazwa_kategorii' WHERE id = '{$_POST['nowa-nazwa-kategoria-id']}'";
				
				if ($mysqli -> query($sql)) {
					echo '<p>Pomyślnie edytowano.</p>';
				} else {
					echo '<p>Błąd edytowania:</p>';
					echo $mysqli -> error;
				}
			} else {
				echo '<p>Jest już taka kategoria! :(</p>';
			}
		}
		
		?>
		</div>
		<h4>Lista dodanych kategorii:</h4>
		<?php
		$sql = "SELECT id, name FROM subjects";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			echo "<ul>";
			while ($row = $result->fetch_assoc()) {
				echo '<li>' . $row['name'] . ' | <button onclick="edit_subject('.$row['id'].')">Edytuj</button> | <button onclick="delete_subject('.$row['id'].')">Usun</button></li>';
			}
			echo "</ul>";
		} else {
			echo "Brak istniejących kategorii.";
		}
		?>
	</div>
</div>

<script src="script.js"></script>