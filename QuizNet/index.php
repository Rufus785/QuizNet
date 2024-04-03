<?php

include("config.php");

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QuizNet</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
		<div class="content">
        <?php 
		
		if($_SESSION['logged']){
			
			$sql = "SELECT * FROM users WHERE id = '{$_SESSION['user_id']}'";
			$result = $mysqli -> query($sql);
			$row = $result -> fetch_assoc();
			if($row['admin'] == 1) {
				echo '<p>Witaj '.$row['login'].'. <a href="admin-panel.php">Admin Panel</a> <a href="logout.php">Wyloguj sie</a></p>';
			}else{
				echo '<p>Witaj '.$row['login'].'. Zapraszamy do zabawy! <a href="logout.php">Wyloguj sie</a></p>';
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
							echo '<p>Pomyślnie zarejestrowano! Możesz się zalogować.</p>';
						}else{
							echo '<p>Błąd dodania:</p>';
							echo $mysqli -> error;
						}
					}else{
						echo '<p>Istnieje już użytkownik z takim loginem</p>';
					}
				}else{
					echo '<p>Hasła nie są takie same!</p>';
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
					echo '<p>Błędny login lub hasło!</p>';
				}
			}
			
			echo '<p>Zaloguj się bądź zarejestruj</p>
				<div class="login">
				<img src="img/QuizNet.png" alt="Logo">
					<h1>Logowanie</h1>
					<p>Podaj login oraz hasło</p>
					<form action="login.php" method="POST">
					<input type="text" class="login-label" name="login" placeholder="Login">
					<input type="password" class="password-label" name="password" placeholder="Hasło">
					<div class="confirm-button">
					<button class="confirm" type="submit">Zaloguj</button>
					</div>
					</form>
					<!-- Funkcja podmieniająca wyświetlaną zawartość -->
					<p>Nie masz konta? <a href="#" onclick="showRegistration()">Zarejestruj się!</a></p> 
				</div>
				<!-- //Div odpowiedzialny za widocznośc rejestracji -->
				<div class="registration"> 
					<img src="img/QuizNet.png" alt="Logo">
				<h1>Rejestracja</h1>
					<p>Podaj login oraz hasło</p>
					<form action="login.php" method="POST">
					<input type="text" class="login-label" name="reg_login" placeholder="Login">
					<input type="password" class="password-label" name="reg_pass" placeholder="Hasło">
					<input type="password" class="password-confirm-label" name="reg_pass2" placeholder="Potwierdź hasło">
					<div class="confirm-button">
						<button class="confirm" type="submit">Zarejestruj</button>
					</div>
					</form>
					<!-- Funkcja podmieniająca wyświetlaną zawartość -->
					<p>Masz już konto? <a href="#" onclick="showLogin()">Zaloguj się!</a></p> 
				</div>
			';
		}
		
?>

</div>

		
</body>
<script src="script.js"></script>
</html>

<?php

$mysqli -> close();

?>