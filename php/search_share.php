<?php
    require_once("with_user_project_id.php");

    $searchMail = $_GET['search'];

    echo $searchMail;

    $sql = "SELECT user_id, username FROM users WHERE email='" . $searchMail . "'";
    $resultSearch = $conn->query($sql);
    $userInfo = $resultSearch->fetch_assoc();
    $searchUsername = $userInfo['username'];
    $searchUser_id = $userInfo['user_id'];

    header("Location:load_project.php?project_id=" . $project_id . "&searchUser_id=" . $searchUser_id . "&searchUsername=" . $searchUsername);

    $conn->close();
?>