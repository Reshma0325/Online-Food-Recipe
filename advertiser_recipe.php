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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
   
    <link rel="stylesheet" href="css/bootstrap.min.css">
  
    <link rel="stylesheet" href="css/swiper-bundle.min.css">

 
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

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
    xmlhttp.open("GET", "advertiserget_subcategories.php?category_id=" + categoryId, true);
    xmlhttp.send();
}

function showRecipesForCategory(categoryId) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("recipes-container").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "advertiserget_recipes.php?category_id=" + categoryId, true);
    xmlhttp.send();
}



function showRecipesForSubcategory(subcategoryId) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("recipes-container").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "advertiserget_recipes.php?subcategory_id=" + subcategoryId, true);
    xmlhttp.send();
}



   
</script>
</head>
<body class="body-fixed">



    <?php 
    include('advertiserheader.php');
    ?>

    <div id="viewport" style="overflow-y: auto; max-height: 100vh; ">
        <div id="js-scroll-content">
            <section class="about-sec section">

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
                            <div class="menu-tab-wp">
                                <div class="row">
                                    <div class="col-lg-12 m-auto">
                                        <div class="menu-tab text-center">&nbsp;
                                            <ul class="filters">
                                                <div class="filter-active"></div>
                                                <?php
                                                $category_query = "SELECT * FROM tbl_categories";
                                                $category_result = mysqli_query($con, $category_query);
                                                if (mysqli_num_rows($category_result) > 0) {
                                                    while ($category = mysqli_fetch_assoc($category_result)) {
                                                        $category_id = $category['Category_Id'];
                                                        $category_name = $category['Category_Name'];
                                                        $category_image = $category['Category_Image'];
                                                ?>
                                                        <li class="filter" data-filter=".category-<?php echo $category_id; ?>" onclick="showSubcategories('<?php echo $category_id; ?>')">
                                                            <img src="<?php echo $category_image; ?>" alt="<?php echo $category_name; ?>" style="width: 50px; height: 40px;"> 
                                                            <p style="font-size: 14px; margin: 55px 0 0; position: absolute; color: black;"><?php echo $category_name; ?></p>
                                                        </li>
                                                <?php
                                                    }
                                                } else {
                                                    echo "<li>No categories available</li>";
                                                }
                                                ?>
                                            </ul>
                                           
                                            <div id="subcategories-container"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <?php
                                if (!isset($_GET['category_id']) && !isset($_GET['subcategory_id'])) {
                            ?>
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
                                                    <div class="dist-bottom-row">
                                                    <ul>
                                                        <li>     
                                                            <a href="add_advertisement.php?addid=<?php echo $recipe['Recipe_Id'];?>" class="header-btn" style="width: 165px;color:#ffffff; background: linear-gradient(145deg, #ffc954, #ffbc00);box-shadow: inset 4px 4px 8px #d6a029, inset -4px -4px 8px #ffd837;">Add Advertisement</a>
                                                        </li>
                                                        <li>
                                                            <a href="advertiser_viewrecipe.php?viewid=<?php echo $recipe['Recipe_Id']; ?>" class="header-btn"><i class="uil uil-eye"></i></a>
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
                            } else {
                                echo "No recipes available";
                            }
                        }
                            ?>
                        </div>
                    </div>
                </section>
            </section>

            <?php 
            include('footer.php');
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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