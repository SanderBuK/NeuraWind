<?php
    require_once("with_user_project_id.php");

    if(isset($_GET['searchUser_id'])){
        $searchUser_id = $_GET['searchUser_id'];
        $searchUsername = $_GET['searchUsername'];
    }

    $sqlTitle = "SELECT title FROM user" . $user_id . "table WHERE project_id=" . $project_id;
    $resultTitle = $conn->query($sqlTitle);
    $title = $resultTitle->fetch_assoc()['title'];

    $sqlProjectpath = "SELECT projectpath FROM user" . $user_id . "table WHERE project_id=" . $project_id;
    $resultProjectpath = $conn->query($sqlProjectpath);
    $projectpath = $resultProjectpath->fetch_assoc()['projectpath'];

    $sqlGetProject = "SELECT * FROM " . $projectpath;
    $resultProjectsql = $conn->query($sqlGetProject);
    // Select the whole project from tha table

    $types = array();
    $titles = array();
    $contents = array();

    while($row = $resultProjectsql->fetch_assoc()){
        array_push($types, $row['type']);
        array_push($titles, $row['title']);
        array_push($contents, $row['content']);
    }
?>

<form id="loadForm" action="../home.php" method="POST">
    <?php // Make a hidden form which sends all the data to the home.php site via POST method
        if(isset($searchUsername)){
            echo "<input type='hidden' name='searchUser_id' value='" . $searchUser_id . "' />";
            echo "<input type='hidden' name='searchUsername' value='" . $searchUsername . "' />";
        }
        echo "<input type='hidden' name='title' value='" . $title . "' />";
        echo "<input type='hidden' name='count' value='" . count($types) . "' />";
        for($i = 0; $i < count($types); $i++){
            echo "<input type='hidden' name='type" . $i . "' value='" . $types[$i] . "' />";
            echo "<input type='hidden' name='title" . $i . "' value='" . $titles[$i] . "' />";
            echo "<input type='hidden' name='content" . $i . "' value='" . $contents[$i] . "' />";
        }
    ?>
    <input style="width: 300px;
    height: 30px;
    color: #fff;
    background-color: rgb(52, 83, 255);
    border-radius: 20px;" type="submit" value="Click here if you haven't been redirected" />
</form>
<script type="text/javascript">
    document.getElementById('loadForm').submit();
</script>