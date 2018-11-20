<?php
    require_once("connect_db.php");

    $title = $_GET['title'];
    $text = $_GET['text'];
    $project_num = $_GET['num'];

    session_start();
    $mail = $_SESSION['usermail'];

    $sql = "SELECT user_id FROM users WHERE email='$mail'";
    //$sql = "CREATE TABLE "'usermemetable'" (project_id int NOT NULL AUTO_INCREMENT, title VARCHAR(50), text VARCHAR(8000), PRIMARY KEY (project_id))";

    $result = $conn->query($sql);

    $information = $result->fetch_assoc();
    $sql1 = "UPDATE user" . $information['user_id'] . "table SET title='" . $title . "', text='" . $text . "' WHERE project_id=" . $project_num;

    mysqli_query($conn, $sql1);

    header("Location:home.php");

    $conn->close();
?>