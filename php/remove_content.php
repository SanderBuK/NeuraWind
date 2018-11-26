<?php
    require_once("with_user_project_id.php");
    
    $content_row = $_GET['contentID'];

    $sqlProjectpath = "SELECT projectpath FROM user" . $user_id . "table WHERE project_id=" . $project_id;
    $resultProjectpath = $conn->query($sqlProjectpath);
    $projectpath = $resultProjectpath->fetch_assoc()['projectpath'];

    $sqlGetContent = "SELECT * FROM " . $projectpath;
    $resultContent = $conn->query($sqlGetContent);

    //Get the real content_id from the content on the corresponding row.
    for($i = 1; $i <= intval($content_row); $i++){
        $row = $resultContent->fetch_assoc();
        if($i == intval($content_row)){
            $content_id = $row['content_id'];
        }
    }

    $sqlRemoveContent = "DELETE FROM " . $projectpath . " WHERE content_id = " . $content_id;
    mysqli_query($conn, $sqlRemoveContent);

    header("Location:load_project.php?project_id=" . $project_id);

    $conn->close();
?>