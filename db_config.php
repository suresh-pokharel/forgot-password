<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'loginmanager';
$dbconfig = mysqli_connect($host,$username,$password,$database) or die("An Error occured when connecting to the database");
?>