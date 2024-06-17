<?php
 
$mysqli = new mysqli("localhost","root","1010","quiz");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
 
function codepass($password) {
    return sha1(md5($password).'#!%Rgd64');
}

session_start();

if(!isset($_SESSION['logged'])) {
    $_SESSION['logged'] = false;
    $_SESSION['user_id'] = -1;
}

foreach ($_GET as $key => $value) {
    if (is_array($value)) {
        foreach ($value as $subkey => $subvalue) {
            $_GET[$key][$subkey] = $mysqli->real_escape_string($subvalue);
        }
    } else {
        $_GET[$key] = $mysqli->real_escape_string($value);
    }
}

foreach ($_POST as $key => $value) {
    if (is_array($value)) {
        foreach ($value as $subkey => $subvalue) {
            $_POST[$key][$subkey] = $mysqli->real_escape_string($subvalue);
        }
    } else {
        $_POST[$key] = $mysqli->real_escape_string($value);
    }
}

?>