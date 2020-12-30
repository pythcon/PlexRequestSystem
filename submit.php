<?php
include('account.php');
include('functions.php');

//DBBBBBB
try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    testMessage('Database Error.');
    exit();
}
//DBBBBBB

$firstName = filter_input(INPUT_POST, 'firstName');
$type      = filter_input(INPUT_POST, 'type');
$name      = filter_input(INPUT_POST, 'media');

if (empty($firstName) || empty($type) || empty($name)){
    redirect('Make sure you filled everything out!');
}

//check if request already in system
if (!requestAlreadySubmitted($name)){
    if (addRequest($firstName, $type, $name)){
        redirectToRequests('Request Submitted.', $firstName);
    }else{
        redirect('Something went wrong. Please try again.');
    }
}else{
    redirect('Request is already in the system!');
}

?>