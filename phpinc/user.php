<?php include_once "dbcon.php";
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
        $user_table = " CREATE TABLE user(
            sn int(20) PRIMARY KEY NOT NULL AUTO INCREMENT,
            fname varchar(100) NOT NULL,
            lname varchar(100) NOT NULL,
            user_id varchar(100) NOT NULL,
            email varchar(255) NOT NULL,
            password varchar(255) NOT NULL,
            date_created datetime NOT NULL
        );";
        return $user_table;
    }
    public function create_user(){
        $dated = date("y/m/d/h/m/s");
        $user = "INSERT INTO TABLE user('fname','lname','user_id','email','password','date_created') 
        values('$this->fname','$this->lname','$this->user_name','$this->email','$this->password ','$dated');";
        return $user;
    }
    public function name(){
        return "$this->lname, $this->fname $this->midname";
    }
    public function email(){
        return $this->email;
    }

}


?>