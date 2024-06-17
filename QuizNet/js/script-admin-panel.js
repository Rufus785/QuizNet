
function showCategory() {
    document.querySelector('.panel-content').style.display = 'block';
    document.querySelector('.category-div').style.display = 'block';
    document.querySelector('.question-div').style.display = 'none';
}

function showQuestions() {
    document.querySelector('.panel-content').style.display = 'block';
    document.querySelector('.category-div').style.display = 'none';
    document.querySelector('.question-div').style.display = 'block';
}
// function showPermissions(){
//     document.querySelector('.category-div').style.display='none';
//     document.querySelector('.question-div').style.display='none';
//     document.querySelector('.permission-div').style.display='block';
//     document.querySelector('.attemps-div').style.display='none';
// }
// function showAttemps(){
//     document.querySelector('.category-div').style.display='none';
//     document.querySelector('.question-div').style.display='none';
//     document.querySelector('.permission-div').style.display='none';
//     document.querySelector('.attemps-div').style.display='block';
// }