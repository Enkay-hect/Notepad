<?php

include_once "note.php";

public function create_note()
{
    $sql = "INSERT INTO `notes` (`category_id`, `content`) 
           VALUES ('$category_id','$content')";
    $host = new DatabaseConnection();
    $con = $host->connect();
    $result = $con->query($sql);
    return $result;
}
  

?>