<?php
    require_once("with_user_project_id.php");
    
    $content_id = $_GET['contentID'];

    $sqlProjectpath = "SELECT projectpath FROM user" . $user_id . "table WHERE project_id=" . $project_id;
    $resultProjectpath = $conn->query($sqlProjectpath);
    $projectpath = $resultProjectpath->fetch_assoc()['projectpath'];

    $sqlRemoveContent = "DELETE FROM " . $projectpath . " WHERE content_id = " . $content_id;

    mysqli_query($conn, $sqlRemoveContent);

    header("Location:load_project.php?project_id=" . $project_id);

    $conn->close();
?>