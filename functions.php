<?php

function redirect($message){
    echo"
    <script>
        alert(\"".$message."\");
        window.location.replace(\"index.html\");
    </script>";
    exit();
}

function redirectToRequests($message){
    echo"
    <script>
        alert(\"".$message."\");
        window.location.replace(\"requests.php\");
    </script>";
    exit();
}

function redirectToAdminRequests($message){
    echo"
    <script>
        alert(\"".$message."\");
        window.location.replace(\"admin.php\");
    </script>";
    exit();
}

//DBBBBBB
try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    redirect('Database Error.');
    exit();
}
//DBBBBBB

function addRequest($firstName, $type, $name){
    global $db;

    $sql = "INSERT INTO requests(firstName, type, name, created) VALUES (:firstName, :type, :name, NOW())";
    $q = $db->prepare($sql);

    $q->bindValue(':firstName', $firstName);
    $q->bindValue(':type', $type);
    $q->bindValue(':name', $name);
    
    if($q->execute() === false){
        $q->closeCursor();
        return false;
    }else{
        $q->closeCursor();
        return true;
    }
}

function getRequests(){
    global $db;
    $out = "";
    
    $sql = "SELECT * FROM requests ORDER BY created DESC";
    $statement = $db->prepare($sql);

    $statement->execute();
    $requests = $statement->fetchAll();

    foreach ($requests as $row){
        if (!empty($row['notes']) && empty($row['completed'])){
            $out .= "<tr class='table-warning'>";
        }else if(empty($row['completed'])){
            $out .= "<tr class='table-danger'>";
        }else{
            $out .= "<tr class='table-success'>";
        }
        $out .= "<td>".$row['firstName']. "</td>";
        $out .= "<td>".$row['type']."</td>";
        $out .= "<td>".$row['name']."</td>";
        $out .= "<td>".date('F j, Y g:i a', strtotime($row['created']))."</td>";

        if (!empty($row['completed'])){
            $out .= "<td>".date('F j, Y g:i a', strtotime($row['completed']))."</td>";
        }else{
            $out .= "<td>&nbsp;</td>";
        }

        $out .= "<td>".$row['notes']."</td>";

        $out .= "</tr>";
    }

    return $out;
}

function requestAlreadySubmitted($name){
    global $db;
    
    $sql = "SELECT * FROM requests";
    $statement = $db->prepare($sql);

    $statement->execute();
    $requests = $statement->fetchAll();

    foreach ($requests as $row){
        if (strtolower($row['name']) == strtolower($name)){
            return true;
        }
    }

    return false;
}

function validate_login($username, $password){
    global $db;
    
    $query = "SELECT * FROM accounts WHERE username=:username";
    $statement = $db->prepare($query);
    
    $statement->bindValue(':username', $username);
    $statement->execute();
    
    $account = $statement->fetchAll();
    
    if (!password_verify($password, $account[0]['password'])){
        return false;
    }else{
        $_SESSION['logged']    = true;
        $_SESSION['lastAction']= time();

        return true;
    }
}

function gatekeeper(){
    if (!isset($_SESSION['logged'])){
        return false;
    }
    if (!$_SESSION['logged']){
        return false;
    }
    return true;
}


function getAdminRequests(){
    global $db;
    $out = "";
    
    $sql = "SELECT * FROM requests ORDER BY created DESC";
    $statement = $db->prepare($sql);

    $statement->execute();
    $requests = $statement->fetchAll();

    foreach ($requests as $row){
        if (!empty($row['notes']) && empty($row['completed'])){
            $out .= "<tr class='table-warning'>";
        }else if(empty($row['completed'])){
            $out .= "<tr class='table-danger'>";
        }else{
            $out .= "<tr class='table-success'>";
        }
        $out .= "<td>".$row['firstName']. "</td>";
        $out .= "<td>".$row['type']."</td>";
        $out .= "<td>".$row['name']."</td>";
        $out .= "<td>".date('F j, Y g:i a', strtotime($row['created']))."</td>";

        if (!empty($row['completed'])){
            $out .= "<td>".date('F j, Y g:i a', strtotime($row['completed']))."</td>";
        }else{
            $out .= "<td>&nbsp;</td>";
        }

        $out .= "<td>".$row['notes']."</td>";
        $out .= "<td><button type='button' class='btn btn-outline-danger' onclick='window.location.replace(\"request.php?id=".$row['id']."\");'>edit</button></td>";

        $out .= "</tr>";
    }

    return $out;
}

function getRequestInfo($id){
    global $db;
    
    $sql = "SELECT * FROM requests WHERE id=:id";
    $statement = $db->prepare($sql);

    $statement->bindValue(':id', $id);
    $statement->execute();
    $out = $statement->fetchAll();

    return [$out[0]['firstName'], $out[0]['type'], $out[0]['name'], $out[0]['created'], $out[0]['completed'], $out[0]['notes']];
}

function updateRequest($id, $firstName, $type, $name, $dateCreated, $dateCompleted, $notes){
    global $db;

    $sql = "UPDATE requests SET firstName=:firstName, type=:type, name=:name, created=:dateCreated, completed=:dateCompleted, notes=:notes WHERE id=:id";
    $q = $db->prepare($sql);

    $q->bindValue(':id', $id);
    $q->bindValue(':firstName', $firstName);
    $q->bindValue(':type', $type);
    $q->bindValue(':name', $name);
    $q->bindValue(':dateCreated', $dateCreated);
    $q->bindValue(':dateCompleted', $dateCompleted);
    $q->bindValue(':notes', $notes);
    
    if($q->execute() === false){
        $q->closeCursor();
        return false;
    }else{
        $q->closeCursor();
        return true;
    }
}

function completeRequest($id){
    global $db;

    $sql = "UPDATE requests SET completed=NOW() WHERE id=:id";
    $q = $db->prepare($sql);

    $q->bindValue(':id', $id);
    
    if($q->execute() === false){
        $q->closeCursor();
        return false;
    }else{
        $q->closeCursor();
        return true;
    }
}

?>