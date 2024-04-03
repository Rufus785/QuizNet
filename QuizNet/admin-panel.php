<link rel="stylesheet" href="admin-panel.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<?php
include("config.php");

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
    <p>Jesteś w panelu administracyjnym</p>
    <h1>Witaj ...tutaj nazwa usera.... !</h1>
    <p>Wybierz co chcesz zrobić</p>


    <!-- <div class="header-buttons">
        <button class="category" onclick="showCategory()">Dodaj kategorię</button>
        <button class="question" onclick="showQuestions()">Dodaj pytanie</button>
    </div> -->

    <div class="panel-group">
        <div class="panel-content">
            <div class="category-div">
                <p>Dodaj kategorię pytań</p>
                <form action="admin-panel.php" method="POST">
                    <input type="text" name="kategoria" id="">
                    <button type="submit" class="submit-button">Zatwierdź</button>
                </form>
                <div id="category-div">
                    <h1>Lista dodanych kategorii:</h1>
                    <?php
                    $sql = "SELECT name FROM subjects";
                    $result = $mysqli->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<ul>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<li>" . $row["name"] . "</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "Brak istniejących kategorii.";
                    }
                    ?>
                </div>
            </div>
            <div class="question-div">
                <div class="questions">
                    <label for="category">Wybierz kategorię:</label>
                    <select id="category">
                        <?php
                        $sql = "SELECT name FROM subjects";
                        $result = $mysqli->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
                            }
                        } else {
                            echo '<option value="">Brak kategorii</option>';
                        }
                        ?>
                    </select>
                    <br><br>
                    <label for="text">Dodaj pytanie</label>
                    <input type="text">
                    <p>Podaj poziom trudności:</p>
                    <div class="difficulty">
                        <label><input type="radio" name="difficulty"> <p>Łatwy</p></label>
                        <label><input type="radio" name="difficulty"> <p>Średni</p></label>
                        <label><input type="radio" name="difficulty"> <p>Trudny</p></label>
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
                <td></td>
            </tr>
            <tr>
                <td><input type="text" name="odpowiedz4"></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>



                <button class="submit">Zatwierdź</button>
            </div>
        </div>
    </div>
</div>

<script src="script.js"></script>