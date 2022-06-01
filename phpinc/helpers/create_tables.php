<?php
include_once "./dbcon.php";

class CreateTables extends DatabaseConnection{

  public function create_users_table(){

    // CREATE SQL QUERY


    $create_query = "CREATE TABLE IF NOT EXISTS  `users`(
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
    }else{
      return false;
    }
  }

  public function create_notes_table(){

   
    $note_query = "CREATE TABLE IF NOT EXISTS  `notes`(
        id int(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
        category_id text(100) NOT NULL,
        content text(10000) NOT NULL,
        date_created datetime NOT NULL
    );";


    $connnn = $this->connect();
    $check_query = $connnn->query($note_query);

    if($check_query){
      return true;
    }else{
      return false;
    }

    

  }

}
// $create = new CreateTables;
// var_dump($create->create_users_table());


 ?>
