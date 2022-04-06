<?php
    //Include constants.php file here
    include('../config/constants.php');

    //1.get the id of admin to be deleted
    $id = $_GET['id'];

    //2.create SQL query to delete admon
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //check whether the query executed successfully or not
    if($res==true){
        //query executed successfull and admin deleted
        //echo "Admin Deleted";
        //Create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        //Failed to delete admin
        //echo "Failed to Delete Admin";
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    //3. redirect to manage admin page with message(Success/error)


?>