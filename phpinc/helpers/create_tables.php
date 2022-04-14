<?php

include_once "../dbcon.php";


class CreateTables extends DatabaseConnection{

  public function create_users_table(){

    // CREATE SQL QUERY
    $create_query = "CREATE TABLE if not exists `users`  (
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
