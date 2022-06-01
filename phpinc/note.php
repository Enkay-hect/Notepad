<?php

include_once "dbcon.php";
include_once "helpers/create_tables.php";
include_once "user.php";


class Notes
{

 public $category_id;
 public $content;

  public function __construct()
  {
      //$this->create_notes(); 
     
  }

  public function set_categories($category_id)
  {
    $this->category_id = $category_id;
  }

  public function set_content($content)
  {
  $this->content = $content;
  }

  public function create_notes(){

        $creator = new CreateTables;
        $creator->create_notes_table();
   }

      
  public function create_note($category_id, $content)
  {
     $this->set_categories($category_id);
     $this->set_content($content);


      $sql = "INSERT INTO notes (`category_id`, `content`) VALUES ('$this->category_id','$this->content');";
      $host = new DatabaseConnection();
      $con = $host->connect();
      
      $result = $con->query($sql);
     // print_r($con->error);
      return $result;
  } 

  
  
}
$note = new Notes;


if(isset($_POST['save'])){


  $catId = $_POST['category_id'];
  $content = $_POST['content'];

  $note->create_note($catId, $content);
}










?>