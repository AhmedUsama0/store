<?php
class Database
{

    //a private property used to hold the connection to database
    private $conn;
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db_name = 'store';

    private $number_of_pages;

    //method used to connect to database
    public function connect_db()
    {
        try {
            $this->conn = new PDO('mysql:host=' . $this->servername . ';dbname=' . $this->db_name, $this->username, $this->password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conn;
        } catch (PDOException $e) {
            echo 'Connected Failed' . $e->getMessage();
        }
    }


    //method used to insert the product into the database
    public function create($name, $price, $img)
    {

        //insert the product properties into the database
        $query = "INSERT INTO product (name,price,image) VALUES ('$name','$price','$img')";

        //inject the database with the above query
        $stmt = $this->connect_db()->prepare($query);

        $result = $stmt->execute();

        //check if the product is inserted into the database sucessfully or not
        if ($result) {

            //if product is added display this message and redirect to view page
            echo "<script>alert('Product is added successfully.'); window.location = 'view.php';</script>";
        } else {
            echo "<script>alert('Something went wrong.')</script>";
        }

        $this->conn = null;
    }


    //method used to fetch the data from the database
    public function read()
    {

        //select all data from database
        $query = 'SELECT * FROM product';

        //inject the database with the above query
        $stmt = $this->connect_db()->prepare($query);

        $stmt->execute();
        //get the number of all products in the database
        $number_of_products = $stmt->rowCount();

        //specify the number of products you want for every page
        $products_per_page = 6;

        //get the number of pages using ceil function to round to the nearest integer
        $this->number_of_pages = ceil($number_of_products / $products_per_page);



        //determine on whcih page the user is currently on to define a start_limit for this page
        //we get $page value from the link then we pass it to start_limit
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {

            $page = $_GET['page'];
        }


        //define a start_limit for every page 
        //for example if we are in first page ($page = 1) then start_limit = 0 , that means we will start from the first record in the database
        //and count 10 records to be displayed in this page
        $start_limit = ($page - 1) * $products_per_page;

        $query = "SELECT * FROM product LIMIT " . $start_limit . ',' . $products_per_page;
        $stmt = $this->connect_db()->prepare($query);
        $stmt->execute();

        //looping through the data and convert each record to associatve array (row)
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            //put every row of the data in a form
            echo "<form method='POST' action='/UD'>";

            //display the uploaded image
            echo "<img src= 'uploads/" . $image . "'>";

            //display the name of the product
            echo  '<a href="details/' . $id  . '" style="font-size:25px; text-decoration:none; color:#000;" class="name">' . $name . '</a>';

            //display the price of the product
            echo '<p style="font-size:20px; font-weight:bold; margin:25px 0px;">' . $price . '$' . '</p>' . "<br>";

            //check if the logged in user is the admin
            if ($_SESSION['username'] === 'admin') {
                //if the logged in user is the admin display the delete button under each product
                echo "<input type='submit' value='Delete' name='delete'  class='delete'>";

                //if the logged in user is the admin display the edit button under each product
                echo "<input type='submit' value='Edit' class='edit' name='edit'>";

                //input to hold the value of the product id
                echo "<input type='hidden' " . "name= product-id" . " value=" . $id . " class='delete'>";
            }

            echo "</form>";
        }
    }

    //method to create links based on number of pages provided by read function 
    public function pages()
    {
        for ($page = 1; $page <= $this->number_of_pages; $page++) {

            //define page in the link so we can get it from the URL using GET
            echo '<a href="view?page=' . $page . ' ">' . $page . '</a>';
        }
    }


    //method to delete a product based on its id
    public function delete($id)
    {

        //delete the product based on its id
        $query = "DELETE FROM product WHERE id='$id'";

        //inject the database with the above query
        $stmt = $this->connect_db()->prepare($query);

        $stmt->execute();
    }


    //method to update a product 
    public function update($id, $name, $price, $img)
    {

        //update a product based on id,name and price
        $query = "UPDATE product SET name='$name' , price='$price' , image='$img' WHERE id='$id'";

        //inject the database with above query
        $stmt = $this->connect_db()->prepare($query);

        $stmt->execute();
    }


    //method to register a new user in the database 
    public function newUser($username, $password, $email)
    {

        //prepare the query to insert a new user
        $query = "INSERT INTO users (username,email,password) VALUES ('$username','$email','$password')";

        //inject the database with the above query
        $stmt = $this->connect_db()->prepare($query);

        $stmt->execute();
    }

    //method to check if the user is exist in the database
    public function check_login_User($email, $password)
    {

        //hash the password
        $password = md5($password);

        //searching in the database with the given email and password that the user provided
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";

        //inject the database with the above query
        $stmt = $this->connect_db()->prepare($query);

        $stmt->execute();

        //check if the database find the user
        if ($stmt->rowCount() > 0) {
            //if the database found the user convert the founded record to associatve array
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //assign the value of the username key in the row array to the username key in the session array
            $_SESSION['username'] = $row['username'];

            //return true at the end
            return true;
        }
    }


    //method to check if the user is already registerd or not
    public function check_forget_User($email)
    {

        //Prepare the query
        $query = "SELECT * FROM users WHERE email='$email'";

        //inject the database with the above query
        $stmt = $this->connect_db()->prepare($query);

        $stmt->execute();

        //check if the server found something in the database
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //method to check if the username or email or account is existing in the database
    public function check_existing_user($username, $email)
    {

        //prepare the query
        //select query is not case senstive that mean ahmed equals Ahmed and so on
        $query = "SELECT * FROM users WHERE username='$username' OR email='$email'";

        //inject the database with the above query
        $stmt = $this->connect_db()->prepare($query);

        $stmt->execute();

        //check if the database found any records
        if ($stmt->rowCount() > 0) {

            //convert each record to an associatve array
            //without looping on the records the if statement will be done on the first record only
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                //if statement is case senstive so ahmed not equal Ahmed
                if ($username === $row['username'] && $email === $row['email']) {
                    return 'account_exist';
                } else if ($email === $row['email']) {
                    return 'email_exist';
                } else if ($username === $row['username']) {
                    return 'username_exist';
                }
            }
        }
    }

    //method to update the user password
    public function update_user($password, $email)
    {

        //hash the password
        $password = md5($password);

        //prepare the query
        $query = "UPDATE users SET password='$password' WHERE email='$email'";

        //inject the database with the above query
        $stmt = $this->connect_db()->prepare($query);

        $stmt->execute();
    }


    public function getOneProduct($id) {
        $query = "SELECT * FROM product WHERE id=?";
        $stmt = $this->connect_db()->prepare($query);
        $stmt->execute([$id]);
        return $stmt;
    }
}

//making an instance of the Database class called database
$database = new Database();
