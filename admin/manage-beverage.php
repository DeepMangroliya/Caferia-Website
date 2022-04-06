<?php include('partials/menu.php'); ?>

        <!-- Main Content Section Starts-->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Beverage</h1>

                <br />

                <?php

                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    
                    if(isset($_SESSION['unauthorize'])){
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }

                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['remove-failed'])){
                        echo $_SESSION['remove-failed'];
                        unset($_SESSION['remove-failed']);
                    }

                ?>

            <br /><br><br>

            <!-- Button to add admin -->
            <a href="<?php echo SITEURL; ?>admin/add-beverage.php" class="btn-primary">Add Beverage</a>

            <br /><br /><br />

            <table class="tbl-full">

                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //create a a sql query to get all the beverage
                    $sql = "SELECT * FROM tbl_beverage";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //count rows to check if we have beverages or not
                    $count = mysqli_num_rows($res);

                    //create serial number variable and set value as 1
                    $sn=1;

                    if($count>0){
                        //we have beverage in db
                        //get the beverage from db and display
                        while($row = mysqli_fetch_assoc($res)){
                            //get the values from individual columns
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            ?>

                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td>
                                        <?php 
                                            //check if we have image or not
                                            if($image_name==""){
                                                //we do not have image, display error message
                                                echo "<div class='error'>Image not Added.</div>";
                                            }
                                            else{
                                                //we have image, display image
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/beverage/<?php echo $image_name; ?>" width="100px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-beverage.php?id=<?php echo $id; ?>" class="btn-secondary">Update Beverage</a>
                                        <a href="<?php echo SITEURL;?>admin/delete-beverage.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Beverage</a>
                                    </td>
                                </tr>

                            <?php
                        }
                    }
                    else{
                        //beverage not added in db
                        echo "<tr> <td colspan='7' class='error'> Beverage not Added Yet. </td></tr>";
                    }
                ?>

            </table>

            </div>
        </div>
        <!-- Main Content Section Ends-->

<?php include('partials/footer.php'); ?>