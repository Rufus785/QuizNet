<?php
    include("config.php");
?>
<link rel="stylesheet" href="./css/questions.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>


<?php
    if($_SESSION['logged']) {
        $sql = "SELECT COUNT(*) AS row_count FROM questions WHERE level_id = '{$_POST['difficulty']}' AND subject_id = '{$_POST['category']}'";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();

        $expectedRowCount = 10;

        if ($row['row_count'] == $expectedRowCount) {
            $sql = "SELECT * FROM questions WHERE level_id = '{$_POST['difficulty']}' AND subject_id = '{$_POST['category']}'";
            $result = $mysqli -> query($sql);
            $row = $result -> fetch_all(MYSQLI_ASSOC);
    
            // Tworzymy nowy ciąg z losowymi zapisami z bazy
            $random_row = array();
            while (count($random_row) < 10) {
                $randomElement = $row[array_rand($row)];
                
                if (!in_array($randomElement, $random_row)) {
                    $random_row[] = $randomElement;
                }
            }
    
            shuffle($random_row);
    
            for ($i = 0; $i < 10; $i++) {
                echo '
                    <div class="content">
                        <div class="quiz-container">
                            <h1>Pytanie '.($i+1).'</h1>
                            <p>'.$random_row[$i]['question'].'</p>
                                <div class="options">
                                    ';
                for ($j = 0; $j < 4; $j++) {
                    echo '      <label for="option'.($i*4+$j).'"><input type="radio" id="option'.($i*4+$j).'" name="answer'.($i+1).'" value="'.($j+1).'">'.$random_row[$i]['answer_'.($j+1).''].'</label><br>';
                }
                echo '
                                </div>
                                <button type="submit">Potwierdź odpowiedź</button>
                            </form>
                            <button class="hint-button">Podpowiedź</button>
                        </div>
                    </div>
                ';
            }
        }
    }
?>

<!-- test -->

<!-- <div class="content">
    <div class="quiz-container">
        <h1>Pytanie 1</h1>
        <p>To jest treść pytania. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, sit?</p>
            <div class="options">
                <label for="optionA"><input type="radio" id="optionA" name="answer" value="A"> Odpowiedź A</label><br>
                <label for="optionB"><input type="radio" id="optionB" name="answer" value="B"> Odpowiedź B</label><br>
                <label for="optionC"><input type="radio" id="optionC" name="answer" value="C"> Odpowiedź C</label><br>
                <label for="optionD"><input type="radio" id="optionD" name="answer" value="D"> Odpowiedź D</label><br>
            </div>
            <button type="submit">Potwierdź odpowiedź</button>
        </form>
        <button class="hint-button">Podpowiedź</button>
    </div>
</div> -->
