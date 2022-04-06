<?php include('../config/constants.php');?>

<html>
    <head>
        <title>Login - Caferia</title>
        <style><?php include('../css/admin.css'); ?></style>
    </head>
    
    <body class="login-admin-body">
        <section class="login-admin">
            <div class="login"> 
                <h1 class="text-center">LOGIN</h1>
                <br><br>

                <?php
                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }

                    if(isset($_SESSION['no-login-message'])){
                        echo $_SESSION['no-login-message'];
                        unset($_SESSION['no-login-message']);
                    }
                ?>

                <br><br>
                <!--Login Form Starts Here-->
                <form action="" method="POST" class="text-center">
                    <label>Username:</label><br>
                    <input type="text" name="username" placeholder="Enter username"><br><br>
                    <label>Password:</label><br>
                    <input type="password" name="password" placeholder="Enter Password"><br><br>

                    <input type="submit" name="submit" value="Login" class="btn-login"><br><br>
                </form>
                <!--Login Form Ends Here-->

                <p class="text-center">Created By - <a href="#">Deep Mangroliya</a></p>

            </div>
        </section>
    </body>
</html>

<?php
    //check submit is clicked or not
    if(isset($_POST['submit'])){
        //1. get data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. SQl to check the user with username and passwrod exits or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute the Query
        $res = mysqli_query($conn,$sql);

        //4. Count the rows to check user exists or not
        $count = mysqli_num_rows($res);
        if($count==1){
            //user exists
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; //to check the user is logged in or not and logout will unset it.

            //redirect to home page/dashboard
            header('location:'.SITEURL.'admin/');
        }
        else{
            //user does not exists
            $_SESSION['login'] = "<div class='error text-center'>Incorrect Username Or Password.</div>";
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>