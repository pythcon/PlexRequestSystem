<?php
session_start();
include ('../account.php');
include ('../functions.php');

$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');

if (!validate_login($username, $password)){
	redirect("Incorrect Credentials.");
}

header("Location: admin.php");

?>