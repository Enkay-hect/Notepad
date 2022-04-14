<?php

include_once "../dbcon.php";


class CreateTables extends DatabaseConnection{

  public function create_users_table(){

    // CREATE SQL QUERY
<<<<<<< HEAD
    $create_query = "CREATE TABLE if not exists `users`  (
=======
    $create_query = "CREATE TABLE IF NOT EXISTS  `users`(
>>>>>>> f2cf41702a2d84b1102e558bff5886edcd6f686d
        id int(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
        firstname varchar(100) NOT NULL,
        lastname varchar(100) NOT NULL,
        email varchar(255) NOT NULL,
        password varchar(255) NOT NULL,
        date_created datetime NOT NULL
    );";

    //Create connection variable and run sql query

    $conn = $this->connect();
    $run_query = $conn->query($create_query);

    if($run_query){
      return true;
    }

    return false;

  }

}

 ?>
