<?php
require_once 'database.php';
require_once 'user.php';

error_reporting(0);

//check if the user submit the register form using POST method
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    //check if the user submit the form with all fields complete
    if(isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])){


        //check if the password input field matched the confirm password input field
        if($_POST['password'] === $_POST['cpassword']){
          

            //making a new user
            $user = new user($_POST['username'], $_POST['password'], $_POST['email']);

            //check if the username and email are valid
            if($user->user_info_filter() === true) {


                //connecting to the database
                $database->connect_db();

                //check if the email or username or the account is exist in the database
                $check_user = $database->check_existing_user($user->username, $user->email);

                //if the method return username_exist then display this message
                if($check_user === 'username_exist'){
                    echo "<script>alert('Username is already exist.')</script>";
                }

                //if the method return email_exist then display this message
                else if ($check_user === 'email_exist') {
                    echo "<script>alert('Email is already exist.')</script>";
                }

                //if the method return account_exist then display this message
                else if ($check_user === 'account_exist') {
                    echo "<script>alert('Account is already exist.')</script>";
                }

                //if the username or email or the account is not exist in the database then register the new user
                else {
                
                    //insert the user data into the database
                    $database->newUser($user->username, $user->password, $user->email);

                    //display message and redirect to login page
                    echo "<script>alert('Registeration  is successfully.'); window.location = '/login';</script>";

               }

            }


            //if the email not valid display Email is not valid
            else if($user->user_info_filter() === 'Email is not valid') {
                $email_error = 'Email is not valid';
            }

            //if the username is not valid display Username is not valid
            else if($user->user_info_filter() === 'Username is not valid') {
                $username_error = 'Username is not valid';
            }


            //if both are not valid display Email is not valid and Username is not valid
            else if($user->user_info_filter() === false) {
                $email_error = 'Email is not valid';
                $username_error = 'Username is not valid';
            }

            
            

           

            

           
           
        }

        //if the password doesn't match display this message
        else {
            echo "<script>alert('Passwords does not match.')</script>";
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
    <title>Regestration</title>

    <script src="https://kit.fontawesome.com/49412697f5.js" crossorigin="anonymous"></script>
</head>

<style>
    body{
        background-color:#f8f9fd;
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
    input[type='text'],input[type='password']{
        width: 300px;
        display:block;
        padding:10px;
        outline: none;
        border:none;
        border-bottom:1px solid grey;
        background:none;
    }

    ::placeholder {
        color:grey;
    }

    form{
        background-color:#FFF;
        padding:50px;
        border-radius:15px;
    }

    form h2{
        font-weight: 300;
        font-size: 1.75rem;
        margin-top: 17px;
        text-transform: capitalize;
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
        margin-top:30px;
        transition:all 0.5s ease-in-out;
       }

       form button:hover{
           transition:all 0.5s ease-in-out;
           background-color:lightpink;
           transform:translateY(-5px);
       }

       .login{
        text-decoration: none;
        color: #1089ff;
        padding: 10px;
       }

       .email-error,.username-error{
        text-align: left;
        transform: translateY(15px);
        color: red;
        font-size: 12px;
        font-weight: bold;
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
           font-size:45px;
           color:#FFF;
       }
</style>
<body>
    <div class='register-container'>
        <form action="/register" method='POST'>

            <div class='user-container'>
                <i class='fa fa-id-card user-icon'></i>
            </div>


            <p class='username-error'><?php if(isset($username_error)) {echo $username_error;} ?></p>
            <div class='input-container'>
                <i class='fa fa-user icon'></i>
                <input type="text" name='username' id='username' placeholder='Enter your username' value='<?php echo $_POST['username'] ?>' required>
            </div>

            <p class='email-error'><?php if(isset($email_error)) {echo $email_error;} ?></p>
            <div class='input-container'>
                <i class='fa fa-envelope icon'></i>
                <input type="text" name='email' placeholder='Enter your email' required id='email' value='<?php echo $_POST['email'] ?>'>
            </div>


            <div class='input-container'>
                <i class='fa fa-lock icon'></i>
                <input type="password" name='password' placeholder='Enter your password'  required>
            </div>


            <div class='input-container'>
                <i class='fa fa-lock icon'></i>
                <input type="password" name='cpassword' placeholder='Re-enter your password' required>
            </div>

            <button name="submit">Register</button>

            
            <p style='color:grey;'>Already have an account <a href="/login" class='login'>Log in</a></p>
        </form>
    </div>
    
</body>
</html>