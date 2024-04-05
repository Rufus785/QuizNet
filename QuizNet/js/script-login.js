function showRegistration() {
    document.querySelector('.login').style.display = 'none';
    document.querySelector('.registration').style.display = 'block';
}

function showLogin() {
    document.querySelector('.registration').style.display = 'none';
    document.querySelector('.login').style.display = 'block';
}

document.addEventListener("DOMContentLoaded", function() {
    const categoryOptions = document.querySelectorAll(".category-option");
    const difficultyOptions = document.querySelectorAll(".difficulty-option");

    categoryOptions.forEach(option => {
        option.addEventListener("click", function() {
            categoryOptions.forEach(option => {
                option.classList.remove("active-category");
            });
            this.classList.add("active-category");
        });
    });

    difficultyOptions.forEach(option => {
        option.addEventListener("click", function() {
            difficultyOptions.forEach(option => {
                option.classList.remove("active-difficulty");
            });
            this.classList.add("active-difficulty");
        });
    });
});