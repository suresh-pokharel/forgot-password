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
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // username and password 
    $email=mysqli_real_escape_string($dbconfig,$_POST['email']);
    $fullname=mysqli_real_escape_string($dbconfig,$_POST['fullname']);
    $password=mysqli_real_escape_string($dbconfig,$_POST['password']); 
    $password=md5($password); // Encrypted Password with md5
    $sql="Insert into user(password,fullname,email) values('$password','$fullname','$email')";
    //echo $sql;
    $result=mysqli_query($dbconfig,$sql);
    $msg="Registered";
    //After 
      
}

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <title>Registration</title>
    </head>
    <body>
        <div class="container">
            <div class="row"><br><br><br>
                <div class="col-md-4"></div>
                <div class="col-md-4" style="background-color: #D2D1D1; border-radius:15px;">
                    <br>
                    <form method="post" action="">
                        <div class="form-group">
                            <input type="text" class="form-control" required="true" placeholder="Full Name" id="fullname" name="fullname" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" required="true" placeholder="Password" id="password" name="password" />
                        </div>
                        <div class="form-group">
                            <input type="text" type= "email" class="form-control" required="true" placeholder="Email" id="email" name="email" />
                        </div>
                        <?php if (isset($msg)) {
                        echo"<div class='alert alert-success' role='alert'>
                            <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                            <span class='sr-only'>Error:</span>".$msg."</div>";
                            } ?>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">Register</button>
                        </div>
                        <center><a href="index.php">Go to login</a></center>
                    </form>
                    <br>  
                </div> 
                <div class="col-md-4">
                  <br><br>
                  <h4>Forgot Password DEMO</h4><p>Feel free to create account with your valid email and try changing your password. We do nothing with your email.</p>
                  <a href="https://github.com/suresh021/forgot-password">Find at Github</a>
                </div>
            </div>
        </div>
    </body>
</html>


