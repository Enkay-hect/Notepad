<?php

include_once "dbcon.php";


class Users{

 protected $categories;
 protected $content;

      function __construct()
      {
          $this->create_notes();
      }

      function create_notes(){

        $creator = new CreateTables;
        $creator->create_users_note()();
      }

      public function set_categories($categories){
        $this->categories = $categories;
    }

    public function set_content($content){
      $this->content = $content;
  }
}
?>