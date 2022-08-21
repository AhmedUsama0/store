<?php
require_once 'database.php';

// echo '/details?productID=' . $_GET['test'] ;

//start session so we can use SESSION variable
session_start();

//check if a user or the admin logged in or not 
if(isset($_SESSION['username'])){

    //connecting to database
    $database->connect_db();

}

//if the session is not set redirect to login page
else {
    header('location: login.php');
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato&family=Montserrat&display=swap');
        *{
            padding:0;
            margin:0;
            box-sizing:border-box;
            font-family: 'Lato', sans-serif;
        }

        body{
            background-color:#FFF;
            
        }

        @keyframes fade {
            from{opacity:0;}
            to{opacity:1;}
        }
        .products-container{
            max-width: 1100px;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill,minmax(300px,1fr));
            gap: 10px;
            margin: 20px auto 0;
            animation-name: fade;
            animation-timing-function: ease-in-out;
            animation-duration:1s;
          
        }

        form{
            text-align:center;
            background-color:whitesmoke;
            padding:20px;
            border-radius:15px;
            position: relative;
        }

        img{
            max-width:100%;
            height: 300px;
            margin-bottom: 20px;
        }

        .edit{
            text-decoration: none;
            color: azure;
            background-color: #1089ff;
            display: inline-block;
            padding: 10px;
            margin-right: 10px;
            width: 30%;
            border:none;
            outline:none;
            cursor:pointer;
            position: absolute;
            bottom: 15px;
        }

        .delete {
            text-decoration: none;
            color: azure;
            background-color: #f64c72;
            display: inline-block;
            padding: 10px;
            margin-right: 10px;
            width: 30%;
            border:none;
            outline:none;
            cursor:pointer;
            position: absolute;
            bottom: 15px;
            left: 15%;
        }

        h1{
            text-align:center;
            margin-top: 40px;
            background-color: #f64c72;
            color: #FFF;
            padding: 10px;
            letter-spacing: 10px;
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
            nav ul {
                width:100%;
            }

            nav ul li a {
                font-size:13px;
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
            <?php if($_SESSION['username'] === 'admin'){echo "<li><a href='add'>Add</a></li>";} ?>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="logout">Logout</a></li>
        </ul>
    </nav>
    <h1  class='welcome'><?php echo 'Welcome ' . $_SESSION['username'] ; ?></h1>
    
   <div class='products-container'><?php $database->read(); ?> </div>

   <div class='pages'><?php $database->pages(); ?></div>

   <script>
      
   </script>
</body>
</html>

