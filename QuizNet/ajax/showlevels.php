<?php
    include ("../config.php");
    
    $sql_pass_check = "SELECT * FROM attempts WHERE user_id = '{$_SESSION['user_id']}' AND subject_id = '{$_GET['id']}'";
    $result = $mysqli -> query($sql_pass_check);
    //Sprawdzam jaki poziom zaliczony
    while ($row = $result->fetch_assoc()){
        if ($row['level'] >= 0 and $row['end_time']) {                   //Trzeba będzie zrobić sprawdzenie nie przez end_time, a przez coś innego
            if      ($row['level'] == 0) { $next_level = 1; }
            else if ($row['level'] == 1) { $next_level = 2; break; }
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