<?php
    require_once("with_user_project_id.php");

    $searchUser_id = $_GET['searchUser_id'];

    $sqlGetProject = "SELECT * FROM user" . $user_id . "table WHERE project_id=" . $project_id;
    $resultProject = $conn->query($sqlGetProject);
    $project = $resultProject->fetch_assoc();

    $title = $project['title'];
    $projectpath = $project['projectpath'];

    $sqlShareProject = "INSERT INTO user" . $searchUser_id . "table (title, projectpath) SELECT '" . $title . "', '" . $projectpath . "' WHERE NOT EXISTS (SELECT * FROM user" . $searchUser_id . "table WHERE projectpath = '" . $projectpath . "')";
    mysqli_query($conn, $sqlShareProject);

    header("Location:load_project.php?project_id=" . $project_id);

    $conn->close();
?>