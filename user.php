<?php
class user {

    //user properties
    public $username;
    public $password;
    public $email;

    //assign the inputs of the user to properties of class user
    public function __construct($username,$password,$email){
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }

    //method to filter the user input information
    public function user_info_filter(){

        //$this->username = filter_var($this->username,FILTER_SANITIZE_STRING);
        /*$this->username = trim($this->username);
        $this->username = stripslashes($this->username);*/
        //$this->username = htmlspecialchars($this->username);

        //sanitize the email
        $this->email = filter_var($this->email, FILTER_SANITIZE_EMAIL);

        //hash the password
        $this->password = md5($this->password);

        //if the username and email is valid return true
        //preg_match used to check if the username only contain letters and numbers
        if(preg_match('/^[A-Za-z0-9_-]*$/', $this->username) && filter_var($this->email,FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        //if the username is valid and email is not valid return Email is not valid
        else if (preg_match('/^[A-Za-z0-9_-]*$/' , $this->username) && !filter_var($this->email,FILTER_VALIDATE_EMAIL)) {
            return 'Email is not valid';
        }

        //if the username is not valid and email is valid return Username is not valid
        else if (!preg_match('/^[A-Za-z0-9_-]*$/' , $this->username) && filter_var($this->email,FILTER_VALIDATE_EMAIL)) {
            return 'Username is not valid';
        }

        //if both not valid return false
        else if (!preg_match('/^[A-Za-z0-9_-]*$/' , $this->username) && !filter_var($this->email,FILTER_VALIDATE_EMAIL)) {
            return false;
        }
      

        
    }
}

?>