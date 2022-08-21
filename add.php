<?php

//start the session so we can use SESSION gloabl variable
session_start();

//make the admin only access this page
if($_SESSION['username'] !== 'admin'){

    //if someone other than admin trying to access this page redirect it to login page
    header('location:/login');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://kit.fontawesome.com/49412697f5.js" crossorigin="anonymous"></script>


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato&family=Montserrat&display=swap');
        
        body{
            background-color: #f8f9fd;
            color:grey;
        }
        
        *{
            padding:0;
            margin:0;
            box-sizing:border-box;
            font-family: 'Lato', sans-serif;
        }

        .form-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form {
            background-color: #FFF;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 400px;
            border-radius: 10px;
        }

        input[type='text'] {
            width: 300px;
            display:block;
            padding:10px;
            outline: none;
            border:none;
            border-bottom:1px solid grey;
            background:none;
        }

        input[type='file']{
            width: 300px;
            display:block;
            padding:10px;

        }

        button {
            width: 70%;
            text-align: center;
            margin: 0 auto;
            margin-top: 15px;
            border: none;
            outline: none;
            color: azure;
            background-color: #1089ff;
            padding: 10px;
            font-size: 20px;
            transform: translateY(20px);
            cursor: pointer;
            transition: all 0.5s ease-in-out;
        }

        button:hover{
            transform: translateY(15px);
            background-color: bisque;
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
           font-size:50px;
           color:#FFF;
       }


       nav {
            background-color: #1089AD;
            height: 60px;
           display: flex;
           align-items: center;
        }
        nav ul {
            width: 50%;
            margin: 0 auto;
            text-align: center;
        }

        nav ul li {
            display: inline-block;
            padding: 10px;
            margin-right: 10px;
        }

        nav ul li a {
            text-decoration:none;
            font-size:30px;
            color:#FFF;
            
        }

        .pages {
            text-align: center;
            width: 60%;
            margin: 30px auto 10px auto;
        }

        .pages a {
            text-decoration: none;
            margin-top:10px;
            margin-right: 25px;
            display: inline-block;
            background-color: #1089AD;
            padding: 10px;
            width: 4%;
            color: #FFF;
            font-size: 20px;
        }

        

        @media screen and (max-width:500px) {
            form{
                width:100%;
            }

            .products-container{
                width:80%;
            }


            nav ul {
                width:100%;
            }

            nav ul li a {
                font-size:21px;
            }

            .pages {
                width:100%;
            }

            .pages a {
                width:8%;
            }
        }
    </style>
</head>

<body>

    <nav>
        <ul>
            <li><a href="view">Home</a></li>
            <li><a href='add'>Add</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="logout">Logout</a></li>
        </ul>
    </nav>
    <div class='form-container'>
        <form action="/create" method="POST" enctype="multipart/form-data">


            <div class='user-container'>
                <i class='fa fa-product-hunt user-icon'></i>
            </div>



            <div class='input-container'>
                <i class='fa fa-file-signature icon'></i>
                <input type="text" name='name' id="name" placeholder="Enter the product name" require>
            </div>


            <div class='input-container'>
                <i class='fa fa-dollar icon'></i>
                <input type="text" name="price" id="price" placeholder="Enter the price" require>
            </div>


            <div class='input-container'>
                <i class='fa fa-image icon'></i>
                <input type="file" name='img' require>
            </div>

            


            <button name='submit' type='submit'> Submit</button>
        </form>
    </div>

</body>

</html>