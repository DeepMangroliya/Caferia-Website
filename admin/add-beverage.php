<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Beverage</h1>

        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br /> <br />

        <form action="" method="POST" enctype="multipart/form-data">
            
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Beverage">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5" placeholder="Description of the Beverage"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php
                                //Create PHP Code to display categories from Database
                                //1. Create SQL to get all active categories from databse
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                //Executing query
                                $res = mysqli_query($conn, $sql);

                                //Count Rows to check if we have categories or not
                                $count = mysqli_num_rows($res);

                                //if count os greater than zero, we have categories else we do not have categories
                                if($count>0){
                                    //we have categories
                                    while($row=mysqli_fetch_assoc($res)){
                                        //get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>
                                        
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else{
                                    //we do not have categories
                                    ?>
                                        <option value="0">No Category Found</option>
                                    <?php
                                }

                                //2. Display on Dropdwon
                            ?>

                        </select>
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
                        <input type="submit" name="submit" value="Add Beverage" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
        
            //check if the button is clicked or not
            if(isset($_POST['submit'])){
                //add the beverage in database
                //echo "ckick";

                //1. Get the data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //Check if radio button for featured and active are checked or not
                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }
                else{
                    $featured = "No"; //setting the default value
                }

                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }
                else{
                    $active = "No"; //setting default value
                }

                //2. Upload the image if selected
                //Check the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name'])){
                    //Get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    //check if image is selected or not and upload image only if selected
                    if($image_name != ""){
                        //image is selected
                        //A. Rename the image
                        //Get the extension of selected image (jpg, png, gif, etc.)
                        $ext = end(explode('.',$image_name)); 

                        //create new name for image
                        $image_name = "Beverage-Name-".rand(0000,9999).".".$ext; //new image name may be "Beverage-Name-123.jpg"

                        //B. Upload the image
                        //Get the Src Path and Destination path

                        //Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        //Destination Path for the image to be uploaded
                        $dst = "../images/beverage/".$image_name;

                        //Upload the beverage image
                        $upload = move_uploaded_file($src, $dst);

                        //check if image uploaded or not
                        if($upload==false){
                            //Failed to upload the image
                            //Redirect to add beverage page with error message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-beverage.php');
                            //stop the process
                            die();
                        }
                    }
                    
                }
                else{
                    $image_name = ""; //Setting default value as blank
                }

                //3. Insert into database

                //Create a sql query to save or add beverage
                $sql2 = "INSERT INTO tbl_beverage SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //check if data inserted ot not
                //4. Redirect with message to manage beverage page
                if($res2 == true){
                    //data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Beverage Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-beverage.php');
                }
                else{
                    //failed to insert data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Beverage.</div>";
                    header('location:'.SITEURL.'admin/manage-beverage.php');
                }

            }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>