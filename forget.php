<?php
require_once 'database.php';
require_once 'user.php';
session_start();
//check if the form submit using POST METHOD
if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST'){

    //connecting to database
    $database->connect_db();

    //assign the input email to the emali property of the user
    $user = new user('' , '', $_POST['email']);

    
    //check if the email is exist in database or not and if it is exist return true and if not return false
    $user_password = $database->check_forget_User($user->email);

    //check if the email is not exist
    if(!$user_password){
        echo "<script>alert('The email does not exist')</script>";
    }


    //check if the email is exist
    else {

        //assign the email value to the key email in session variable
        $_SESSION['email'] = $user->email;

        //send a link to the user to change the password
        require_once 'phpmailer/mail.php';

    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>

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
    input[type='email']{
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

    .register-container{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        text-align: center;
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
        transition:all 0.5s ease-in-out;
       }

       form button:hover{
           transition:all 0.5s ease-in-out;
           background-color:lightpink;
           transform:translateY(-5px);
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
        <form action="/forget" method='POST'>




            <div class='user-container'>
                <i class='fa fa-key user-icon'></i>
            </div>


            <div class='input-container'>
                <i class='fa fa-envelope icon'></i>
                <input type='email' name='email' placeholder='Enter your email' required>
            </div>


            
            <button name='submit'>Continue</button>
        </form>
    </div>
    
</body>
</html>