<?php
    require_once("with_user_project_id.php");
    
    $projectTitle = $_GET['title'];

    $sqlUpdateTitle = "UPDATE user" . $user_id . "table SET title='" . $projectTitle . "' WHERE project_id=" . $project_id;
    mysqli_query($conn, $sqlUpdateTitle);

    $sqlGetProjectpath = "SELECT projectpath FROM user" . $user_id . "table WHERE project_id=" . $project_id;
    $resultProjectpath = $conn->query($sqlGetProjectpath);
    $projectpath = $resultProjectpath->fetch_assoc()['projectpath'];

    $sqlEmptyTable = "TRUNCATE TABLE " . $projectpath;
    mysqli_query($conn, $sqlEmptyTable);

    //Count is how many notewindows there are eg. 3 if there are two text windows and 1 draw window.
    $count = $_GET['count'];
    for($i = 0; $i < $count; $i++){
        $title = $_GET['title' . $i];
        $content = $_GET['content' . $i];
        $sqlInsert = "INSERT INTO " . $projectpath . " (type, title, content) VALUES ('text', '" . $title . "', '" . $content . "')";
        mysqli_query($conn, $sqlInsert);
    }

    header("Location:load_project.php?project_id=" . $project_id);

    $conn->close();
?>