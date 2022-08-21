<?php
require_once 'database.php';

class Product {

    //product properties
    public $name;
    public $price;
    public $img;

    //static property so we can use it without creating an object from the class
    public static $product_id;

    public function __construct($name,$price,$img,$id){

        //filter the name of the product
        $this->name = trim($name);
        $this->name = stripslashes($name);
        $this->name = htmlspecialchars($name);

        //filter the price of the product
        $this->price = trim($price);
        $this->price = stripslashes($price);
        $this->price = htmlspecialchars($price);

        
        //assign the image name to image property
        $this->img = $img;

        //assign the product id to the product_id property
        self::$product_id = $id;


    }
}





?>