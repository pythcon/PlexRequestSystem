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
$id            = filter_input(INPUT_POST, 'id');
$firstName     = filter_input(INPUT_POST, 'firstName');
$type          = filter_input(INPUT_POST, 'type');
$name          = filter_input(INPUT_POST, 'media');
$dateCreated   = filter_input(INPUT_POST, 'dateCreated');
$dateCompleted = filter_input(INPUT_POST, 'dateCompleted');
$notes         = filter_input(INPUT_POST, 'notes');

if (empty($firstName)){
    $firstName = '';
}
if (empty($type)){
    $type = '';
}
if (empty($name)){
    $name = '';
}
if (empty($dateCreated)){
    $dateCreated = NULL;
}
if (empty($dateCompleted)){
    $dateCompleted = NULL;
}
if (empty($notes)){
    $notes = '';
}

//check if request already in system
if (updateRequest($id, $firstName, $type, $name, $dateCreated, $dateCompleted, $notes)){
    redirectToAdminRequests('Request updated.');
}else{
    redirect('Something went wrong. Please try again.');
}


?>