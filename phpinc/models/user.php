<?php
include_once "dbcon.php";
include_once "helpers/create_tables.php";


// TO DO :: ADD COMMENT TO EVERY FUNCTION FOR BETTER EXPLANATION
// TO DO :: ADD REGISTRATION FUNCTIONS AS WELL

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

        // TO DO :: DO NOT SELECT ALL EMAILS.. SELECT SPECIFIC EMAIL

        //select all the emails on the database
        $sql = "SELECT `email` FROM `users`";
        $host = new DatabaseConnection();
        $con = $host->connect();
        $result = $con->query($sql);

        // TO DO :: HANDLE BOTH SUCCESS AND ERROR CASES
        if ($result->num_rows > 0){
            //fetch the emails in the database into an array and assign the to the variable 'emails'
            $emails  = $result->fetch_assoc();

            // TO DO :: UNECESSARY

            foreach ($emails as $value){
                if($value == $this->email){
                    return true;
                }else{
                    return false;
                }
            }

            //--------------------
        }
    }
    public function grant_passage(){

        // TO DO :: CHECK FOR USERNAME AND PASSWORD SEPERATELY
        // $host = new DatabaseConnection();
        //
        // $this->set_email(mysqli_real_escape_string($host->connect(),$email));

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

            return true;
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
        if (!$this->check_user_email()){
            $login_message = "Are you sure you have an account with us? Maybe ";
        }
        return $login_message;
    }

}

// to do :: DO NOT CREATE A STATIC VARIABLE WHEN WORKING WITH MORE THAN ONE FUNCTION

//create new user
$user = new Users;

  /// TO DO :: Move this( The connection and sql query) into a class function for $login_message

  /// TO DO :: REDIRECT TO INDEX PAGE AFTER SUCCESSFUL LOGIN..

?>
