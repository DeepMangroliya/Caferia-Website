<?php include('partials-front/menu.php'); ?>

    <?php 
        //check beverage is set or not
        if(isset($_GET['beverage_id'])){
            //get the beverage id and details of the selected beverage
            $beverage_id = $_GET['beverage_id'];

            //get details of selected beverage
            $sql = "SELECT * FROM tbl_beverage WHERE id=$beverage_id";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count the rows
            $count = mysqli_num_rows($res);
            //check if details available or not
            if($count==1){
                //we have data
                $row=mysqli_fetch_assoc($res);
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else{
                //beverage not available
                //redirect to home
                header('location:'.SITEURL);
            }
        }
        else{
            //redirect to homepage
            header('location:'.SITEURL);
        }
    ?>

    <!-- beverage search section starts here -->
    <section class="cafe-search">
        <div class="container">

            <h2 class="text-center text-white" style="color: #E5BEB5">Fill This Form to Confirm Your Order.</h2>

            <form action="" method="POST" class="order">
                <fieldset class="outer-fielset">
                    <legend style="color: #CEA49B">Selected Beverage</legend>

                    <div class="order-cafe-menu-img">
                        <?php 
                        if($image_name==""){
                            //image not avaialbe
                            echo "<div class='error'>Image Not Available.</div>";
                        }
                        else{
                            //Image available
                            ?>
                              <img src="<?php echo SITEURL; ?>images/beverage/<?php echo $image_name; ?>" alt="Iced Mocha" class="order-img-responsive img-curve">
                            <?php
                        }
                        ?>      
                        <div class="order-cafe-menu-desc">
                        <h3 style="color: #ffffff"><?php echo $title; ?></h3>
                        <input type="hidden" name="beverage" value='<?php echo $title; ?>'>
                        <p class="beverage-price" style="color: #ffffff">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value='<?php echo $price; ?>'>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>

                    </div>              
                    </div>

                    

                <fieldset class="inner-fielset">
                    <legend style="color: #CEA49B">Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Deep Mangroliya" class="input-responsive" required>
               
                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 8780xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@deepmangroliya.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" cols="30" rows="2" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
                        <br>
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">

                </fieldset>
            </form>
            <?php
            
                        //check if submit is clicked or not
                        if(isset($_POST['submit'])){
                            //get details
                            $beverage = $_POST['beverage'];
                            $price = $_POST['price'];
                            $qty = $_POST['qty'];

                            $total = $price * $qty;

                            $order_date = date("Y-m-d h:i:sa"); // prder date

                            $status = "Ordered"; //ordered on delivery, delevired, cancelled

                            $customer_name = $_POST['full-name'];
                            $customer_contact = $_POST['contact'];
                            $customer_email = $_POST['email'];
                            $customer_address = $_POST['address'];

                            //save the order in db
                            //create sql query
                            $sql2 = "INSERT INTO tbl_order SET
                                beverage = '$beverage',
                                price = $price,
                                qty = $qty,
                                total = $total,
                                order_date = '$order_date',
                                status = '$status',
                                customer_name = '$customer_name',
                                customer_contact = '$customer_contact',
                                customer_email = '$customer_email',
                                customer_address = '$customer_address'
                            ";
                            //echo $sql2 or die();
                            //execute
                            $res2 = mysqli_query($conn, $sql2);

                            //check if executed or not
                            if($res2==true){
                                //query executed and ordered saev
                                $_SESSION['order'] = "<div class='success text-center'>Beverage Ordered Successfully.</div>";
                                header('location:'.SITEURL);
                            }
                            else{
                                //failed to save order
                                $_SESSION['order'] = "<div class='error text-center'>Failed to Order Beverage.</div>";
                                header('location:'.SITEURL);
                            }
                        }        

            ?>
        </div>
    </section>

<?php include('partials-front/footer.php'); ?>