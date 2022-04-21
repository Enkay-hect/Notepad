<?php
include_once "dbcon.php";
include_once "helpers/create_tables.php";




// Users class
class Users{
     //var decleration
    public $firstname;
    public $lastname;
    protected $email;
    private $password;

    function __construct()
    {
        //here the function is invoked anytime the User clss is called
        $this->create_table();
    }

    //these set of funtions will set the users informations
    public function set_first_name($firstname){
        $this->firstname = $firstname;
    }

    public function set_last_name($lastname){
        $this->lastname = $lastname;
    }

    public function set_email($email){
        $this->email = $email ;
    }

    private function set_password($password){
        $this->password = $password;
    }


    // This function calls the Users class and creates table if it does not exist
    private function create_table(){

        $creator = new CreateTables;
        $creator->create_users_table();
    }

    public function create_user(){//to create a user

        $sql = "INSERT INTO `users`(`firstname`, `lastname`, `email`, `password`)
        VALUES ('$this->firstname','$this->lastname','$this->email','" .md5($this->password). "');";
        $host = new DatabaseConnection();
        $con = $host->connect();
        $result = $con->query($sql);
        return $result;
    }

    // this will the email & passwrod and call the rest of the fuctions in their sequence for a successful login
    public function login($email, $password){
        $this->set_password($password);
        $this->set_email($email);
        // check if the email exists on the database
        if($this->check_user()){

            $this->grant_passage();// check the email with the password and collect the basic user info
            header('location: ../backend/index.php'); //redirect to the dashboard        
        }else{

            header('location: ../backend/auth-sign-in.php');
        }
    }  
     
    // to check the email and password
    public function check_user(){
        
        //select the email on the database for checking
        $sql = "SELECT * FROM users WHERE email = '$this->email';";
        $host = new DatabaseConnection();
        $con = $host->connect();
        $result = $con->query($sql);

        //check if such email exists in the datatbase
        if( $result->num_rows == 1){

        $userdata = $result->fetch_assoc();

        if( $this->password == $userdata['password'] ){
            return true;
        }else{
            return false;
        }

        }else{
            return false;
        }
    }
    
    public function grant_passage(){

        $sql = "SELECT * FROM `users` WHERE `email`= '$this->email' AND `password`='$this->password';";
        $host = new DatabaseConnection();
        $con = $host->connect();
        $result = $con->query($sql);
        if($result->num_rows > 0){
            $info  = $result->fetch_assoc();
            $this->set_first_name($info['firstname']);
            $this->set_last_name($info['lastname']);

            // greate as session to hold the email
            $_SESSION['email'] = $this->email;

            return $info;
        }else{
          return false;
        }

    }


    public function get_name(){
        return "$this->lastname, $this->firstname";
    }

    public function get_email(){
        return $this->email;
    }

    public function login_message(){
        $login_message = " Don't have an account?";
        if (!$this->check_user()){
            $login_message = "Are you sure you have an account with us? Maybe ";
        }else{
            return $login_message;
        }
    } 
    public function check_user_email(){
        //select the email on the database for checking
        $sql = "SELECT `email` FROM `users` WHERE `email`='$this->email'";
        $host = new DatabaseConnection();
        $con = $host->connect();
        $result = $con->query($sql);
        //check if such email exists in the database
        if ($result->num_rows == 1){
            return true;
        }else{
            return false;
        }
    }

    public function register($firstname,$lastname, $email, $password){
        $this->set_first_name($firstname);
        $this->set_last_name($lastname);
        $this->set_email($email);
        $this->set_password($password);
        if(!$this->check_user_email()){
            $this->create_user();
            return true;
        }else{
            return false;
        }
    }
} 

    
    

?>
