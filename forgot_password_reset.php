<?php
/*
      Author  : Suresh Pokharel
      Email   : suresh.wrc@gmail.com
      GitHub  : github.com/suresh021
      URL     : psuresh.com.np
*/ 
?>

<?php 
$message="";
$valid='true';
include("db_config.php");
session_start();
if(isset($_GET['key']) && isset($_GET['email'])) {
    $key=$_GET['key'];
    $email=$_GET['email'];
    $check=mysqli_query($dbconfig,"SELECT * FROM forget_password WHERE email='$email' and temp_key='$key'");
    //if key doesnt matches
    if (mysqli_num_rows($check)!=1) {
      echo "This url is invalid or already been used. Please verify and try again.";
      exit;
    }
}
else{
  header('location:index.php');
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
        $password1=mysqli_real_escape_string($dbconfig,$_POST['password1']);
        $password2=mysqli_real_escape_string($dbconfig,$_POST['password2']);
        if ($password2==$password1) {
            $message_success="New password has been set for ".$email;
            $password=md5($password1);
            //destroy the key from table
            mysqli_query($dbconfig,"DELETE FROM forget_password where email='$email' and temp_key='$key'");
            //update password in database
            mysqli_query($dbconfig,"UPDATE user set password='$password' where email='$email'");
        }
        else{
            $message="Verify your password";
        }
}
        
?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <title>Reset Password</title>
  </head>
  <body>
    <div class="container">
      <div class="row"><br><br><br>
        <div class="col-md-4"></div>
        <div class="col-md-4" style="background-color: #D2D1D1; border-radius:15px;">
          <br><br>
          <form role="form" method="POST">
              <label>Please enter your new password</label><br><br>
              <div class="form-group">
                <input type="password" class="form-control" id="pwd" name="password1" placeholder="Password">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="pwd" name="password2" placeholder="Re-type Password">
              </div>
                  <?php if (isset($error)) {
                    echo"<div class='alert alert-danger' role='alert'>
                    <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                    <span class='sr-only'>Error:</span>".$error."</div>";
                    } ?>
                  <?php if ($message<>"") {
                    echo"<div class='alert alert-danger' role='alert'>
                    <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                    <span class='sr-only'>Error:</span>".$message."</div>";
                    } ?>
                  <?php if (isset($message_success)) {
                    echo"<div class='alert alert-success' role='alert'>
                    <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
                    <span class='sr-only'>Error:</span>".$message_success."</div>";
                    } ?>
                <button type="submit" class="btn btn-primary pull-right" name="submit" style="display: block; width: 100%;">Save Password</button>
                <br><br>
                <label>This link will work only once for a limited time period.</label>
                <center> <a href="index.php">Back to Login</a></center>
                <br>
          </form>
        </div>
        <div class="col-md-4">
          <br><br>
          <h4>Forgot Password DEMO</h4><p>Feel free to create account with your valid email and try changing your password. We do nothing with your email.</p>
          <a href="https://github.com/suresh021/forgot-password">Find at Github</a>
        </div>
    </div>
  </body>
</html>
