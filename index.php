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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <style>
        .pagination {
    display: flex;
    list-style: none;
    padding: 0;
    justify-content: center;
}

.pagination a {
    color: #333;
    text-decoration: none;
    padding: 8px 12px;
    margin: 0 4px;
    border: 1px solid #ccc;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.pagination a:hover {
    background-color: #eee;
}
    </style>
    <script>
 function showSubcategories(categoryId) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("subcategories-container").innerHTML = this.responseText;
            showRecipesForCategory(categoryId);
        }
    };
    xmlhttp.open("GET", "get_subcategories.php?category_id=" + categoryId, true);
    xmlhttp.send();
}

function showRecipesForCategory(categoryId) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("recipes-container").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "get_recipes.php?category_id=" + categoryId, true);
    xmlhttp.send();
}



function showRecipesForSubcategory(subcategoryId) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("recipes-container").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "get_recipes.php?subcategory_id=" + subcategoryId, true);
    xmlhttp.send();
}
function showLoginAlert() {
    Swal.fire({
        title: "Warning!",
        text: "You need to login first,to view the recipes..",
        icon: "warning"
    }).then(function() {
        window.location.href = "login.php";
    });
}

</script>
</head>
<body class="body-fixed">
    <?php 
    include('header.php');
    ?>

  <div id="viewport" style="overflow-y: auto;
    max-height: 100vh; ">
        <div id="js-scroll-content">
            <section class="main-banner" id="home">
                <div class="js-parallax-scene">
                    <div class="banner-shape-1 w-100" data-depth="0.30">
                        <img src="images/blackberry.png" alt="">
                    </div>
                    <div class="banner-shape-2 w-100" data-depth="0.25">
                        <img src="images/slicepizza.png" alt="">
                    </div>
                    
                </div>
                <div class="sec-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="banner-text">
                                    <h1 class="h1-title">
                                        Welcome to our
                                        <span>Delicious Delight</span>
                                        .
                                    </h1>
                                    <p><b>"A Culinary Exploration - Unveiling the Art of Recipes".</b></p>
                                    <div class="banner-btn mt-4">
                                        <a href="#menu" class="sec-btn">Check our Recipe</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="banner-img-wp">
                                    <div class="banner-img" style="background-image: url(images/bg2.jpg);">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="about-sec section" id="about">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sec-title text-center mb-5">
                                <p class="sec-sub-title mb-3">About Us</p>
                                <h2 class="h2-title">Discover our <span>Food Recipes</span></h2>
                                <div class="sec-title-shape mb-4">
                                    <img src="images/title-shape.svg" alt="">
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 m-auto">
                            <div class="about-video">
                                <div class="about-video-img" style="background-image: url(images/about.jpg); width:730px;">
                                </div>
                                <div class="play-btn-wp">
                                    <a href="images/video.mp4" data-fancybox="video" class="play-btn">
                                        <i class="uil uil-play"></i>

                                    </a>
                                    <span>Watch The Recipe</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section style="background-image: url(images/menu-bg.png);" class="our-menu section bg-light repeat-img" id="menu">
                    <div class="sec-wp">

                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="sec-title text-center mb-5">
                                        <h2 class="h2-title">wake up early, <span>eat fresh & healthy</span></h2>
                                        <div class="sec-title-shape mb-4">
                                            <img src="assets/images/title-shape.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                                <div id="recipes-container">
                                    <?php 
                                    $recipesPerPage = 6;
                                    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $offset = ($currentPage - 1) * $recipesPerPage;

                                    $recipe_query = "SELECT * FROM tbl_recipes JOIN tbl_recipeimages ON tbl_recipes.Recipe_ID = tbl_recipeimages.Recipe_ID LIMIT $offset, $recipesPerPage";
                                    $recipe_result = mysqli_query($con, $recipe_query);

                                
                                    if (mysqli_num_rows($recipe_result) > 0) {
                                        ?>
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
                                                        <img src="<?php echo $recipeimage; ?>" alt="<?php echo $recipe_name; ?>" style="width: 260px; height: 260px;">
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
                                                            
                                            <a href="#" onclick="showLoginAlert()" class="header-btn" style="width: 110px;color:#ffffff; background: linear-gradient(145deg, #ffc954, #ffbc00);box-shadow: inset 4px 4px 8px #d6a029, inset -4px -4px 8px #ffd837;">View Recipe</a>
                
                                                            </li>
                                                            
                                                        </ul>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="pagination">
                                        <?php
                                        $totalRecipesQuery = "SELECT COUNT(*) as total FROM tbl_recipes";
                                        $totalRecipesResult = mysqli_query($con, $totalRecipesQuery);
                                        $totalRecipes = mysqli_fetch_assoc($totalRecipesResult)['total'];
                                        $totalPages = ceil($totalRecipes / $recipesPerPage);

                                  
                                        for ($i = 1; $i <= $totalPages; $i++) {
                                            echo "<a href='?page=$i'>$i</a> ";
                                        }
                                        ?>
                                    </div>
                            <?php
                            } 
                        
                            ?>
                        </div>
                    </div>
                </section>
            

            <section class="book-table section bg-light">                
                <div class="sec-wp">
                    <div class="container">
                        <div class="row" id="gallery">
                            <div class="col-lg-10 m-auto">
                                <div class="book-table-img-slider" id="icon">
                                    <div class="swiper-wrapper">
                                        <a href="images/bt1.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(images/bt1.jpg)"></a>
                                        <a href="images/bt2.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(images/bt2.jpg)"></a>
                                        <a href="images/bt3.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(images/bt3.jpg)"></a>
                                        <a href="images/bt4.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(images/bt4.jpg)"></a>
                                        <a href="images/bt1.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(images/bt1.jpg)"></a>
                                        <a href="images/bt2.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(images/bt2.jpg)"></a>
                                        <a href="images/bt3.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(images/bt3.jpg)"></a>
                                        <a href="images/bt4.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(images/bt4.jpg)"></a>
                                    </div>

                                    <div class="swiper-button-wp">
                                        <div class="swiper-button-prev swiper-button">
                                            <i class="uil uil-angle-left"></i>
                                        </div>
                                        <div class="swiper-button-next swiper-button">
                                            <i class="uil uil-angle-right"></i>
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
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