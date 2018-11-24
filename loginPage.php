<html>
  <head>
      <form action="php/login.php" method="POST">
      <link rel="stylesheet" type="text/css" href="stylesheet/login.css">
  </head>
  <body>
      <a class="btnback" href="index.html">Back Home</a>
      <div class="container" id="container">
        <form>
          <h1 class="section-title">Sign In</h1>
          <div class="form-input">
            <input type="text" name="mail" placeholder="Email">
          </div>
          <div class="form-input">
            <input type="password" name="password" placeholder="Password">
          </div>
            <input type="submit" name='login' value="Log ind" id="btnlogin">
            <!-- The PHP is aligned as it is to make the default value of p = "" -->
            <p style="color: red" id="error"><?php 
              $reasons = array("password" => "Wrong Username or Password!", "blank" => "You have left one or more fields blank!", "error" => "Error logging in!"); 
              if (isset($_GET["loginFailed"])){
                echo $reasons[$_GET["reason"]]; 
              }
            ?></p>
            <script>
              if(document.getElementById('error').textContent != ""){
                document.getElementById('container').style.height = '320px';
              }else{
                document.getElementById('container').style.height = '290px';
              }
            </script>
          <div class="section-title2">
            <a href="signupPage.php">Create an account</a>
          </div>
        </form>
      </div>
  </body>
</html>