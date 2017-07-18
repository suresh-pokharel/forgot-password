<?php
/*
      Author  : Suresh Pokharel
      Email   : suresh.wrc@gmail.com
      GitHub  : github.com/suresh021
      URL     : psuresh.com.np
*/ 
?>

<?php
	session_start();
	include("db_config.php");
	if(!isset($_SESSION['login_user'])) {
	    header('location:index.php');
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <title>Dashboard</title>
  </head>
  <body>
    <div class="container">
      <div class="row"><br><br><br>
        <div class="col-md-4"></div>
        <div class="col-md-4" style="background-color: #D2D1D1; border-radius:15px;">
          <br><br>
          <h4>Hi <b><?=$_SESSION['login_user']?></b>, Welcome to your dashboard.</h4><br>
          <p>Love is a variety of different feelings, states, and attitudes that ranges from interpersonal affection ("I love my mother") to pleasure ("I loved that meal"). It can refer to an emotion of a strong attraction and personal attachment. Love can also be a virtue representing human kindness, compassion, and affection—"the unselfish loyal and benevolent concern for the good of another". It may also describe compassionate and affectionate actions towards other humans, one's self or animals.</p>
          <p>Click here to <a href="logout.php">logout</a></p>
        </div>
        <div class="col-md-4"><br><br>
          <h4>Forgot Password DEMO</h4><p>Feel free to create account with your valid email and try changing your password. We do nothing with your email.</p>
          <a href="https://github.com/suresh021/forgot-password">Find at Github</a>
        </div>
      </div>
    </div>
  </body>
</html>
