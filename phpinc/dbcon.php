<?php

use LDAP\Result;

class DatabaseConnection{
  function __construct()
  {
    $this->servername = "localhost";
    $this->username = "Enkay";
    $this->password = "07080987528";
    $this->database = "notepad";
  }

  //Function to be called anytime a connection is required
  public function connect(){

    $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);


    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully";
    return $conn;

  }

}


?>
