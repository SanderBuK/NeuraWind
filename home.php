<!DOCTYPE html>
<html>
    <?php 
        require_once('php/connect_db.php');

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $user_id = $_SESSION['user_id'];
        global $information;

        $sql = "SELECT * FROM users WHERE user_id='$user_id'";
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
        <link rel="stylesheet" type="text/css" media="screen" href="stylesheet/home.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="stylesheet/modal.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="scripts/projectManager.js" /></script>
    </head>
    <body>
        <form action="index.html">
            <input type="submit" value="Sign Out">
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
                    $sql = "CREATE TABLE user" . $information['user_id'] . "table (project_id int NOT NULL AUTO_INCREMENT, title VARCHAR(50), projectpath VARCHAR(50), PRIMARY KEY (project_id))";
                    if(mysqli_query($conn, $sql)){
                        $sql ="UPDATE users SET hasdb='1' WHERE email='" . $information['email'] . "'";
                        mysqli_query($conn, $sql);
                    }
                }else{
                    $sql = "SELECT * FROM user" . $information['user_id'] . "table";
                    $projectdata = $conn->query($sql);

                    //If a project that has been shared with you has been deleted, delete it from your user table too.
                    while($project = mysqli_fetch_assoc($projectdata)){
                        $sqlCheckTable = "DELETE FROM user" . $information['user_id'] . "table WHERE project_id =" . $project['project_id'] . " AND NOT EXISTS (SELECT 1 FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = '" . $project['projectpath'] . "')";
                        mysqli_query($conn, $sqlCheckTable);
                    }

                    $sql = "SELECT * FROM user" . $information['user_id'] . "table";
                    $projectdata = $conn->query($sql);

                    while($project = mysqli_fetch_assoc($projectdata)){
                        echo "<tr>";
                        echo "<td onclick='changeProject(" . $project['project_id'] . ");' class='project'>" . $project['title'] . "</td>";
                        echo "<td onclick='removeProject(" . $project['project_id'] . ");' class='project'>Delete</td>";
                        echo "</tr>";
                    }
                }

                $conn->close();
            ?>
            </table>
            <button onclick="addProject()">Create new project</button>
        </div>
        <div class="content">
            <form action="javascript:saveProject(<?php echo $_POST['count'] ?>)" id="project" method="GET">
                <div style="text-align: center">
                    <?php
                        if(!empty($_POST['title'])){
                            $count = $_POST['count'];
                            echo "<input id='project_title' style='font-size:20px' type='text' name='title' placeholder='Select a project!' autocomplete='off'/>";
                            echo "<br><br>";
                            for($i = 0; $i < $count; $i++){
                                echo "<div>";
                                echo "<input id='title" . $i . "' style='font-size:20px' type='text' name='title' placeholder='Write a title!' autocomplete='off'/>";
                                echo "<textarea id='content" . $i . "' form='project' name='text' style='width:40%; height=100px'></textarea>";
                                echo "<p style='border: 1px solid #ccc;
                                display: inline-block;
                                padding: 6px 12px;
                                cursor: pointer;' onclick='removeContents(" . ($i + 1) . ")'>Delete</p>";
                                echo "</div>";
                            }
                            echo "<input style='float: left' name='save' type='submit' value='Save'>";
                        }else{
                            echo "<h1 style='text-align: center'>Select a project!</h1>";
                        }
                    ?>
                </div>
                <br>
                <script type="text/javascript">
                    <?php 
                        //A PHP script that echos the javascript functions. Used to keep track of the $i value fx: content0 and title0 or content1 and title1
                        //TODO: fix error
                        if(!empty($_POST['title'])){
                            echo "document.getElementById('project_title').value ='" . $_POST['title'] . "';";
                            
                            $count = $_POST['count'];
                            for($i = 0; $i < $count; $i++){
                                echo"document.getElementById('title" . $i . "').value ='" . $_POST['title' . $i] . "';";
                                echo"document.getElementById('content" . $i . "').value ='" . $_POST['content' . $i] . "';";
                            }
                        }
                    ?>
                </script>
            </form>
            <?php
                if(!empty($_POST['title'])){
                    echo "<input disabled='disabled' style='float: right' name='addDraw' type='submit' value='Add draw box (Comming soon)' onClick='addContent(this.value)'>";
                    echo "<input style='float: right' name='addText' type='submit' value='Add text box' onClick='addContent(this.value)'>";
                    echo "<br>";
                    echo "<input style='float: left' id='shareBtn' type='submit' value='Share project'>";
                }
            ?>
            <div id="shareModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h3>Search for UniqueID</h3>
                    <form action="javascript:searchShare()">
                        <input type="search" id="search" />
                        <input type="submit" value="Search" />
                    </form>
                    <?php
                        if(!empty($_POST['searchUsername'])){
                            echo "<script>document.getElementById('shareModal').style.display = 'block';</script>";
                            $searchUsername = $_POST['searchUsername'];
                            $searchUser_id = $_POST['searchUser_id'];
                            echo "<hr> <p>Results:</p> <br>";
                            echo "Username: " . $searchUsername . "<br>";
                            echo "<input name='confirmShare' type='submit' value='Share' onClick='shareProject(" . $searchUser_id . ")' >";
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
    <script>
        <?php
            if(!empty($_POST['title'])){
                echo "shareProjectModal();"; //Initialize the sharing modal
            }
        ?>
    </script>
</html>