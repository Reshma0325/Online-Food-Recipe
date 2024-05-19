<?php
include 'connection.php';
session_start();
$sql="select * from `tbl_Users` where User_Id = $_SESSION[viewer_id]";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$image=$row['User_Image'];
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
    include('viewerheader.php');
    ?>

    <div id="viewport">
    <div id="js-scroll-content">
        <section class="about-sec section" id="register">
        <section class="testimonials section bg-light">
            <div class="sec-wp">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            
                        </div>
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="testimonials-box">
                                        <div class="testimonial-box-top">
                                        <div class="testimonials-box-img back-img" style="background-image: url('<?php echo $image; ?>');background-position: 15px 5px; width: 150px; height:150px; "></div>

                                        </div>
                                        <div class="testimonials-box-text">
                                            <h4 class="h4-title">User Name : 
                                            <b style="color:#ff8243;"><?php echo $_SESSION['viewer_name']; ?></b>
                                            </h4>
                                            <h4 class="h4-title">Email : 
                                            <b style="color:#ff8243;"><?php echo $_SESSION['viewer_mail']; ?></b>
                                            </h4><br>
                                            <h5 class="h5-title">
                                            <a href="updateviewer.php" class="header-btn"><i class="uil uil-edit"></i></a>&nbsp;&nbsp; Update Profile
                                            </h5><br>
                                            <h5 class="h5-title">
                                            <a href="logout.php" class="header-btn"><i class="uil uil-signout"></i></a>&nbsp;&nbsp; Sign Out
                                            </h5>                                          
                                        </div>
                                    </div>
                                </div>                                  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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


