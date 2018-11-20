<?php
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="neurawind";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
        die("død");
    }
?>