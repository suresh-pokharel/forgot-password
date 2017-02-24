<?php 
		session_start();
		session_destroy();
		//session_unset($_SESSION['login_user']);
		header('location:index.php');
 ?>