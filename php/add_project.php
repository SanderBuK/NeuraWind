<?php
    require_once("connect_db.php");

    session_start();
    $usermail = $_SESSION['usermail'];
    $sql = "SELECT user_id FROM users WHERE email='$usermail'";
    $result = $conn->query($sql);

    $sql = "INSERT INTO user" . $result->fetch_assoc()['user_id'] . "table (title) VALUES ('New Project')";
    
    mysqli_query($conn, $sql);
    
    header("Location:home.php");

    $conn->close();
?>