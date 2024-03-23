function showRegistration() {
    document.querySelector('.login').style.display = 'none';
    document.querySelector('.registration').style.display = 'block';
}

function showLogin() {
    document.querySelector('.registration').style.display = 'none';
    document.querySelector('.login').style.display = 'block';
}
function showCategory(){
    document.querySelector('.category-div').style.display='block';
    document.querySelector('.question-div').style.display='none';
    document.querySelector('.permission-div').style.display='none';
    document.querySelector('.attemps-div').style.display='none';
}
function showQuestions(){
    document.querySelector('.category-div').style.display='none';
    document.querySelector('.question-div').style.display='block';
    document.querySelector('.permission-div').style.display='none';
    document.querySelector('.attemps-div').style.display='none';
}
function showPermissions(){
    document.querySelector('.category-div').style.display='none';
    document.querySelector('.question-div').style.display='none';
    document.querySelector('.permission-div').style.display='block';
    document.querySelector('.attemps-div').style.display='none';
}
function showAttemps(){
    document.querySelector('.category-div').style.display='none';
    document.querySelector('.question-div').style.display='none';
    document.querySelector('.permission-div').style.display='none';
    document.querySelector('.attemps-div').style.display='block';
}