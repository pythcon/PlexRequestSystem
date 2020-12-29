<?php
session_start();
include('../account.php');
include('../functions.php');

//DBBBBBB
try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    testMessage('Database Error.');
    exit();
}
//DBBBBBB

if (!gatekeeper()){
    redirect("You are not logged in!");
}
$id = filter_input(INPUT_GET, 'id');

//check if request already in system
if (completeRequest($id)){
    redirectToAdminRequests('Request updated.');
}else{
    redirect('Something went wrong. Please try again.');
}


?>