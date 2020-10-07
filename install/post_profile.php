<?php
require 'base.php';
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];




if($fullname == '' || $email == '' || $password == '' ){

    exit('All fields are required');

}

if($password != $confirm_password ){

    exit('Password does not match');

}

$password = password_hash($password, PASSWORD_DEFAULT);

require '../system/config.php';

$dbh = new pdo( 'mysql:host='.DB_HOST.';dbname='.DB_NAME,
    DB_USER,
    DB_PASSWORD,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

// Change only if current username is demo@example.com

$stmt = $dbh->query("SELECT *FROM sys_users where username = 'demo@example.com' LIMIT 1");
$stmt->execute();
if ($stmt->rowCount() === 1) {
    $sql = "UPDATE sys_users SET fullname='$fullname', username='$email', password='$password' WHERE id=1";

    $stmt = $dbh->prepare($sql);

    $stmt->execute();
    echo '1';
}
else{
    echo 'Username and password was already changed.';
}






