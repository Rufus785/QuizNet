function setCategoryId(id) {
    document.getElementById('category_id').value = id;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        document.getElementById("difficulties").innerHTML = this.responseText;

        const difficultyOptions = document.querySelectorAll(".difficulty-option");
        difficultyOptions.forEach(option => {
            option.addEventListener("click", function() {
                difficultyOptions.forEach(option => {
                    option.classList.remove("active-difficulty");
                });
                this.classList.add("active-difficulty");
            });
        });
    }
    xhttp.open("GET", "ajax/showlevels.php?id=" + id);
    xhttp.send();
}

