<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php

            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>

        <br><br>

        <!--Add Category Form Starts-->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!--Add Category Form Ends-->

        <?php
            
            //check if submit is clicked or not
            if(isset($_POST['submit'])){
                //echo "clicked";
                //get value from the form
                $title = $_POST['title'];
                
                //for radio input type we need to check if the button is clicked or not
                if(isset($_POST['featured'])){
                    //get value from form
                    $featured = $_POST['featured'];
                }
                else{
                    //set the default value
                    $featured = "No";
                }
                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }
                else{
                    $active = "No";
                }

                //check image is selected or not and set the value for image accordingly.
                // print_r($_FILES['image']);

                // die();//Break the code here 

                if(isset($_FILES['image']['name'])){
                    //Upload the image
                    //To Upload image we need image name, source path and destination path 
                    $image_name = $_FILES['image']['name'];

                    //Upload image only if image is selected
                    if($image_name != ""){
                        //Auto Rename our image
                        //Get the extension of image(jpg,png,gif etc)
                        $ext = end(explode('.',$image_name)); 

                        //Rename the image
                        $image_name = "Cafe_Category_".rand(000,999).'.'.$ext; //e.g cafe_category_123.jpg
                        
                        
                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //finally upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //check whether the image is uploaded or not
                        //if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false){
                            //Set message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                            header('location:'.SITEURL.'admin/add-category.php');
                            //Stop the Process
                            die();
                        }
                    }
                }
                else{
                    //Don't upload image and set the image name value as blank
                    $image_name = "";
                }

                //2. SQL query to insert category into database
                $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name= '$image_name',
                featured='$featured',
                active='$active'
                ";

                //3. Execute the query and save in Database
                $res = mysqli_query($conn,$sql);

                //4. Check query is executed or not and data added or not
                if($res==true){
                    //Query Executed & category added
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                    //Redirect to Manage Category Page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else{
                    //failed to add category
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                    //Redirect to Manage Category Page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }

        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>