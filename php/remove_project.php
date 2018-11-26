<?php
    require_once("with_user_project_id.php");

    $userProjectpath = "user" . $user_id . "project" . $project_id;

    $sqlProjectpath = "SELECT projectpath FROM user" . $user_id . "table WHERE project_id=" . $project_id;
    $resultProjectpath = $conn->query($sqlProjectpath);
    $projectpath = $resultProjectpath->fetch_assoc()['projectpath'];

    echo $projectpath . "   ";
    echo $userProjectpath . "   ";

    //Only fully delete the project, if you are the original creator.
    if($projectpath == $userProjectpath){
        $sqlDeleteProject = "DROP TABLE " . $projectpath;
        mysqli_query($conn, $sqlDeleteProject);
    }

    $sqlRemoveProject = "DELETE FROM user" . $user_id . "table WHERE project_id = " . $project_id;
    mysqli_query($conn, $sqlRemoveProject);

    header("Location:../home.php");

    $conn->close();
?>