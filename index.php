<?php include('partials-front/menu.php'); ?>

    <!--Cafe search section start-->
    <section class="cafe-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL; ?>beverage-search.php" method="POST">
                <input type="search" name="search" placeholder="Search Caferia">
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!--Cafe search section ends-->

    <?php
        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!--Categories section starts-->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Our Beverages</h2>

            <?php 
                //Create sql query to display categories from db
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                //execute the query
                $res = mysqli_query($conn, $sql);
                //count rows to check if the categories is available or not
                $count = mysqli_num_rows($res);

                if($count>0){
                    //categories available
                    while($row=mysqli_fetch_assoc($res)){
                        //get the values like title, image_name etc.
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                            <a href="<?php echo SITEURL; ?>category-beverages.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">
                                    <?php 
                                        //check image is available or not
                                        if($image_name==""){
                                            //display message
                                            echo "<div class='error'>Image Not Available</div>";
                                        }
                                        else{
                                            //image available
                                            ?>
                                               <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Coffee" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>

                                    <h3 class="float-text text-white text-center"><?php echo $title; ?></h3>
                                </div>
                            </a>

                        <?php
                    }
                }
                else{
                    //categpries not available
                    echo "<div class='error'>Category not Added.</div>";
                }
            ?>

            
         

            <div class="clearfix"></div>
        </div>
    </section>
    <!--Categories section ends-->



    <!--Cafe Menu section start-->
    <section class="cafe-menu">
        <div class="container">
            <h2 class="text-center">Explore Cafe</h2>

            <?php 
            
            //getting beverages from db that are active and featured
            //sql query
            $sql2 = "SELECT * FROM tbl_beverage WHERE active='Yes' AND featured='Yes' LIMIT 6";    
            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            //count rows
            $count2 = mysqli_num_rows($res2);

            //check beverge availble or not
            if($count2>0){
                //beverage available
                while($row=mysqli_fetch_assoc($res2)){
                    //get values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="cafe-menu-box">
                        <div class="cafe-menu-img">
                            <?php
                                //check if image available or not
                                if($image_name==""){
                                    //image not availble
                                    echo "<div class='error'>Image Not Available</div>";
                                }
                                else{
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/beverage/<?php echo $image_name; ?>" alt="Iced Hazelnut Dutch Truffle" class="img-responsive img-curve">
                                    <?php
                                }
                    ?>
                        </div>

                        <div class="cafe-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="cafe-price">$<?php echo $price; ?></p>
                            <p class="cafe-details">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?beverage_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    
                    <?php
                }
            }
            else{
                //beverage not available
                echo "<div class='error'>Beverage Not Available.</div>";
            }

            ?>


            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>beverages.php">See All Beverages</a>
        </p>

    </section>
    <!--Cafe Menu section ends-->

    <?php include('partials-front/footer.php'); ?>