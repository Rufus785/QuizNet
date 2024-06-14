<?php

include("config.php");

if(!(isset($_SESSION['logged']) && $_SESSION['logged'])){
        die("Wypad");
}

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
            <a href="index.php">Strona główna</a>
        </div>
<body>

<header class="header">
    <h1>Twoje wyniki</h1>
</header>

<?php

$sql = "SELECT a.id, a.level, a.start_time, a.end_time, s.name 
        FROM attempts a 
        INNER JOIN subjects s ON a.subject_id = s.id 
        WHERE a.user_id = '{$_SESSION['user_id']}' 
        ORDER BY a.id DESC";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo '<table><tr><th>Lp.</th><th>Przedmiot</th><th>Poziom</th><th>Data</th><th>Czas [s]</th><th>Wynik</th><th>Użyte podpowiedzi</th><th>Akcje</th></tr>';
    $i = 1;
    while ($row = $result->fetch_assoc()) {
        echo '<tr><td>'.$i.'</td><td>'.$row['name'].'</td><td>';
        if($row['level'] == 0) echo 'Łatwy';
        else if($row['level'] == 1) echo 'Średni';
        else echo 'Trudny';
        $startTime = date('Y-m-d H:i', $row['start_time']);
        echo '<td>'.$startTime.'</td>';
        $niedokonczony = 0;
        if($row['end_time'] == 0){
            $time = "Nie skończyłeś!";
            $niedokonczony = 1;
        }else $time = $row['end_time'] - $row['start_time'];
        echo '</td><td>'.$time.'</td><td>'.getTestResult($row['id'], $mysqli).'</td><td>'.getUsedHints($row['id'], $mysqli).'</td><td>';
        if($niedokonczony == 1) echo 'Nie możesz obejrzeć niedokończonego testu';
        else echo '<form action="results_show.php" method="POST"><input type="hidden" name="id" value="'.$row['id'].'"><button>Pokaż</button></form>';
        echo '</td></tr>';
        $i++;
    }
    echo '</table>';
} else {
    echo 'Nie masz żadnych wyników leniu!';
}

function getTestResult($attempt_id, $mysqli) {
    $correctAnswers = 0;
    $totalQuestions = 0;

    // Pobierz wszystkie odpowiedzi dla danego attempt_id
    $sql = "SELECT a.answer, a.question_id, q.answer_1 
            FROM answers a 
            INNER JOIN questions q ON a.question_id = q.id 
            WHERE a.attempt_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $attempt_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Sprawdź, czy odpowiedzi są prawidłowe
    while ($row = $result->fetch_assoc()) {
        $totalQuestions++;
        if ($row['answer'] == $row['answer_1']) {
            $correctAnswers++;
        }
    }

    $stmt->close();

    // Oblicz wynik
    $score = $correctAnswers . "/" . $totalQuestions;
    $percentage = ($totalQuestions > 0) ? ($correctAnswers / $totalQuestions) * 100 : 0;
    $color = ($percentage >= 50) ? 'green' : 'red';
    $formattedPercentage = number_format($percentage, 2) . '%';

    return $score . ' (<span style="color:' . $color . ';">' . $formattedPercentage . '</span>)';
}

function getUsedHints($attempt_id, $mysqli) {
    // Pobierz liczbę użytych podpowiedzi dla danego attempt_id
    $sql = "SELECT COUNT(*) as hint_count 
            FROM answers 
            WHERE attempt_id = ? AND was_hinted = 1";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $attempt_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    return $row['hint_count'].'/3';
}

?>
    <link rel="stylesheet" href="./css/results.css">
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