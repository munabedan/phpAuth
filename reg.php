<?php

$DATABASE_HOST='localhost';
$DATABASE_USER='root';
$DATABASE_PASS='';
$DATABASE_NAME='phpauth';

//Try and connect to database using info above
$con=mysqli_connect($DATABASE_HOST,$DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);
if(mysqli_connect_errno()){
    //if an error occurs , stop script and display error
    exit('Failed to connect to MySQL: '.mysqli_connect_error());
}

//check if data from login form was submitted
if(!isset($_POST['username'],$_POST['password'],$_POST['email'])){
    //if not exit and display error
    exit('Please fill both the username and password fields!');
}

$username= $_POST['username'];
$password=$_POST['password'];
$email=$_POST['email'];

if ($stmt=$con->prepare('SELECT id FROM accounts WHERE username = ?')){
    $stmt->bind_param('s',$_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows == 0){
        if($stmt=$con->prepare('INSERT INTO accounts (username,password,email) VALUES (?,?,?)')){
            $stmt->bind_param("sss",$username,$password,$email);
            $stmt->execute();
        } else{
            header('location:index.html');
        }
    } else{
        header('location:register.html');
    }

    $stmt->close();
}

?>