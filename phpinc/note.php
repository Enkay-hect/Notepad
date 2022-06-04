<?php

include_once "./dbcon.php";
include_once "./helpers/create_tables.php";
include_once "./user.php";



class Notes
{


 private $content;
 private $title;
 private $Icon;
 private $reminderdate;

  public function __construct()
  {
      //$this->create_notes(); 
     
  }

  public function create_notes(){

        $creator = new CreateTables;
        $creator->create_notes_table();
   }

      
  public function create_note($content, $title, $Icon, $reminderdate)
  {
     $this->content = $content;
     $this->title = $title;
     $this->Icon = $Icon;
     $this->reminderdate = $reminderdate;


      $sql = "INSERT INTO notes (content, title, Icon, reminderdate) VALUES ('$this->content', '$this->title', '$this->Icon', '$this->reminderdate');";
      $host = new DatabaseConnection();
      $con = $host->connect();
      
      $result = $con->query($sql);

      print_r($con->error);
     
      return $result;
  } 

  
  
}

$note = new Notes;


if(isset($_POST['save'])){

  $content      = $_POST['content'];
  $title        = $_POST['title'];
  $Icon        = $_POST['Icon'];
  $reminderdate = $_POST['reminderdate'];



  $note->create_note($content, $title, $Icon, $reminderdate);
}


function display_note($title, $content, $Icon, $reminderdate)

{

      $sql = "SELECT * FROM notes WHERE id = 1";
      $host = new DatabaseConnection();
      $con = $host->connect();
      $result = $con->query($sql);
      
      print_r($con->error);

      echo $sql;
}


?>