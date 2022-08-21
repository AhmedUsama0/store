<?php

class upload {
    
    //properties of the image
    public $fileName;
    public $filePath;
    public $imageFileType;
    public $uploadOk;

    //assign the input image proeprties to properties of class upload
    public function __construct(){

        //get the file name of the uploaded image
        $this->fileName = basename($_FILES['img']['name']);

        //specify the directory to which the image will be saved
        $this->filePath = "uploads/" . $this->fileName;

        //investigate the image type
        $this->imageFileType = strtolower(pathinfo($this->filePath,PATHINFO_EXTENSION));

      

    }

    //method to get the image name
    public function get_img_name(){

        //get the image name to pass it to the product then insert it to the database
        return $this->fileName;
    }



    //method to check the if the type of the uploaded image is valid or not and to check if the file is image or not
    public function checkImage(){

        //check if it is image or not
        if(getimagesize($_FILES['img']['tmp_name']) !== false){

            //check if the type of the image is valid or not
            if($this->imageFileType === 'jpg' || $this->imageFileType === 'png' || $this->imageFileType === 'jpeg' ){

                //if it is an image of the above extensions then set uploadOk to true (1)
                $this->uploadOk = 1;

                 //save the image in the specified directory
                 move_uploaded_file($_FILES['img']['tmp_name'],$this->filePath);

                 
            }

            else{
                //if the uploaded image does not match any of the above extensions then set uploadOk to false (0)
                $this->uploadOk = 0;
            }
            
        }
        
        
    }
}



?>