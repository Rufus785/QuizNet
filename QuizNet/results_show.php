<?php
include("config.php");

if(!$_SESSION['logged']) die("Wypad");

if(isset($_POST['id'])){
    $attempt_id = $_POST['id'];

    // Pobierz informacje o podejściu
    $sql_attempt = "SELECT a.level, s.name, a.start_time, a.end_time 
                    FROM attempts a 
                    INNER JOIN subjects s ON a.subject_id = s.id 
                    WHERE a.id = ?";
    $stmt_attempt = $mysqli->prepare($sql_attempt);
    $stmt_attempt->bind_param("i", $attempt_id);
    $stmt_attempt->execute();
    $result_attempt = $stmt_attempt->get_result();
    $attempt_info = $result_attempt->fetch_assoc();
    $stmt_attempt->close();

    // Pobierz pytania i odpowiedzi dla danego podejścia
    $sql_answers = "SELECT a.answer, a.was_hinted, q.id as question_id, q.question, q.answer_1, q.answer_2, q.answer_3, q.answer_4 
                    FROM answers a 
                    INNER JOIN questions q ON a.question_id = q.id 
                    WHERE a.attempt_id = ?";
    $stmt_answers = $mysqli->prepare($sql_answers);
    $stmt_answers->bind_param("i", $attempt_id);
    $stmt_answers->execute();
    $result_answers = $stmt_answers->get_result();
    
    echo '<div class="container">';
    echo '<h1>Wyniki dla podejścia nr: '.$attempt_id.'</h1>';
    echo '<h3>Przedmiot: '.$attempt_info['name'].'</h3>';
    echo '<h4>Poziom: '.($attempt_info['level'] == 0 ? 'Łatwy' : ($attempt_info['level'] == 1 ? 'Średni' : 'Trudny')).'</h4>';
    echo '<h4>Data rozpoczęcia: '.date('Y-m-d H:i', $attempt_info['start_time']).'</h4>';
    echo '<h4>Czas trwania: '.($attempt_info['end_time'] == 0 ? 'Nie skończyłeś!' : ($attempt_info['end_time'] - $attempt_info['start_time']).' s').'</h4>';
    
    $i = 1;
    while ($row = $result_answers->fetch_assoc()) {
        $answers = array(
            'A' => $row['answer_1'],
            'B' => $row['answer_2'],
            'C' => $row['answer_3'],
            'D' => $row['answer_4']
        );
        
        echo '<div class="quiz-container">';
        echo '<h2>Pytanie nr '.$i++.'</h2>';
        echo '<p>'.$row['question'].'</p>';
        echo '<div class="options">';
        foreach ($answers as $key => $answer) {
            // Sprawdź, czy odpowiedź jest zaznaczona przez użytkownika
            $checked = ($row['answer'] == $answer) ? 'checked' : '';
            
            // Sprawdź, czy odpowiedź jest poprawna
            $correct = ($row['answer_1'] == $answer);
        
            // Ustaw ikonę/zaznaczenie dla poprawnej odpowiedzi
            $icon = ($correct) ? '&#10004;' : '';
        
            // Jeżeli użytkownik zaznaczył nieprawidłową odpowiedź, ustaw ikonę na krzyżyk
            if (!$correct && $checked) {
                $icon = '&#10006;';
            }
            $class = $correct ? 'checked' : ($checked ? 'incorrect' : '');
            // Wyświetl odpowiedź z odpowiednim zaznaczeniem
            echo '<label class="'.$class.'" for="option'.$key.'_'.$row['question_id'].'">';
            echo '<input type="radio" id="option'.$key.'_'.$row['question_id'].'" name="answer'.$row['question_id'].'" value="'.$answer.'" '.$checked.' disabled>'.$answer.$icon;
            echo '</label><br>';
        }
                               
        echo '</div>';
        echo '<p>Podpowiedź użyta: '.($row['was_hinted'] ? 'Tak' : 'Nie').'</p>';
        echo '</div>';
    }
    echo '<form action="results.php" method="post">';
    echo '<input type="hidden" name="id" value="'.$attempt_id.'">';
    echo '<button type="submit" class="back-button">Powrót</button>';
    echo '</form>';
    echo '</div>';
    
} else {
    echo 'Nieprawidłowe zapytanie.';
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/results_show.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script> 	
    <script src="js/hint.js"></script>
</head>
<body>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const quizContainers = document.querySelectorAll('.quiz-container');

    quizContainers.forEach(container => {
        const correctAnswer = container.querySelector('input[type="radio"]:checked.checked');
        const incorrectAnswer = container.querySelector('input[type="radio"]:checked.incorrect');

        if (correctAnswer) {
            container.classList.add('correct-container');
        } else if (incorrectAnswer) {
            container.classList.add('incorrect-container');
        }
    });
});
</script>

</body>
</html>
