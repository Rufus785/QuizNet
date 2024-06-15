<?php
    include ("../config.php");

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
        $return = (($correctAnswers/$totalQuestions) >= 5/10) ? true : false;

    
        return $return;
    }
    
    $sql_pass_check = "SELECT * FROM attempts WHERE user_id = '{$_SESSION['user_id']}' AND subject_id = '{$_GET['id']}'";
    $result = $mysqli -> query($sql_pass_check);
    //Sprawdzam jaki poziom zaliczony
    $next_level = 0;
    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc()){
            if ($row['level'] >= 0 and $row['end_time'] and getTestResult($row['id'], $mysqli)) {                   //Trzeba będzie zrobić sprawdzenie nie przez end_time, a przez coś innego
                if      ($row['level'] == 0) { $next_level = 1; }
                else if ($row['level'] == 1) { $next_level = 2; break; }
            }
        }
    }

    


    //Niezależnie od zaliczenia wyświetlam poziom łatwy

    echo '
    <label class="difficulty-option">
        <input type="radio" name="difficulty" value="0"> Łatwy
    </label>';

    if ($next_level >= 1) {
        echo '
        <label class="difficulty-option">
            <input type="radio" name="difficulty" value="1"> Średni
        </label>';
    }

    if ($next_level == 2) {
        echo '
        <label class="difficulty-option">
            <input type="radio" name="difficulty" value="2"> Trudny
        </label>';
    }
    
?>