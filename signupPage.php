<html>
<head>
    <form action="php/signup.php" method="POST">
    <link rel="stylesheet" type="text/css" href="stylesheet/signup.css">
</head>
<body>
    <div class="container" id="container">
      <form>
        <h1 class="section-title">Create an account</h1>
        <div class="form-input">
          <input type="text" name="name" placeholder="Name">
        </div>
        <div class="form-input">
            <input type="text" name="mail" placeholder="Email">
        </div>
        <div class="form-input">
            <input type="password" name="password" placeholder="Password">
        </div>
        <input type="submit" name='login' value="Let's go!" id="btnlogin">
        <!-- The PHP is aligned as it is to make the default value of p = "" -->
        <p style="color: red" id="error"><?php 
              $reasons = array("exists" => "User already exists!", "blank" => "You have left one or more fields blank!", "error" => "Error logging in!"); 
                if (isset($_GET["loginFailed"])){
                  echo $reasons[$_GET["reason"]]; 
                }
            ?></p>
          <script>
            if(document.getElementById('error').textContent != ""){
              document.getElementById('container').style.height = '382px';
            }else{
              document.getElementById('container').style.height = '352px';
            }
          </script>
       <div class="section-title2">
         <a href="loginPage.php">Sign in</a>
       </div>
      </form>
    </div>
</body>
</html>