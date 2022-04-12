<?php
 $servername = "localhost";
 $username = "Enkay";
 $password = "07080987528";
 $database = "notepad";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>