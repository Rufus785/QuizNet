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
        <?php include 'navbar.php'; 
		
		if($_SESSION['logged']){
			
			$sql = "SELECT * FROM users WHERE id = '{$_SESSION['user_id']}'";
			$result = $mysqli -> query($sql);
			$row = $result -> fetch_assoc();
			if($row['admin'] == 1) {
				echo '<p>Witaj '.$row['login'].'. Jesteś administratorem, brawo! <a href="logout.php">Wyloguj sie</a></p>';
			}else{
				echo '<p>Witaj '.$row['login'].'. Zapraszamy do zabawy! <a href="logout.php">Wyloguj sie</a></p>';
			}
			
		}else{
			echo '<p>Zaloguj się bądź zarejestruj</p>';
		}
		
		?>
</body>
<script src="script.js"></script>
</html>

<?php

$mysqli -> close();

?>