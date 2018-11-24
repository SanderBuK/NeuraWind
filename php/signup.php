<?php
    require_once('connect_db.php');
    
    $name = $_POST["name"];
    $mail = $_POST["mail"];
    $userPassword = $_POST["password"];

    if($mail == "" || $userPassword == "" || $name == ""){
        die(header("Location:../signupPage.php?loginFailed=true&reason=blank"));
    }

    $sql = "SELECT username FROM users WHERE email='$mail'";

    if($conn->query($sql) === TRUE){
        echo "Sucess";
    }else{
        echo $conn->connect_error;
    }
    $result = $conn->query($sql);
    $num_rows = $result->num_rows;

    if($num_rows > 0){
        die(header("Location:../signupPage.php?loginFailed=true&reason=exists"));
    }else{
        $sql = "INSERT INTO users (email, password, username, hasdb) 
            VALUES ('" . $mail . "', '" . $userPassword . "', '" . $name . "', " . 0 . ")";
        if($conn->multi_query($sql) === TRUE){
            
            //Used to retrieve information about the user on the home.php page.
            $sqlUser_id = "SELECT user_id FROM users WHERE email='$mail'";
            $resultUser_id = $conn->query($sqlUser_id);
            $user_id = $resultUser_id->fetch_assoc()['user_id'];
            session_start();
            $_SESSION['user_id'] = $user_id;

            header("Location:../home.php");
        }else{
            die(header("Location:../signupPage.php?loginFailed=true&reason=error"));
        }
    }

    $conn->close();
?>