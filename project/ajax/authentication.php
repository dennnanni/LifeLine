<?php

require_once("../bootstrap.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = validate($_POST["username"]);
    $fullname = validate($_POST["fullname"]);
    $email = validate($_POST["email"]);
    $password = validate($_POST["password"]);

    if (empty($username) || empty($fullname) || empty($email) || empty($password)) {
        $errorMessage = "Error! You can't use empty information!";
    }
    else if(!preg_match("/^[a-zA-Z0-9._]*$/",$username)) {
        $errorMessage = "Error! Username can only contain letters, numbers, periods, and underscores!";
    }
    else if(!preg_match("/^[a-zA-Z' ]*$/", $fullname)) {
        $errorMessage = "Error! Name can't contain numbers or special character!";
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Error! Invalid email format!";
    }
    else if (strlen($password) < 6) {
        $errorMessage = "Error! Password must be 6 characters at least!";
    }
    else if($dbh->checkUsername($username)) {
        $errorMessage = "Error! Username already in use!";
    }
    else if($dbh->checkEmail($email)) {
        $errorMessage = "Error! Email already in use!";
    }
    else {
        $registration_result = $dbh->createAccount($username, $fullname, $email, $password);
        if(!$registration_result){
            $errorMessage = "Error while creating the account!";
        }
        else{
            registerUserSession($username, $fullname);
            header("Location: ../photo.php");
            exit();
        }
    }

    echo json_encode(["error" => $errorMessage]);
}

?>