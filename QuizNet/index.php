<?php

include("config.php");

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QuizNet</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
		<div class="content">
        <?php 
		
		if(isset($_SESSION['logged']) && $_SESSION['logged']){
			
			$sql = "SELECT * FROM users WHERE id = '{$_SESSION['user_id']}'";
			$result = $mysqli -> query($sql);
			$row = $result -> fetch_assoc();
			if($row['admin'] == 1) {
				echo '<p>Witaj '.$row['login'].'. <a href="admin-panel.php">Admin Panel</a> | <a href="results.php">Wyniki</a> | <a href="logout.php">Wyloguj sie</a></p>';
			}else{
				echo '<p>Witaj '.$row['login'].'. Zapraszamy do zabawy! <a href="results.php">Wyniki</a> | <a href="logout.php">Wyloguj sie</a></p>';
			}
			
		}else{	
			if(isset($_POST['reg_login'])){
				if($_POST['reg_pass'] == $_POST['reg_pass2']){
					$sql = "SELECT login FROM users WHERE login = '{$_POST['reg_login']}'";
					$result = $mysqli -> query($sql);
					if($result -> num_rows == 0){
						$pass = codepass($_POST['reg_pass']);
						$sql = "INSERT INTO users (login, password) VALUES ('{$_POST['reg_login']}', '".$pass."')";
						
						if ($mysqli -> query($sql)) {
							echo '<script>alert("Pomyślnie zarejestrowano! Możesz się zalogować.");</script>';						}else{
							echo '<script>alert("Błąd dodania")</script>';
							echo $mysqli -> error;
						}
					}else{
						echo '<script>alert("Istnieje już użytkownik z takim loginem");</script>';
					}
				}else{
					echo '<script>alert("Hasła nie są takie same!");</script>';
				}
			}
			
			if(isset($_POST['login'])){
				$pass = codepass($_POST['password']);
				$sql = "SELECT id FROM users WHERE login = '{$_POST['login']}' AND password = '".$pass."' LIMIT 1";
				$result = $mysqli -> query($sql);
				if($result -> num_rows > 0){
					$row = $result -> fetch_assoc();
					$_SESSION['logged'] = true;
					$_SESSION['user_id'] = $row['id'];
					header("Location: index.php");
				}else{
					echo '<script>alert("Błędny login lub hasło!");</script>';
				}
			}
			
			echo '
			<div class="content1">
				<div class="login">
				<img src="img/QuizNet.png" alt="Logo">
					<h1>Logowanie</h1>
					<p>Podaj login oraz hasło</p>
					<form action="index.php" method="POST">
					<input type="text" class="login-label" name="login" placeholder="Login">
					<input type="password" class="password-label" name="password" placeholder="Hasło">
					<div class="confirm-button">
					<button class="confirm" type="submit">Zaloguj</button>
					</div>
					</form>
					<p>Nie masz konta? <a href="#" onclick="showRegistration()">Zarejestruj się!</a></p> 
				</div>
				<div class="registration"> 
					<img src="img/QuizNet.png" alt="Logo">
				<h1>Rejestracja</h1>
					<p>Podaj login oraz hasło</p>
					<form action="index.php" method="POST">
					<input type="text" class="login-label" name="reg_login" placeholder="Login">
					<input type="password" class="password-label" name="reg_pass" placeholder="Hasło">
					<input type="password" class="password-confirm-label" name="reg_pass2" placeholder="Potwierdź hasło">
					<div class="confirm-button">
						<button class="confirm" type="submit">Zarejestruj</button>
					</div>
					</form>
					<p>Masz już konto? <a href="#" onclick="showLogin()">Zaloguj się!</a></p> 
				</div>
				</div>
			';
		}
		
?>

</div>
</div>

<body>

<header>
    <h1>Witaj na stronie z quizami!</h1>
</header>

<section class="quiz-selection">
    <div class="container">
        <h2>Wybierz kategorię</h2>
		<form action="test.php" method="POST">

<?php

$sql = "SELECT id, name FROM subjects";
$result = $mysqli->query($sql);

if ($result->num_rows > 0){
	echo '<div class="categories"> <input type="hidden" id="category_id" name="category_id" value="">';
	while ($row = $result->fetch_assoc()){
        echo'<label id="levels" class="category-option" data-category="'.$row['name'].'">
                <input type="radio" name="category" value="'.$row['name'].'" onclick="setCategoryId('.$row['id'].')"> '.$row['name'].'
            </label>';
	}
	echo '</div>';
}else{
	echo 'Brak kategorii, musisz poczekać.';
}

?>

        <h2 class="center">Wybierz trudność</h2>
        <div class="difficulties" id="difficulties">

        </div>
		<div class="center1">
        <button id="submit" type="submit" class="centerButton">Potwierdź</button>
		</div>
		</form>
    </div>
</section>
<footer>
    <p>&copy; 2024 Strona z quizami.</p>
	<p>Mariusz Osiński, Jakub Kruczek, Stanisław Michalewski</p>
</footer>	
</body>
<script src="./js/script-login.js"></script>
<script src="./js/index-ajax.js"></script>

</html>

<?php

$mysqli -> close();

?>