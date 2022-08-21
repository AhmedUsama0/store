<?php
require_once 'database.php';
//start the session
session_start();

//if the session email key not set redirect the user to login page
if(!isset($_SESSION['email'])) {
    echo "<script>alert('The link is Expired.'); window.location = '/login';</script>";
}

//check if the session is set and the fields are not empty and the form is sumbitted using POST method
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['email']) && isset($_POST['submit']) && !empty($_POST['password']) && !empty($_POST['cpassword'])) {

        //check if the passwords matched
        if($_POST['password'] === $_POST['cpassword']) {
            $database->connect_db();
            $database->update_user($_POST['password'],$_SESSION['email']);
            session_unset();
            session_destroy();
            echo "<script>alert('Password is changed successfully.'); window.location = '/login';</script>";
        }

        else {
            echo "<script>alert('password and confirm password not matched')</script>";
        }
    }
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>

    <script src="https://kit.fontawesome.com/49412697f5.js" crossorigin="anonymous"></script>

</head>

<style>
    body{
        background-color:#f8f9fd;
        color:grey;
    }
    *{
        margin:0;
        padding:0;
        box-sizing: border-box;
        font-family:Verdana, Geneva, Tahoma, sans-serif;
    }

    .register-container{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        text-align: center;
    }
    input[type='password'] {
        width: 300px;
        display:block;
        padding:10px;
        outline: none;
        border:none;
        border-bottom:1px solid grey;
        background:none;
    }

    form{
        background-color:#FFF;
        padding:50px;
        border-radius:15px;
    }

    form h2{
        font-size: 40px;
        color: azure;
        background-color: lightpink;
        padding: 10px;
        text-transform:capitalize;
    }


    form button{
        font-size:20px;
        cursor: pointer;
        color:#FFF;
        background-color: #1089ff;
        padding:10px; 
        width: 100%;
        border:none;
        outline:none;
        margin-bottom:20px;
       }

       .login{
        text-decoration: none;
        color: #FFF;
        background-color: lightpink;
        padding: 10px;
       }


       .input-container {
           display:flex;
           justify-content:center;
           align-items:center;
           margin:30px 0px;
       }

       .icon {
        background-color:#1089ff;
        padding:10px;
        color:azure;
        font-size:20px;
        margin-right:5px;
       }

       .user-container {
           display:flex;
           flex-direction:column;
           justify-content:center;
           align-items:center;
           background-color:#1089ff;
           width:80px;
           height:80px;
           border-radius:50%;
           margin:0 auto;
       }

       .user-icon  {
           font-size:40px;
           color:#FFF;
       }
</style>
<body>
    <div class='register-container'>
        <form action="/change" method='POST'>


            <div class='user-container'>
                <i class='fa fa-user user-icon'></i>
            </div>

            <div class='input-container'>
                <i class='fa fa-lock icon'></i>
                <input type='password' name='password' placeholder='Enter your new password' required>
            </div>


            <div class='input-container'>
                <i class='fa fa-lock icon'></i>
                <input type='password' name='cpassword' placeholder='Re-enter your password' required>
            </div>
            
           
            <button name='submit'>Continue</button>
        </form>
    </div>
    
</body>
</html>