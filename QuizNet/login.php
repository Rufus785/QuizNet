<!-- To są rzeczy dodane żeby działał Bootstrap (biblioteka odpowiedzialna za responsywność) -->
<link rel="stylesheet" href="styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script> 
<?php include 'navbar.php'; ?>
<!-- Div odpowiedzialny za widocznośc Loginu -->
<div class="login">
<img src="/img/QuizNet.png" alt="Logo">
    <h1>Logowanie</h1>
    <p>Podaj login oraz hasło</p>
    <input type="text" class="login-label" placeholder="Login">
    <input type="password" class="password-label" placeholder="Hasło">
    <div class="confirm-button">
    <button class="confirm">Zaloguj</button>
    </div>
    <!-- Funkcja podmieniająca wyświetlaną zawartość -->
    <p>Nie masz konta? <a href="#" onclick="showRegistration()">Zarejestruj się!</a></p> 
</div>
<div class="registration"> //Div odpowiedzialny za widocznośc rejestracji
    <img src="/img/QuizNet.png" alt="Logo">
<h1>Rejestracja</h1>
    <p>Podaj login oraz hasło</p>
    <input type="text" class="login-label" placeholder="Login">
    <input type="password" class="password-label" placeholder="Hasło">
    <input type="password" class="password-confirm-label" placeholder="Potwierdź hasło">
    <div class="confirm-button">
        <button class="confirm">Zarejestruj</button>
    </div>
    <!-- Funkcja podmieniająca wyświetlaną zawartość -->
    <p>Masz już konto? <a href="#" onclick="showLogin()">Zaloguj się!</a></p> 
</div>
<script src="script.js"></script>