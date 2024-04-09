function edit_subject(id) {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		document.getElementById("question_edit").innerHTML = "";
	//	document.getElementById("question_edit_info").innerHTML = "";
	document.getElementById("subject_edit").innerHTML = this.responseText;
	}
	xhttp.open("GET", "ajax/getsubject.php?id="+id);
	xhttp.send();
}

function delete_subject(id) {
	var confirmation = window.confirm("Czy na pewno chcesz to zrobić?");
	
	if (confirmation) {
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function() {
		document.getElementById("subject_edit").innerHTML = this.responseText;
		show_subjects();
		}
		xhttp.open("GET", "ajax/deletesubject.php?id="+id);
		xhttp.send();
	} else {
		alert("To co zawracasz gitare :)");
	}
}

function show_subjects() {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
	document.getElementById("subject_list").innerHTML = this.responseText;
	}
	xhttp.open("GET", "ajax/showsubjects.php");
	xhttp.send();
}

function change_subject_name(id) {
	var input = document.getElementById("nowa-nazwa-kategorii");
	value = input.value;
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
	document.getElementById("subject_edit").innerHTML = this.responseText;
	edit_subject(id);
	show_subjects();
	}
	xhttp.open("GET", "ajax/changesubname.php?id="+id+"&value="+value);
	xhttp.send();
}

function delete_question(id, subject_id) {
	var confirmation = window.confirm("Czy na pewno chcesz to zrobić?");
	
	if (confirmation) {
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function() {
		document.getElementById("subject_edit").innerHTML = this.responseText;
		edit_subject(subject_id);
		document.getElementById("question_edit").innerHTML = "";
		}
		xhttp.open("GET", "ajax/deletequestion.php?id="+id);
		xhttp.send();
	} else {
		alert("To co zawracasz gitare :)");
	}
}

function get_question(id) {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		document.getElementById("question_edit_info").innerHTML = "";
	document.getElementById("question_edit").innerHTML = this.responseText;
	}
	xhttp.open("GET", "ajax/getquestion.php?id="+id);
	xhttp.send();
}

function change_question(id, subject_id) {
	var input = document.getElementById("nowe_pytanie");
	var nowe_pytanie = input.value;
	var input = document.getElementById("nowy_poziom");
	var nowy_poziom = input.value;
	var input = document.getElementById("nowa_odpowiedz1");
	var nowa_odpowiedz1 = input.value;
	var input = document.getElementById("nowa_odpowiedz2");
	var nowa_odpowiedz2 = input.value;
	var input = document.getElementById("nowa_odpowiedz3");
	var nowa_odpowiedz3 = input.value;
	var input = document.getElementById("nowa_odpowiedz4");
	var nowa_odpowiedz4 = input.value;
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
	document.getElementById("question_edit_info").innerHTML = this.responseText;
	edit_subject(subject_id);
	}
	xhttp.open("GET", "ajax/changequestion.php?id="+id+"&nowe_pytanie="+nowe_pytanie+"&nowy_poziom="+nowy_poziom+"&nowa_odpowiedz1="+nowa_odpowiedz1+"&nowa_odpowiedz2="+nowa_odpowiedz2+"&nowa_odpowiedz3="+nowa_odpowiedz3+"&nowa_odpowiedz4="+nowa_odpowiedz4);
	xhttp.send();
}

function add_question() {
	var input = document.getElementById("pytanie");
	var nowe_pytanie = input.value;
	var input = document.getElementById("poziom");
	var nowy_poziom = input.value;
	var input = document.getElementById("odpowiedz1");
	var nowa_odpowiedz1 = input.value;
	var input = document.getElementById("odpowiedz2");
	var nowa_odpowiedz2 = input.value;
	var input = document.getElementById("odpowiedz3");
	var nowa_odpowiedz3 = input.value;
	var input = document.getElementById("odpowiedz4");
	var nowa_odpowiedz4 = input.value;
	var input = document.getElementById("category");
	var subject = input.value;
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
	document.getElementById("subject_edit").innerHTML = this.responseText;
	}
	xhttp.open("GET", "ajax/addquestion.php?nowe_pytanie="+nowe_pytanie+"&nowy_poziom="+nowy_poziom+"&nowa_odpowiedz1="+nowa_odpowiedz1+"&nowa_odpowiedz2="+nowa_odpowiedz2+"&nowa_odpowiedz3="+nowa_odpowiedz3+"&nowa_odpowiedz4="+nowa_odpowiedz4+"&subject="+subject);
	xhttp.send();
}

function add_subject() {
    var input = document.getElementById("nazwa-nowej-kategorii");
    var nazwaNowejKategorii = input.value;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("subject_add_info").innerHTML = this.responseText;
        show_subjects();
    }
    xhttp.open("GET", "ajax/addsubject.php?value=" + nazwaNowejKategorii);
    xhttp.send();
}

function Show(what) {
    var elem = document.getElementById(what);
    elem.style.display = 'block';
}