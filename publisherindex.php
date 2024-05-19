<?php
include 'connection.php';
session_start();
$publisher_id = $_SESSION['publisher_id'];
if(!isset($publisher_id)){
   header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Recipe</title>
    <!-- for icons  -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- bootstrap  -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- for swiper slider  -->
    <link rel="stylesheet" href="css/swiper-bundle.min.css">

    <!-- fancy box  -->
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <!-- custom css  -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="body-fixed">
    <!-- start of header  -->
    <?php 
    include('publisherheader.php');
    ?>
    <!-- header ends  -->
    <div id="viewport">
        <div id="js-scroll-content">
<section class="about-sec section" id="register">
<div class="book-table-shape">
                    <img src="images/table-leaves-shape.png" alt="">
                </div>

                <div class="book-table-shape book-table-shape2">
                    <img src="images/table-leaves-shape.png" alt="">
                </div>

                <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="wrap" style="text-align: justify;">
                <center>
                    <h1 style="text-align: center;"><b>Tips to Upload Recipes</b></h1>
                </center>
                <br>
                <p>• Once you register with us by filling in the basic information, click on 'ADD RECIPE'. Upload all your recipes one by one, providing the necessary information for each.</p>
                <p>• We add our commission of ₹100 for every recipe you upload.</p>
                <br>
                <h5 style="font-weight: bold;"><span><b>Tips for Uploading Recipes:</b></span></h5><br>
                
                    <p>• Ensure that you provide clear and detailed instructions for each recipe.</p>
                    <p>• Mention any special ingredients or techniques used in your recipes.</p>
                    <p>• If you have any questions, feel free to contact us at <u style="color: #0088cc;">reshma@gmail.com</u>.</p>
                
                <br>
                <h5 style="font-weight: bold;"><span><b>Tips before You Share Your Recipes:</b></span></h5><br>
                
                    <p>• Double-check your recipe details for accuracy and completeness.</p>
                    <p>• Make sure your recipes are original and not copied from other sources.</p>
                
                <br>
            </div>
        </div>
    </div>
</div>

        </section>   
        
            <!-- footer starts  -->
    <?php 
    include('footer.php');
    ?>
        </div>
    </div>
    <!-- jquery  -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <!-- bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>

    <!-- fontawesome  -->
    <script src="js/font-awesome.min.js"></script>

    <!-- swiper slider  -->
    <script src="js/swiper-bundle.min.js"></script>

    <!-- mixitup -- filter  -->
    <script src="js/jquery.mixitup.min.js"></script>

    <!-- fancy box  -->
    <script src="js/jquery.fancybox.min.js"></script>

    <!-- parallax  -->
    <script src="js/parallax.min.js"></script>

    <!-- gsap  -->
    <script src="js/gsap.min.js"></script>

    <!-- scroll trigger  -->
    <script src="js/ScrollTrigger.min.js"></script>
    <!-- scroll to plugin  -->
    <script src="js/ScrollToPlugin.min.js"></script>
    <!-- rellax  -->
    <!-- <script src="assets/js/rellax.min.js"></script> -->
    <!-- <script src="assets/js/rellax-custom.js"></script> -->
    <!-- smooth scroll  -->
    <script src="js/smooth-scroll.js"></script>
    <!-- custom js  -->
    <script src="main.js"></script>

</body>

</html>