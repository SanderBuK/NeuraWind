<?php
    require_once("connect_db.php");
    session_start();
    $user_id = $_SESSION['user_id'];
    $project_id = $_GET['project_id'];
?>