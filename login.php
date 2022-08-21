<?php
require_once 'database.php';


//start the session so we can use session global varaible
session_start();

//prevent user from getting back to the previous page
if(isset($_SESSION['username'])) {header('location: /view');}

//check if the user submit the login form
if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST'){

    //connecting to database
    $database->connect_db();

    //check if the user is exist in the database
    if($database->check_login_User($_POST['email'],$_POST['password'])) {

        //if the user exist redirect him to view page
        header('location:view');
    }
     
    //if the user is not exist in the database display this message
    else {
        echo "<script>alert('Email or password is incorrect.')</script>";
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>

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
    input[type='password'],input[type='email']{
        width: 100%;
        display:block;
        padding:10px;
        outline: none;
        border:none;
        border-bottom:1px solid grey;
        background:none;
    }

    .input-container {
        display:flex;
        justify-content:center;
        align-items:center;
        margin:30px 0px;
    }

    .icon{
        background-color:#1089ff;
        padding:10px;
        color:azure;
        font-size:20px;
        margin-right:5px;
    }
    ::placeholder {
        color:grey;
    }

    form{
        background-color:#FFF;
        padding:50px;
        border-radius:15px;
    }

    form h2 {
        font-weight: 300;
        font-size: 1.75rem;
        margin-top: 17px;
        text-transform: capitalize;
    }


    form button{
        font-size:20px;
        cursor: pointer;
        color:#FFF;
        background-color:#1089ff;
        padding:10px; 
        width: 100%;
        border:none;
        outline:none;
        margin-bottom:20px;
        transition:all 0.5s ease-in-out;
       }

       form button:hover{
           transition:all 0.5s ease-in-out;
           background-color:lightpink;
           transform:translateY(-5px);
       }

       .logError{
        padding: 15px;
       }

       .register{
        text-decoration: none;
        color: #1089ff;
        padding: 10px;
       }

       .forget{
        display: block;
        margin-top: 30px;
        text-decoration: none;
        color: #1089ff;
        padding: 13px;
        text-transform: capitalize;
       }

       .user-container{ 
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
           font-size:45px;
           color:#FFF;
       }
       
</style>
<body>
    <div class='register-container'>
        <form action="/login" method='POST'>
             
            <div class='user-container'>
                <i class='fa fa-user user-icon'></i>
            </div>

            <h2>Sign in</h2>

            <div class='input-container'>
                <i class='fa fa-envelope icon'></i>
                <input type='email' name='email' placeholder='Your email' required id='email'>
            </div>


            <div class='input-container'>
                <i class='fa fa-lock icon'></i>
                <input type='password' name='password' placeholder='Your password' required>
            </div>


            <button name='submit'>Login</button>


            <p>You don't have an account <a href='/register' class='register'> Register Now</a></p>

            
            <a href='/forget' class='forget'>Forget Password</a>
        </form>
    </div>
    
</body>
</html>