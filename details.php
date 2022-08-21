<?php
include_once 'database.php';

$database->connect_db();
$stmt = $database->getOneProduct($_GET['productID']);

$row = $stmt->fetch(PDO::FETCH_ASSOC);
extract($row);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .product-details-container {
            margin: 10vh auto 0 auto;
            padding: 0 10px;
            max-width: 1400px;
            overflow: auto;
        }

        .product-details {
            float: left;
            width: 60%;
            border:2px solid whitesmoke;
            border-radius: 10px;
            padding: 15px;
        }

        .buy {
            float:right;
            border: 2px solid whitesmoke;
            border-radius: 10px;
            width: 30%;
            padding:0 10px;
        }

        span {
            color:red;
            margin-top:10px;
            margin-bottom:50px;
        }
        span,button {
            display: block;
        }

        button {
            margin:50px 0 ;
            width: 100%;
            color:#fff;
            background-color: orange;
            border:none;
            padding:10px;
            border-radius: 5px;
        }

        p {
            margin-top: 20px;
            font-size: 25px;
        }

        img {
            display: block;
            margin: auto;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class='product-details-container'>

        <div class='buy'>
            <p class='price'> <?php echo $price . '$' ?> </p>

            <span>FREE delivery</span>

            <button>Add to Cart</button>
            <button>Buy Now</button>
        </div>
        <div class='product-details'>
            <?php

            echo "<img src= '/uploads/" . $image . "'>";

            echo "<p>" . $name . "</p>";

            ?>
        </div>
    </div>
</body>

</html>