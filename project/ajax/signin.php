<?php

require_once("../bootstrap.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = validate($_POST["email"]);
    $password = validate($_POST["password"]);

    if (empty($email) || empty($password)) {
        $errorMessage = "Error! You can't use empty information!";
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Error! Invalid email format!";
    }
    else {
        $login_result = $dbh->login($email, $password);
        if(is_null($login_result)){
            $errorMessage = "Error! Incorrect email or password!"; //Login fallito
        }
        else{
            registerUserSession($login_result["username"], $login_result["name"]);
            sendEmail($email, "New login!", "Dear ".$login_result['name'].",\r\n\r\nWe wanted to inform you that a new login has been made to your account on LifeLine.\r\n\r\nThank you,\r\nThe LifeLine Team.");
        }
        $_SESSION["footerActivePage"] = "home";
    }

    if (isset($errorMessage)) {
        echo json_encode(["error" => $errorMessage]);
    } else {
        echo "success";
    }
}
?>