function getHint(questionId, attemptId) {
    // Tworzymy nowy obiekt XMLHttpRequest
    const xhttp3 = new XMLHttpRequest();

    // Ustawiamy funkcję, która zostanie wywołana po otrzymaniu odpowiedzi z serwera
    xhttp3.onload = function () {

    };

    // Otwieramy połączenie z plikiem PHP i wysyłamy żądanie GET z odpowiednimi parametrami
    xhttp3.open("GET", "ajax/updatehints.php?id=" + attemptId + "&q_id=" + questionId);
    xhttp3.send();  

    var key = 0; // Inicjalizujemy zmienną przechowującą indeks inputa

    // Pętla iterująca przez wszystkie inputy
    while (document.getElementById('option' + key + '_' + questionId)) {
        // Wewnątrz pętli tworzymy funkcję zamykającą, aby zachować wartość inputValue
        (function() {
            var inputId = 'option' + key + '_' + questionId; // Ustawiamy id aktualnego inputa
            var input = document.getElementById(inputId); // Pobieramy element inputa
            var inputValue = input.value; // Pobieramy wartość z inputa

            // Tworzymy nowy obiekt XMLHttpRequest
            const xhttp = new XMLHttpRequest();
            
            // Ustawiamy funkcję, która zostanie wywołana po otrzymaniu odpowiedzi z serwera
            xhttp.onload = function () {
                // Jeśli odpowiedź z serwera to "1", wyświetlamy alert
                if (this.responseText === "1") {
                    hideLabel(inputId);
                    hideHintButton(questionId);      
                }
            };

            // Otwieramy połączenie z plikiem PHP i wysyłamy żądanie GET z odpowiednimi parametrami
            xhttp.open("GET", "ajax/checkanswer.php?id=" + questionId + "&answer=" + inputValue);
            xhttp.send();
        })(); // Wywołujemy funkcję zamykającą natychmiast, aby zachować wartość inputValue

        key++; // Zwiększamy indeks dla następnego inputa
    }

    // Tworzymy nowy obiekt XMLHttpRequest
    const xhttp2 = new XMLHttpRequest();

    // Ustawiamy funkcję, która zostanie wywołana po otrzymaniu odpowiedzi z serwera
    xhttp2.onload = function () {
        if(this.responseText === "3") hideHintButton("all");
    };

    // Otwieramy połączenie z plikiem PHP i wysyłamy żądanie GET z odpowiednimi parametrami
    xhttp2.open("GET", "ajax/checkhints.php?id=" + attemptId);
    xhttp2.send();
}


function hideLabel(inputValue) {
    var newValue = inputValue.replace("option", "label");
    if (document.getElementById(newValue)) {
        (document.getElementById(newValue)).style.display = "none";
    }
}

function hideHintButton(id) {
    if(id == "all"){
    // Pobieramy wszystkie przyciski zaczynające się na "hint"
    var buttons = document.querySelectorAll("button[id^='hint']");

    // Iterujemy przez wszystkie przyciski i ukrywamy je
    buttons.forEach(function(button) {
        button.style.display = "none";
    });
    alert("Wykorzystałeś wszystkie podpowiedzi");
}else{
    document.getElementById("hint"+id).style.display="none";
}
}