<?php include('partials-front/menu.php'); ?>

    <?php 
        //check if id is passed or not
        if(isset($_GET['category_id'])){
            //category id is set and get the id
            $category_id = $_GET['category_id'];
            //get category title based on category if
            $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //get value from db
            $row = mysqli_fetch_assoc($res);
            //get the title
            $category_title = $row['title'];
        }
        else{
            //category not passed
            //redirect to home page
            header('location:'.SITEURL);
        }
    ?>

    <!--Cafe search section start-->
    <section class="cafe-search text-center">
            <div class="container">
                <?php ?>
                <h2 class="cream">Beverages on <a href="#" class="text-white">"<?php echo $category_title;?>"</a></h2>
            </div>
    </section>
    <!--Cafe search section ends-->


    <!--Cafe Menu section start-->
    <section class="cafe-menu">
        <div class="container">
            <h2 class="text-center">Beverage Menu</h2>

            <?php

                //sql query to get beverage based on selected category
                $sql2 = "SELECT * FROM tbl_beverage WHERE category_id=$category_id";
                //execute query
                $res2 = mysqli_query($conn, $sql2);
                //count rows
                $count2 = mysqli_num_rows($res2);
                //check if beverage is available or not
                if($count2>0){
                    //beverage is available
                    while($row2=mysqli_fetch_assoc($res2)){
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>

                            <div class="cafe-menu-box">
                                <div class="cafe-menu-img">
                                    <?php
                                        if($image_name==""){
                                            //image not available
                                            echo "<div class='error'>Image Not Available.</div>";
                                        }
                                        else{
                                            //image available
                                            ?>  
                                            <img src="<?php echo SITEURL;?>images/beverage/<?php echo $image_name; ?>" alt="Iced Hazelnut Dutch Truffle" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                </div>

                                <div class="cafe-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="cafe-price">$<?php echo $price; ?></p>
                                    <p class="cafe-details"><?php echo $description; ?></p>
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
    </section>
    <!--Cafe Menu section ends-->

    <?php include('partials-front/footer.php') ?>