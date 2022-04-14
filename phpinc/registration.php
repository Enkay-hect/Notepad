<?php
    include_once 'dbcon.php';

    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO `users`(`firstname`, `lastname`, `email`, `password`) VALUES('$firstname','$lastname','$email','$password')";
    mysqli_query($conn,$sql);
    header("Location: ../");
;