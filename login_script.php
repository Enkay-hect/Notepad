<?php
include_once'phpinc/dbcon.php' ;
include_once'phpinc/user.php' ;
include_once'phpinc/create_tables.php';

if (isset($_REQUEST["login"])){
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $email = treat_input($email);
    $password = treat_input($password);
    if(){

    }
}
?>