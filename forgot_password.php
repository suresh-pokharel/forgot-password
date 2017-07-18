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
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email_reg=mysqli_real_escape_string($dbconfig,$_POST['email']);
    $details=mysqli_query($dbconfig,"SELECT fullname,email FROM user WHERE email='$email_reg'");
    if (mysqli_num_rows($details)>0) { //if the given email is in database, ie. registered
        $message_success=" Please check your email inbox or spam folder and follow the steps";
        //generating the random key
        $key=md5(time()+123456789% rand(4000, 55000000));
        //insert this temporary key into database
        $sql_insert=mysqli_query($dbconfig,"INSERT INTO forget_password(email,temp_key) VALUES('$email_reg','$key')");
        //sending email about update
        $to      = $email_reg;
        $subject = 'Changing password DEMO- psuresh.com.np';
        $msg = "Please copy the link and paste in your browser address bar". "\r\n"."www.psuresh.com.np/misc/forgot-password-php/forgot_password_reset.php?key=".$key."&email=".$email_reg;
        $headers = 'From:Gentle Heart Foundation' . "\r\n";
        mail($to, $subject, $msg, $headers);
    }
    else{
        $message="Sorry! no account associated with this email";
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <title>Forgot Password</title>
  </head>
  <body>
    <div class="container">
      <div class="row"><br><br><br>
        <div class="col-md-4"></div>
        <div class="col-md-4" style="background-color: #D2D1D1; border-radius:15px;">
          <br><br>
          <form role="form" method="POST">
            <div class="form-group">
              <label>Please enter your email to recover your password</label><br><br>
              <input  class="form-control" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" placeholder="Email" >
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
              <button type="submit" class="btn btn-primary pull-right" name="submit" style="display: block; width: 100%;">Send Email</button>
              <br><br>
              <center><a href="index.php">Back to Login</a></center>
              <br>
          </form>
        </div>
        <div class="col-md-4"><br><br>
          <h4>Forgot Password DEMO</h4><p>Feel free to create account with your valid email and try changing your password. We do nothing with your email.</p>
          <a href="https://github.com/suresh021/forgot-password">Find at Github</a>
        </div>
      </div>
    </div>
  </body>
</html>
