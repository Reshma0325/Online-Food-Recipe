<?php
include 'connection.php';
session_start();
$advertiser_id = $_SESSION['advertiser_id'];
if(!isset($advertiser_id)){
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
   <script src="sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/swiper-bundle.min.css">    
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="body-fixed">
    <?php 
    include('advertiserheader.php');
    ?>
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
                    <h1 style="text-align: center;"><b>Tips to Upload Advertisements</b></h1>
                </center>
                <br>
                <p>• Once you register with us by filling in the basic information, click on 'ADD ADVERTISEMENT'. Upload an advertisement, providing the necessary information for each.</p>
                <p>• We add our commission of ₹100 for every advertisement you upload.</p>
                <br>
                <h5 style="font-weight: bold;"><span><b>Tips for Uploading Advertisement:</b></span></h5><br>
                
                    <p>• Start with a catchy headline that grabs attention and clearly states the purpose of the advertisement, such as "Delicious Recipes Await! Join Us Today!".</p>
                    <p>• Use a clear and compelling call-to-action that encourages viewers to take action.</p>
                    <p>• If you have any questions, feel free to contact us at <u style="color: #0088cc;">reshma@gmail.com</u>.</p>
                
                <br>
                <h5 style="font-weight: bold;"><span><b>Tips before You Share Your Advertisement:</b></span></h5><br>
                
                    <p>• Double-check your details for accuracy and completeness.</p>
                    <p>• Include high-quality images of the recipes or dishes to entice viewers. Make sure the images are appealing and relevant to the recipes being advertised.</p>
                
                <br>
            </div>
        </div>
    </div>
</div>
        
        </section>   
        
        <?php 
    include('footer.php');
    ?>
        </div>
    </div>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/font-awesome.min.js"></script>
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/jquery.mixitup.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/parallax.min.js"></script>
    <script src="js/gsap.min.js"></script>
    <script src="js/ScrollTrigger.min.js"></script>
    <script src="js/ScrollToPlugin.min.js"></script>
    <script src="js/smooth-scroll.js"></script>
    <script src="main.js"></script>


</body>

</html>