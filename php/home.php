<!DOCTYPE html>
<html>
    <?php 
        require_once('connect_db.php');

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $usermail = $_SESSION['usermail'];
        global $information;

        $sql = "SELECT * FROM users WHERE email='$usermail'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $information = $result->fetch_assoc();
        }
    ?>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>NeuraWind</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="../stylesheet/home.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="../scripts/neurawind.js" /></script>
    </head>
    <body>
        <form action="../index.html">
            <input type="submit" value="Log ud">
        </form>
        <div class="header">
            <h1 style="text-align: center">
                NeuraWind
            </h1>
        </div>
        <div class="sidebar">
            <table>
                <tr>
                    <td><h3><?php echo($information['username'] . "'s ") ?>Projects</h3></td>
                </tr>
            <?php
                if($information['hasdb'] == null || $information['hasdb'] == 0){
                    $sql = "CREATE TABLE user" . $information['user_id'] . "table (project_id int NOT NULL AUTO_INCREMENT, title VARCHAR(50), text VARCHAR(8000) DEFAULT '', PRIMARY KEY (project_id))";
                    if(mysqli_query($conn, $sql)){
                        $sql ="UPDATE users SET hasdb='1' WHERE email='" . $information['email'] . "'";
                        mysqli_query($conn, $sql);
                    }
                }else{
                    $sql = "SELECT * FROM user" . $information['user_id'] . "table";

                    $projectdata = $conn->query($sql);
                    while($project = mysqli_fetch_assoc($projectdata)){
                        echo "<tr onclick='changeProject(" . json_encode($project['title']) . ", " . json_encode($project['text']) . ", " . $project['project_id'] . ");'>";
                        echo "<td class='project'>" . $project['title'] . "</td>";
                        echo "</tr>";
                    }
                }

                $conn->close();
            ?>
            </table>
            <button onclick="addProject()">Create new project</button>
        </div>
        <div class="content">
            <form action="javascript:saveProject()" id="project" method="GET">
                <div style="text-align: center">
                    <input id="project_title" style="font-size:20px" type="text" name="title" />
                    <br><br>
                    <textarea form="project" name="text" style="width:80%; height=100px" id="project_text">Select a project!</textarea>
                </div>
                <br>
                <input name='save' type="submit" value="Gem">
            </form>
        </div>
    </body>
</html>