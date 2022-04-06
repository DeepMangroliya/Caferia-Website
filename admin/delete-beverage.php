<?php
    //include constants page
    include('../config/constants.php');

    //echo "del";

    if(isset($_GET['id']) && isset($_GET['image_name'])){
        //process to delete
        //echo "pRO";

        //1. Get ID and iamge name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remove the image if available
        //check if image is available or not and delete only if available
        if($image_name != ""){
            //it has image and need to remove from folder
            //get the image path
            $path = "../images/beverage/".$image_name;

            //remove image file from folder
            $remove = unlink($path);

            //check if image is removed or not
            if($remove==false){
                //failed to remove image
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image.</div>";
                //redirect to manage beverage
                header('location:'.SITEURL.'admin/manage-beverage.php');
                //stop the process of deleting beverage
                die();
            }
        }

        //3. Delete Beverage from db
        $sql = "DELETE FROM tbl_beverage WHERE id=$id";
        //execute the query
        $res = mysqli_query($conn, $sql);

        //check if query is executed ot not and set session message respectively
        if($res==true){
            //beverage deleted
            $_SESSION['delete'] = "<div class='success'>Beverage Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-beverage.php');
        }
        else{
            //failed to delete beverage
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Beverage.</div>";
            header('location:'.SITEURL.'admin/manage-beverage.php');
        }

        //4.Redirect to manage beverage with session message
    }
    else{
        //redirect to manage beverage page
        //echo "red";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-beverage.php');
    }

?>