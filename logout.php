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
		session_destroy();
		//session_unset($_SESSION['login_user']);
		header('location:index.php');
 ?>
