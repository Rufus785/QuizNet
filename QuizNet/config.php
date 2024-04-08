<?php
 
$mysqli = new mysqli("localhost","me","1010","quiz");

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

?>