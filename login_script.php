<?php
include_once'phpinc/dbcon.php' ;
include_once'phpinc/user.php' ;
include_once'phpinc/create_tables.php';

/// TO DO :: MOVE THIS FILE INTO PHPINC

function treat_input($data){
    $data = stripslashes($data);
    return $data;
}

    // TO DO :: USE SPECIFIC REQUEST TYPES NOT JUST $_REQUEST

    //check if the lpgin button is clicked
    if (isset($_REQUEST["login"])){

        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $email = treat_input($email);
        $password = treat_input($password);


        $user = new Users;
        $user->set_email($email);
        // check if the email exists on the database
        if($user->check_user_email()){
            //collect user data from the database
            $user->grant_passage();
            //redirect to the dashboard
            header('location: backend/index.php');
        }else{
            header('location: backend/auth-sign-in.php');
        }
    }

?>
