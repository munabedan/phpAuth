<?php
session_start();

//connection info
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
if(!isset($_POST['username'],$_POST['password'])){
    //if not exit and display error
    exit('Please fill both the username and password fields!');
}

if ($stmt=$con->prepare('SELECT id, password FROM accounts WHERE username = ?')){
    $stmt->bind_param('s',$_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0){
        $stmt->bind_result($id,$password);
        $stmt->fetch();
        
        //if(password_verify($_POST['password'],$password)){
        if($_POST['password']===$password){

            session_regenerate_id();
            $_SESSION['logged_in']=TRUE;
            $_SESSION['name']=$_POST['username'];
            $_SESSION['id']=$id;
            echo 'Welcome' . $_SESSION['name'] . '!';

        } else {
            echo 'Incorrect username and/or password! ';
        }
    } else {
        echo 'Incorrect username and/or password! ';
    }

    

    $stmt->close();
}
?>