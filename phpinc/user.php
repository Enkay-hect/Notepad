<?php include_once "dbcon.php";

// creating an admin class
 class admin{
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
    }
    
    private function create_table(){
        $user_table = " CREATE TABLE `users`(
            sn int(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            fname varchar(100) NOT NULL,
            lname varchar(100) NOT NULL,
            user_id varchar(100) NOT NULL,
            email varchar(255) NOT NULL,
            password varchar(255) NOT NULL,
            date_created datetime NOT NULL
        )";
        return $user_table;
    }
    public function create_user(){
        $dated = date("y/m/d/h/m/s");
        $user = "INSERT INTO `users`(`fname`, `lname`, `user_id`, `email`, `password`, `date_created`) 
        VALUES ('$this->fname','$this->lname','$this->user_name','$this->email','$this->password ','$dated');";
        return $user;
    }
    public function name(){
        return "$this->lname, $this->fname $this->midname";
    }
    public function email(){
        return $this->email;
    }

}




    $login_message = " Don't have an account?";
    // Check if the form is submitted
    if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
        // Remove back slashes from the input
        $username = stripslashes($_REQUEST['username']) ;
        $password = stripslashes($_REQUEST['password']) ;
        
        
        $username = mysqli_real_escape_string($conn, $_REQUEST['username']);
        $password = mysqli_real_escape_string($conn, $_REQUEST['password']);

        $sql   = "SELECT * FROM `users` WHERE user_id='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql)  or die('Access denied! <br>');
        $rows = mysqli_num_rows($result);
        if($rows == 1){
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header("location: dashboard.php");
        }
        else{
            $login_message = "Are you sure you have an account with us? Maybe ";
            
        }
    }
    echo $login_message;
    ?>