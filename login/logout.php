<?php
$_SESSION['logged'] = false;
$test = $_SESSION['logged'];
session_destroy();
header("Location: index.html");
?>