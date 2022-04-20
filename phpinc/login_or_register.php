<?php
include_once'dbcon.php' ;
include_once'models/user.php' ;
include_once'helpers/create_tables.php';



function treat_input($data){
    $data = stripslashes($data);
    return $data;
}

//check if the lpgin button is clicked
if (isset($_POST["login"])){

   //collect data from the forms
    $email = $_POST['email'];
    $password = $_POST['password'];

    // treat the inputs
    $email = treat_input($email);
    $password = treat_input($password);

    // call the user object
    $user = new Users;
    $user->login($email,$password);
}

?>

