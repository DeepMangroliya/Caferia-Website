<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--important to make website responsive-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caferia-Categories</title>
    <link rel="icon" href="C:\xampp\htdocs\cafe\images\favicon.ico">
    <script src="https://kit.fontawesome.com/c542dfd2c8.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>  
    <!--Navbar section start-->
    <section class="navbar" id="navbar">
        <div class="container">
            <div class="logo">
                <a href="index.php"><img src="images/Logo2Final.png" alt="Cafe Logo" class="img-responsive"></a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>aboutus.php">About Us</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>beverages.php">Beverages</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>contact.php">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!--Navbar section ends-->