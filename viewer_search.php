<?php
include 'connection.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Recipe</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@latest"></script>
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
    include('viewerheader.php');
    ?>
    <!-- header ends  -->
    <div id="viewport" style="overflow-y: auto; max-height: 100vh; ">
        <div id="js-scroll-content">
<section class="about-sec section" id="register">
<section style="background-image: url(images/menu-bg.png);" class="our-menu section bg-light repeat-img" id="menu">
                    <div class="sec-wp">

                        <div class="container">
                    <?php        
                        if(isset($_GET['search'])){
    $search = $_GET['search'];
  
    $recipe_query ="SELECT * FROM tbl_recipes JOIN tbl_recipeimages ON tbl_recipes.Recipe_ID = tbl_recipeimages.Recipe_ID WHERE (`Recipe_Name` LIKE '%$search%')";
    $recipe_result = mysqli_query($con, $recipe_query); 
                         if(mysqli_num_rows($recipe_result) == 0) {
        ?>
        <script>
            Swal.fire({
                title: 'No Recipes Found!',
                text: 'Sorry, no recipes matched your search criteria.',
                icon: 'info'
            }).then(function() {
                window.location = "recipe.php";
                });
        </script>
        <?php
    }
    else { ?>
                       
                                <div class="row g-xxl-5 bydefault_show" id="menu-dish">
                                    <?php
                                    while ($recipe = mysqli_fetch_assoc($recipe_result)) {
                                        $recipe_id = $recipe['Recipe_Id'];
                                        $recipe_name = $recipe['Recipe_Name'];
                                        $servings = $recipe['Servings'];
                                        $preparation_time = $recipe['Preparation_Time'];
                                        $cooking_time = $recipe['Cooking_Time'];
                                        $recipeimage = $recipe['Image_Url'];
                                        $rating = $recipe['Average_Rating'];
                                        ?>
                                        <div class="col-lg-4 col-sm-6 dish-box-wp breakfast" data-cat="breakfast">
                                            <div class="dish-box text-center">
                                                <div class="dist-img">
                                                    <img src="<?php echo $recipeimage; ?>" alt="<?php echo $recipe_name; ?>"
                                                        style="width: 260px; height: 260px;">
                                                </div>
                                                <div class="dish-rating">
                                                      
                                                        
                                                      <i class="uil uil-star">&nbsp;<?php echo $rating; ?></i>
                                                  </div>
                                                <div class="dish-title">
                                                    <h3 class="h3-title"><?php echo $recipe_name; ?></h3>
                                                    <p><?php echo $servings; ?> servings</p>
                                                </div>
                                                <div class="dish-info">
                                                    <ul>
                                                        <li>
                                                            <p>preparation</p>
                                                            <b><?php echo $preparation_time; ?></b>
                                                        </li>
                                                        <li>
                                                            <p>cooking</p>
                                                            <b><?php echo $cooking_time; ?></b>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="dist-bottom-row" style="display: flex; justify-content: center;">
                                                    <ul>
                                                       
                                        <li>
                                        <a href="viewrecipe.php?viewid=<?php echo $recipe['Recipe_Id'];?>" class="header-btn" style="width: 110px;color:#ffffff; background: linear-gradient(145deg, #ffc954, #ffbc00);box-shadow: inset 4px 4px 8px #d6a029, inset -4px -4px 8px #ffd837;">View Recipe</a>       
                                        </li>
                                        
                                                            
                                                        
                                                       
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            <?php
                            } 
                        } 
                            ?>
                            <div class="login text-center">
                    <a style="color:#ff8243;" onclick="history.back()">Go Back !</a>
                </div>
                 
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