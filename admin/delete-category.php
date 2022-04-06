<?php
    //include contansts file
    include('../config/constants.php');
    //Check whether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        //get the value and delete
        //echo "Get value and delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical image file if available
        if($image_name != ""){
            //image is available, remove it
            $path = "../images/category/".$image_name;
            //remove the image from folder
            $remove = unlink($path);

            //if failed to remove image then add an error message and stop the process
            if($remove==false){
                //set the session message
                $_SESSION['remove'] ="<div class='error'>Failed to Remove Category Image.</div>";
                //redirect to manage category
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the process
                die();
            }
        }

        //delete data from db
        //sql query to delete data from db
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //execute the query
        $res = mysqli_query($conn,$sql);

        //check data is deleted from db or not
        if($res==true){
            //set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else{
            //set fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else{
        //redirect to manage category page
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>