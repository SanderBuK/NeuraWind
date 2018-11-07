<<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Logging in, please wait</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <?php
        $servername="localhost";
        $username="root";
        $password="";
        $dbname="neurawind";

        $mail = $_POST["mail"];
        $userPassword = $_POST["password"];

        $conn = new mysqli($servername, $username, $password, $dbname);

        if($conn->connect_error){
            die("død");
        }

        $sql = "SELECT password FROM users WHERE email='$mail'";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            $information = $result->fetch_assoc();
            if($userPassword == $information['password']){
                header("Location:home.html");
            }else{
                header("Location:index.html");
            }
        }else{
            header("Location:index.html");
        }

        
        $conn->close();
    ?>
</html>