# Forgot Password
Forgot password management using php, sends secret key to associated email

## DEMO
http://projects.psuresh.com.np/forgot-password-php

## Installation
### Step-1
Clone the project and keep in your local server's folder (ie. htdocs).

### step-2
Create a database named 'loginmanager' and import sql file kept inside database. If you want to use your own database name, change in `db_config.php` file. Two tables `user` and `forget_password` are used, You can add or create these tables in your own existing database.

`$host = 'localhost'; 
$username = 'root'; 
$password = ''; 
$database = 'loginmanager'; //your database name here`

### Step-3
Goto `localhost/forgot-password`
Try making new account, forgot password and other stuffs. Password is encrypted using `md5()`

## Informations
* After matching the email in database,following code generates an unique key. You can change the way to generate the key. 
`$key=md5(time()+123456789% rand(4000, 55000000));`
* The key is stored in forget_password table 
`$sql_insert=mysqli_query($dbconfig,"INSERT INTO forget_password(email,temp_key) VALUES('$email_reg','$key')");`
* and sent to email as well.
`mail($to, $subject, $msg, $headers)`

* When user clicks on link in email, the `key` and `email` are sent over server using `GET` method and checked in the `forget_password`
if the corresponding record is matched.

* From `forget_password_reset.php` file

`if(isset($_GET['key']) && isset($_GET['email'])) {
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
}`

* If key doesn't matches, redirects to index.php page (ie. login page).

* If key matches, its takes to `forget_password_reset.php` page. After user resets the password, the key is immediately deleted from the database so that same key cannot be used again.and, password is updated.

### If you are trying to use this on your local server, please make sure that you have configured sendMail.php file correctly.







