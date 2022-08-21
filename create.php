<?php
require_once 'database.php';
require_once 'product.php';
require_once 'upload.php';

//check if the form is submitted using POST method and check if the fields are not empty and the image is uploaded
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['name']) && !empty($_POST['price']) && !$_FILES['img']['error'] == UPLOAD_ERR_NO_FILE){

    //get the properties of the uploaded image
    $file = new upload();

    //check if the uploaded file is image or not and check if the image is valid
    $file->checkImage();

    //check the status of the uploadOk to know if the uploaded image is valid or not
    if($file->uploadOk){

        //connect to database
        $database->connect_db();
    
       
       //once we check the image is valid we get its name to pass it to the product then insert it in the database
       $img = $file->get_img_name();

    
        //making a new product
        $product = new Product($_POST['name'],$_POST['price'],$img,'');
    
        //insert the product into database
        $database->create($product->name,$product->price,$product->img);

        
        
    }
    
    //prevent user from submiting the form if the fields are empty
    else {
        header('location: add');
    }
}

else {
    header('location: add');
}




?>