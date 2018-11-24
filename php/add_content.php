<?php
    require_once("with_user_project_id.php");

    $type = $_GET['type'];

    $sqlProjectpath = "SELECT projectpath FROM user" . $user_id . "table WHERE project_id=" . $project_id;
    $resultProjectpath = $conn->query($sqlProjectpath);
    $projectpath = $resultProjectpath->fetch_assoc()['projectpath'];

    switch ($type) {
        case 'Add text box':
            $sqlAddContent = "INSERT INTO " . $projectpath . " (type, title, content) VALUES ('text', 'New Text', 'Add your text here!')";
            break;
        case 'Add draw box (Comming soon)':
            echo "memes2";
            break;
        default:
            header("Location:load_project.php?project_id=" . $project_id);
            break;
    }

    mysqli_query($conn, $sqlAddContent);

    header("Location:load_project.php?project_id=" . $project_id);

    $conn->close();
?>