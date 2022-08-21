<?php
require_once 'database.php';
require_once 'product.php';
require_once 'upload.php';

//start the session so we can use SESSION gloabl variable
session_start();

//make the admin only access this page
if($_SESSION['username'] !== 'admin'){

    //if someone other than admin trying to access this page redirect it to login page
    header('location:/login');
}

//check if the fields of update are not empty
if(!empty($_POST['name']) && !empty($_POST['price']) && $_FILES['img']['error'] !== UPLOAD_ERR_NO_FILE){


    //connecting to database
    $database->connect_db();

    //get the properties of the uploaded file
    $file = new upload();

    //check if the file is image or not
    $file->checkImage();

    //if the uploaded file is image do the following code
    if($file->uploadOk){

        //get the image name
        $img = $file->get_img_name();


        //assing the product id to the static property product_id in class product
        $product = new Product($_POST['name'],$_POST['price'],$img,$_POST['id']);

        //delete the product based on its id
        $database->update(Product::$product_id,$product->name,$product->price,$product->img);

        //redirect the user to view page
        header('location: /view');
    }

    //if the uploaded file is not image redirect to UD page
    else {
        header('location: /UD');
    }
   
}

//if the fields are empty redirect to UD page

else {
    header('location:/UD');
}



?>