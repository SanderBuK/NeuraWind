<?php
    require_once("connect_db.php");

    session_start();
    $user_id = $_SESSION['user_id'];
    //Get the userID of the current logged in user.

    $sqlInsert = "INSERT INTO user" . $user_id . "table (title, projectpath) VALUES ('New Project', 'undefined')";
    mysqli_query($conn, $sqlInsert);
    //Insert a new project into the users database, with the title "New Project" and a path "undefined".

    $sqlProject_id = "SELECT project_id FROM user" . $user_id . "table WHERE projectpath='undefined'";
    $resultProject_id = $conn->query($sqlProject_id);
    $project_id = $resultProject_id->fetch_assoc()['project_id'];
    //Select the projectid from projects with path as "undefined" (which should only be the most reacently added project)

    $sqlUpdate = "UPDATE user" . $user_id . "table SET projectpath='user" . $user_id . "project" . $project_id . "' WHERE projectpath='undefined'";
    mysqli_query($conn, $sqlUpdate);
    //Update the newly added projects path to it's soon to be created table
    
    $sqlCreate = "CREATE TABLE user" . $user_id . "project" . $project_id . " (content_id int NOT NULL AUTO_INCREMENT, type VARCHAR(20), title VARCHAR(50), content VARCHAR(8000), PRIMARY KEY (content_id))";
    mysqli_query($conn, $sqlCreate);
    //Create the table for the project with values type(text or draw, title and content)

    $sqlAddText = "INSERT INTO user" . $user_id . "project" . $project_id . " (type, title, content) VALUES ('text', 'New Text', 'Add your text here!')";
    mysqli_query($conn, $sqlAddText);
    //Add as default a textbox, with the type: text, title: New Text, content: Add your text here

    //Navigate back to the home page
    header("Location:home.php");

    $conn->close();
?>