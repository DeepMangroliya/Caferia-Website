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




    <!--Cafe Menu section start-->
    <section class="cafe-menu">
        <div class="container">
            <h2 class="text-center">Beverage Menu</h2>

            <?php 
            
                //display beverages that are active
                $sql = "SELECT * FROM tbl_beverage WHERE active='Yes'";
                //execute the query
                $res = mysqli_query($conn,$sql);
                //count rows
                $count = mysqli_num_rows($res);
                //check if beverage is available or not
                if($count>0){
                    //beverage available
                    while($row=mysqli_fetch_assoc($res)){
                        //get values
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>

                            <div class="cafe-menu-box">
                                <div class="cafe-menu-img">
                                    <?php
                                        //check if image availble or not
                                        if($image_name==""){
                                            //image not avavilble
                                            echo "<div class='error'>Image Not Available.</div>";
                                        }
                                        else{
                                            //image available
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
                    //bevearage not avaialble
                    echo "<div class='error'>Beverage Not Found</div>";
                }
            
            ?>
            
           
            <div class="clearfix"></div>
        </div>
    </section>
    <!--Cafe Menu section ends-->

<?php include('partials-front/footer.php'); ?>