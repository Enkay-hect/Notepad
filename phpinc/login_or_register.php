<?php
include_once 'dbcon.php' ;
include_once 'user.php' ;
include_once 'helpers/create_tables.php';



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
elseif(isset($_POST['register'])){

    //gets data from the forms
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // handle the inputs
    $firstname = treat_input($firstname);
    $lastname = treat_input($lastname);
    $email = treat_input($email);
    $password = treat_input($password);

    // call the user object
    $user = new Users;
    $register = $user->register($firstname,$lastname, $email, $password,);

    if($register){
        header('location: ..backend/auth-sign-in.php');
    }else{
        header('location: ..backend/auth-sign-up.php');
    }
}

?>

