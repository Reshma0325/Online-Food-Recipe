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
    <div id="viewport" style="overflow-y: auto; max-height: 100vh; ">
        <div id="js-scroll-content">
<section class="about-sec section" id="register">
<section style="background-image: url(images/menu-bg.png);" class="our-menu section bg-light repeat-img" id="menu">
                    <div class="sec-wp">

                        <div class="container">
                         
                        <?php
                            $recipe_query = "SELECT * FROM tbl_recipes 
JOIN tbl_recipeimages ON tbl_recipes.Recipe_ID = tbl_recipeimages.Recipe_ID 
JOIN tbl_payments ON tbl_recipes.Recipe_ID = tbl_payments.Recipe_ID 
WHERE tbl_payments.User_Id = '$publisher_id'";

                            
                            $recipe_result = mysqli_query($con, $recipe_query);

                            if (mysqli_num_rows($recipe_result) > 0) {
                                ?>
                                <div class="row g-xxl-5 bydefault_show" id="menu-dish">
                                    <?php
                                    while ($recipe = mysqli_fetch_assoc($recipe_result)) {
                                        $recipe_id = $recipe['Recipe_Id'];
                                        $recipe_name = $recipe['Recipe_Name'];
                                      
                                        $recipeimage = $recipe['Image_Url'];
                                        $status = $recipe['Status'];
                                        ?>
                                        <div class="col-lg-4 col-sm-6 dish-box-wp breakfast" data-cat="breakfast">
                                            <div class="dish-box text-center">
                                                <div class="dist-img">
                                                    <img src="<?php echo $recipeimage; ?>" alt="<?php echo $recipe_name; ?>"
                                                        style="width: 260px; height: 260px;">
                                                </div>
                                               
                                                <div class="dish-title">
                                                    <h3 class="h3-title"><?php echo $recipe_name; ?></h3>
                                               
                                                </div>
                                                
                                                            
                                                            <div class="dish-info" style="line-height: 10px;">
                                                            <b><p>Our Commission  :<span style="color:#ff8243;">  ₹100/- </span></p></b>
                                                        </div>
                                                        <b><p>Status  :<span style="color:#ff8243;">  <?php echo $status; ?> </span></p></b>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            <?php
                            } else {
                                echo "No recipes available";
                            }
                            ?>
                        </div>
                    </div>
                </section>
            </section>
            <?php include('footer.php'); ?>
           
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
    <!-- smooth scroll  -->
    <script src="js/smooth-scroll.js"></script>
    <!-- custom js  -->
    <script src="main.js"></script>

</body>

</html>