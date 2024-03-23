<link rel="stylesheet" href="styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script> 
<?php include 'navbar.php'; 
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
<p>Jestes w admin panelu</p>
<h1>Witaj ....... !</h1>
<p>Wybierz co chcesz zrobic</p>

	<?php
	
	if(isset($_POST['kategoria'])){
		$sql = "SELECT name FROM subjects WHERE name = '{$_POST['kategoria']}'";
		$result = $mysqli -> query($sql);
		if($result -> num_rows == 0){
			$sql = "INSERT INTO subjects (name) VALUES ('{$_POST['kategoria']}')";
			
			if ($mysqli -> query($sql)) {
				echo '<p>Pomyślnie dodano.</p>';
			}else{
				echo '<p>Błąd dodania:</p>';
				echo $mysqli -> error;
			}
		}else{
			echo '<p>Jest już taka kategoria! :(</p>';
		}
	}
	
	?>

<div class="panel-group">
<div class="panel">
    <button class="category" onclick="showCategory()">Dodaj kategorię</button>
    <button class="question" onclick="showQuestions()">Dodaj pytanie</button>
    <button class="permission" onclick="showPermissions()">Dodaj uprawnienia</button>
    <button class="attemps" onclick="showAttemps()">Dodaj próby</button>
</div>
<div class="panel-content">
    <div class="category-div">
<p>Dodaj kategorię pytań</p>
<form action="admin-panel.php" method="POST">
<button type="sumbit">+</button>
<input name="kategoria" id="">
</form>
    </div>
    <div class="question-div">
        <p>Wybierz kategorię</p>
        <textarea name="" id="" cols="10" rows="1"></textarea>
<p>Dodaj Pytanie </p>
<textarea name="" id="" cols="10" rows="1"></textarea>
<p>Podaj poziom trudności:</p>
<div class="difficulty">
    <input type="radio" name="difficulty"> <p>Łatwy</p>
    <input type="radio" name="difficulty"> <p>Średni</p>
    <input type="radio" name="difficulty"> <p>Trudny</p>
</div>
    </div>
    <div class="permission-div">
<p>Wybierz użytkownika</p>
<p>Tutaj bedzie jakas lista userow</p>
<p>Ale idk jak to zrobic</p>
    </div>
    <div class="attemps-div">
    <p>Wybierz użytkownika i dodaj mu próby </p>
<p>Tutaj bedzie jakas lista userow</p>
<p>Ale idk jak to zrobic</p>
    </div>
</div>
</div>
</div>
<script src="script.js"></script>