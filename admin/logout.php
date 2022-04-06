<?php
    //Include constants.php for SITEURL
    include('../config/constants.php');
    //1.Destroy session
    session_destroy(); //unsets $_SESSION['user']

    //2. Redirect to Login Page
    header('location:'.SITEURL.'admin/login.php');

?>