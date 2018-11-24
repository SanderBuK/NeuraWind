<?php
    require_once("with_user_project_id.php");

    $sqlDeleteProject = "DROP TABLE user" . $user_id . "project" . $project_id;
    mysqli_query($conn, $sqlDeleteProject);

    $sqlRemoveProject = "DELETE FROM user" . $user_id . "table WHERE project_id = " . $project_id;
    mysqli_query($conn, $sqlRemoveProject);

    header("Location:home.php");

    $conn->close();
?>