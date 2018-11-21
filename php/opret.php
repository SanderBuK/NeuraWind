<?php
    require_once('connect_db.php');
    
    $name = $_POST["name"];
    $mail = $_POST["mail"];
    $userPassword = $_POST["password"];

    //Used to retrieve information about the user on the home.php page.
    session_start();
    $_SESSION['usermail'] = $mail;

    $sql = "SELECT username FROM users WHERE email='$mail'";

    if($conn->query($sql) === TRUE){
        echo "Sucess";
    }else{
        echo $conn->connect_error;
    }
    $result = $conn->query($sql);
    $num_rows = $result->num_rows;

    if($num_rows > 0){
        header("Location:../opret.html");
    }else{
        $sql = "INSERT INTO users (email, password, username, hasdb) 
            VALUES ('" . $mail . "', '" . $userPassword . "', '" . $name . "', " . 0 . ")";
        if($conn->multi_query($sql) === TRUE){
            header("Location:home.php");
        }else{
            header("Location:../opret.html");
        }
    }

    $conn->close();
?>