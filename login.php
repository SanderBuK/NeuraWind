<?php
    require_once('connect_db.php');

    $mail = $_POST["mail"];
    $userPassword = $_POST["password"];

    //Used to retrieve information about the user on the home.php page.
    session_start();
    $_SESSION['usermail'] = $mail;
    
    $sql = "SELECT * FROM users WHERE email='$mail'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $information = $result->fetch_assoc();
        if($userPassword == $information['password']){
            header("Location:home.php");
        }else{
            header("Location:index.html");
        }
    }else{
        header("Location:index.html");
    }

    $conn->close();
?>