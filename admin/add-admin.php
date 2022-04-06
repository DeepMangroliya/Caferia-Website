<?php include('partials/menu.php'); ?>

        <!-- Main Content Section Starts-->
            <div class="main-content">
                <div class="wrapper">
                    <h1>Add Admin</h1>

                    <?php 
                        if(isset($_SESSION['add'])){ //checking session set or not
                            echo $_SESSION['add']; //display session message is set
                            unset($_SESSION['add']);// removing session messge
                        }
                    ?>
                    
                    <br /> <br />

                    <form action="" method="POST">

                        <table class="tbl-30">
                            <tr>
                                <td>Full Name:</td>
                                <td>
                                    <input type="text" name="full_name" placeholder="Enter Your Name">
                                </td>
                            </tr>

                            <tr>
                                <td>Username:</td>
                                <td>
                                    <input type="text" name="username" placeholder="Your Username">
                                </td>
                            </tr>

                            <tr>
                                <td>Password:</td>
                                <td>
                                    <input type="password" name="password" placeholder="Your Password">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">     
                                </td>
                            </tr>
                        </table>

                    </form>
                </div>
            </div>
        <!-- Main Content Section Ends-->

<?php include('partials/footer.php'); ?>

<?php 
                //process the value from form and sae it in database
                
                //check whether the submt button is clicked  or not
            
                if(isset($_POST['submit'])){
                    //button clicked
                    //echo "clicked";

                    //Get data from form
                    $fullname = $_POST['full_name'];
                    $username = $_POST['username'];
                    $password = md5($_POST['password']); //password encryption with md5

                    //SQL Query to save data into database
                    $sql = "INSERT INTO tbl_admin SET
                            full_name = '$fullname',
                            username = '$username',
                            password = '$password'
                    ";

                    $res = mysqli_query($conn, $sql) or die(mysqli_error());

                    //check whether query was successfully executed or not
                    if($res==TRUE){
                        $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
                        //Redirect Page to manage admin
                        header("location:".SITEURL.'admin/manage-admin.php');
                    }
                    else{
                        $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
                        //Redirect Page to manage admin
                        header("location:".SITEURL.'admin/add-admin.php');
                    }
                }
            ?>