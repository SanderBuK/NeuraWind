<?php
    require_once('connect_db.php');

    $mail = $_POST["mail"];
    $userPassword = $_POST["password"];

    if($mail == "" || $userPassword == ""){
        die(header("Location:../loginPage.php?loginFailed=true&reason=blank"));
    }

    //Used to retrieve information about the user on the home.php page.
    $sqlUser_id = "SELECT user_id FROM users WHERE email='$mail'";
    $resultUser_id = $conn->query($sqlUser_id);
    $user_id = $resultUser_id->fetch_assoc()['user_id'];
    session_start();
    $_SESSION['user_id'] = $user_id;
    
    $sql = "SELECT * FROM users WHERE email='$mail'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $information = $result->fetch_assoc();
        if($userPassword == $information['password']){
            header("Location:home.php");
        }else{
            die(header("Location:../loginPage.php?loginFailed=true&reason=password"));
        }
    }else{
        die(header("Location:../loginPage.php?loginFailed=true&reason=error"));
    }

    $conn->close();
?>