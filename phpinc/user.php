<?php
include_once "dbcon.php";
include_once "helpers/create_tables.php";
include_once "notetable.php";

// Users class
 class Users{
     //var decleration
    public $fname;
    public $lname;
    public $user_name;
    protected $email;
    private $password;
    public $midname;

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

    protected function set_password($password){
        $this->password = $password;
    }


    // This function calls the Users class and creates table if it does not exist 
    private function create_table(){

        $creator = new CreateTables;
        $creator->create_users_table();
    }

    public function create_user(){
        /// TO DO :: USE FULL NAMES FOR TABLE COLUMS EG FIRSTNAME NOT FNAME
        $sql = "INSERT INTO `users`(`firstname`, `lastname`, `email`, `password`)
        VALUES ('$this->firstname','$this->lastname','$this->email','" .md5($this->password). "');";
        $host = new DatabaseConnection();
        $con = $host->connect();
        $result = $con->query($sql);
        return $result;
    }

    public function check_user_email(){

        //select all the emails on the database
        $sql = "SELECT `email` FROM `users`";
        $host = new DatabaseConnection();
        $con = $host->connect();
        $result = $con->query($sql);

        if ($result->num_rows > 0){
            //fetch the emails in the database into an array and assign them to the variable 'emails'
            $emails  = $result->fetch_assoc();

            foreach ($emails as $value){
                if($value == $this->email){
                    return true;
                }else{
                    return false;
                }
            }
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

            // create as session to hold the username and password
            $_SESSION['username'] = $this->username;
            $_SESSION['password'] = $this->password;
        }
        
    }
    public function get_name(){
        return "$this->lastname, $this->firstname";
    }
    public function get_email(){
        return $this->email;
    }
    // public function sql_connect(){
    //     $dbcon = new DatabaseConnection();

    //     $result = mysqli_query($dbcon->connect(), $this->sql)  or die('Access denied! <br>');
    //     $rows = mysqli_num_rows($result);
    //     if($rows == 1){
    //        
    //         // go to dashboard when the login is successful
    //         //header("location: ../backend/index.php");
    //     }
    //     else{
    //         // stay in the login page when the login is not successful
    //         //header("location: ../backend/auth-sign-in.php");
    //     }
    // }
    public function login_message(){
        $login_message = " Don't have an account?";
        if (!$this->check_user_email()){
            $login_message = "Are you sure you have an account with us? Maybe ";  
        }
        return $login_message;
    }

}

//create new user
$user = new Users;

  /// TO DO :: Move this( The connection and sql query) into a class function for $login_message
  
  /// TO DO :: REDIRECT TO INDEX PAGE AFTER SUCCESSFUL LOGIN..

?>
