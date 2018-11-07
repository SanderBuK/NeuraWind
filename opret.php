<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h1 style="text-align: center">
        <?php
            $servername="localhost";
            $username="root";
            $password="";
            $dbname="neurawind";

            $name = $_POST["name"];
            $mail = $_POST["mail"];
            $userPassword = $_POST["password"];

            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if($conn->connect_error){
                die("død");
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
                header("Location:index.html");
            }else{
                $sql = "INSERT INTO users (email, password, username) 
                    VALUES ('" . $mail . "', '" . $userPassword . "', '" . $name . "')";
                
                if($conn->multi_query($sql) === TRUE){
                    header("Location:home.html");
                }else{
                    header("Location:index.html");
                }
            }

            $conn->close();
        ?>
    </h1>
    
</body>
</html>