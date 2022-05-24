<?php

include_once "dbcon.php";
include_once "helpers/create_tables.php";


class Notes{

 public $categories;
 public $content;

  public function __construct()
  {
      $this->create_notes();
  }

  public function create_notes(){

        $creator = new CreateTables;
        $creator->create_notes_table();
   }

      public function set_categories($categories){
        $this->categories = $categories;
    }

    public function set_content($content){
      $this->content = $content;
  }
}

$note = new Notes
?>