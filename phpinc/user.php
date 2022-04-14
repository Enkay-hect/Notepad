<?php
include_once "dbcon.php";
include "helpers/create_tables.php";

// Users class
 class Users{
     //var decleration
    public $fname;
    public $lname;
    public $user_name;
    protected $email;
    private $password;
    public $midname;

    function __construct($fname, $lname, $midname, $user_name, $email, $password)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->midname = $midname;
        $this->user_name = $user_name;
        $this->email = $email;
        $this->password = $password;

        $this->create_table();
        // $this->sql   = "SELECT * FROM `users` WHERE user_id='$user_name' AND password='$password'";
    }

    private function create_table(){

        $creator = new CreateTables;
        $creator->create_users_table();
    }

    public function create_user(){
        $dated = date("y/m/d/h/m/s");

        /// TO DO :: USE FULL NAMES FOR TABLE COLUMS EG FIRSTNAME NOT FNAME
        $user = "INSERT INTO `users`(`firstname`, `lastname`, `user_id`, `email`, `password`, `date_created`)
        VALUES ('$this->fname','$this->lname','$this->user_name','$this->email','$this->password ','$dated');";
        return $user;
    }
    public function name(){
        return "$this->lname, $this->fname $this->midname";
    }
    public function email(){
        return $this->email;
    }
    public function sql_connect(){
        $dbcon = new DatabaseConnection();

        $result = mysqli_query($dbcon->connect(), $this->sql)  or die('Access denied! <br>');
        $rows = mysqli_num_rows($result);
        if($rows == 1){
            $_SESSION['username'] = $this->username;
            $_SESSION['password'] = $this->password;
            // go to dashboard when the login is successful
            header("location: ../backend/index.html");
        }
        else{
            // stay in the login page when the login is not successful
           // header("location: login.php");
        }
    }
    public function login_message(){
        $login_message = " Don't have an account?";
        if (!$this->sql_connect()){
            $login_message = "Are you sure you have an account with us? Maybe ";  
        }
        return $login_message;
    }

}


$da = new Users('nonne','niete','goth','uhweu','uiwhioejie','tuhhwie');
  /// TO DO :: Move this( The connection and sql query) into a class function for $login_message
  
  /// TO DO :: REDIRECT TO INDEX PAGE AFTER SUCCESSFUL LOGIN..

?>
