<?php
/*
      Author  : Suresh Pokharel
      Email   : suresh.wrc@gmail.com
      GitHub  : github.com/suresh021
      URL     : psuresh.com.np
*/ 
?>

<?php 
include("db_config.php");
session_start();
if(!isset($_SESSION['login_user'])) {
    $login_status="true";
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email=mysqli_real_escape_string($dbconfig,$_POST['email']);
        $password=mysqli_real_escape_string($dbconfig,$_POST['password']);
        $password=md5($password); //hashing with md5
        $sql_query="SELECT id,fullname FROM user WHERE email='$email' and password='$password'";
        $result=mysqli_query($dbconfig,$sql_query);
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count=mysqli_num_rows($result);
        //$username=$row['username'];
        $fullname=$row['fullname'];

        // If result matched $username and $password, table row must be 1 row
        if($count==1){    //if login success
            $_SESSION['login_user']=$fullname;    //keep login name in session
            header("location: home.php");
        }
        else{
              $error="Invalid login details";
        }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <title>Login</title>
  </head>
  <body>
    <div class="container">
      <div class="row"><br><br><br>
        <div class="col-md-4"></div>
          <div class="col-md-4" style="background-color: #D2D1D1; border-radius:15px;">
            <br><br>
            <form role="form" method="POST">
                <div class="form-group">
                  <label for="email">Email address:</label>
                  <input  class="form-control" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                </div>
                <div class="form-group">
                  <label for="pwd">Password:</label>
                  <input type="password" class="form-control" id="pwd" name="password">
                </div>
                 <?php if (isset($error)) {
                    echo"<div class='alert alert-danger' role='alert'>
                    <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                    <span class='sr-only'>Error:</span>".$error."</div>";
                  } ?>
                <button type="submit" class="btn btn-primary pull-right" name="submit" style="display: block; width: 100%;">Login</button><br><br>
                <div class="col-md-6">
                  <a href="forgot_password.php">I forgot my password</a>
                </div>
                <div class="col-md-6">
                  <a style="float: right" href="registration.php">Register</a>
                </div>
                <br><br>
            </form>
        </div>
        <div class="col-md-4">
           <br><br><h4>Forgot Password DEMO</h4><p>Feel free to create account with your valid email and try changing your password. We do nothing with your email.</p>
          <a href="https://github.com/suresh021/forgot-password">Find at Github</a>
        </div>
      </div>
    </div>
  </body>
</html>
