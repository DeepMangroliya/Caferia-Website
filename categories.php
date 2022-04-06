<?php include('partials-front/menu.php'); ?>
    
    <!--Categories section starts-->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Our Beverages</h2>

            <?php

                //display all the categories that are active
                //sql query
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                //execute the query
                $res = mysqli_query($conn, $sql);
                //count rows
                $count = mysqli_num_rows($res);

                //check categories available or not
                if($count>0){
                    //categories available
                    while($row=mysqli_fetch_assoc($res)){
                        //get values
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                            <a href="<?php echo SITEURL; ?>category-beverages.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">
                                    <?php 
                                    
                                        if($image_name==""){
                                            //image not availble
                                            echo "<div class='error'>Image Not Found.</div>";
                                        }
                                        else{
                                            //image available
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Coffee" class="img-responsive img-curve">
                                            <?php
                                        }
                                    
                                    ?>
                                    

                                    <h3 class="float-text text-white text-center"><?php echo$title; ?></h3>
                                </div>
                            </a>

                        <?php
                    }
                }
                else{
                    //category not available
                    echo "<div class='error'>Category Not Found.</div>";
                }

            ?>

            

            <div class="clearfix"></div>
        </div>
    </section>
    
    <?php include('partials-front/footer.php'); ?>