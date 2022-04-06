<?php

    //start session
    session_start();
    
    //create constants to store non repeating values
    define('SITEURL', 'http://localhost:8080/cafe/'); 
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'cafe');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //DB connection
    $db_select = mysqli_select_db($conn,    DB_NAME) or die(mysqli_error());
?>