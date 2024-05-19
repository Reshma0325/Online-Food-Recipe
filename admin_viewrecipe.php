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
            <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
            <link rel="stylesheet" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="css/swiper-bundle.min.css">
            <link rel="stylesheet" href="css/jquery.fancybox.min.css">
            <link rel="stylesheet" href="style.css">
            <style>
                .nutritional-information {
                    display: flex;
                    flex-wrap: wrap;
                }

                .nutrient-box {
                    flex: 1;
                    padding: 6px;
                    box-sizing: border-box;
                    border: 1px solid #fff;
                    text-align: center;
                    font-size: 11px;
                    background-color: #ffc933;
                }
                .reviews .overall_rating .num {
                    font-size: 30px;
                    font-weight: bold;
                    color: #F5A624;
                }

                .reviews .overall_rating .stars {
                    Letter-spacing: 3px;
                    font-size: 32px;
                    color: #F5A624;
                    padding: 0 5px 0 10px;
                }

                .reviews .overall_rating .total {
                    color: #777777;
                    font-size: 14px;
                }

                .reviews .write_review_btn, .reviews .write_review button {
                    display: inline-flex;
                    background-color: #565656;
                    color: #fff;
                    text-decoration: none;
                    margin: 10px 0 0 0;
                    padding: 5px 10px;
                    border-radius: 5px;
                    font-size: 14px;
                    font-weight: 600;
                    border: 0;
                }

                .reviews .write_review_btn:hover, .reviews .write_review button:hover {
                    background-color: #636363;
                }

                .reviews .con {
                    display: flex;
                    align-items: center;
                }

                .reviews .con span {
                    flex: 1;
                }

                .reviews .con label {
                    font-weight: 600;
                    padding: 0 10px;
                    font-size: 14px;
                }

                .write_review {
        display: none; /* Hide the review textbox by default */
                }
            </style>
           
        </head>

        <body class="body-fixed">
            <?php include('adminheader.php'); ?>
            <?php
if (isset($_GET['viewid'])) {
    $recipeid = $_GET['viewid'];
    function time_elapsed_string($datetime, $full = false) {
        date_default_timezone_set('Asia/Kolkata'); // Set the timezone to match the server's timezone
        $now = new DateTime();
        $ago = new DateTime($datetime);
        $diff = $now->getTimestamp() - $ago->getTimestamp();
    
        if ($diff < 60) {
            return 'just now';
        } elseif ($diff < 3600) {
            $minutes = floor($diff / 60);
            return $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago';
        } elseif ($diff < 86400) {
            $hours = floor($diff / 3600);
            return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
        } else {
            $days = floor($diff / 86400);
            return $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
        }
    }
    $offset = 0;
    $limit = '';
    if (isset($_GET['current_pagination_page'], $_GET['reviews_per_pagination_page'])) {
        $offset = ($_GET['current_pagination_page'] - 1) * $_GET['reviews_per_pagination_page'];
        $limit = 'LIMIT ' . $offset . ', ' . $_GET['reviews_per_pagination_page'];
    }
    
    $sort_by = 'ORDER BY Placed_On DESC';
    
    if (isset($_GET['sort_by'])) {
        switch ($_GET['sort_by']) {
            case 'newest':
                $sort_by = 'ORDER BY Placed_On DESC';
                break;
            case 'oldest':
                $sort_by = 'ORDER BY Placed_On ASC';
                break;
            case 'rating_highest':
                $sort_by = 'ORDER BY Rating_Value DESC';
                break;
            case 'rating_lowest':
                $sort_by = 'ORDER BY Rating_Value ASC';
                break;
            default:
                $sort_by = 'ORDER BY Placed_On DESC';
                break;
        }
    }
    

 
    $stmt = $con->prepare('SELECT * FROM tbl_ratings WHERE Recipe_Id = ? ' . $sort_by . ' ' . $limit);
    $stmt->bind_param('i', $_GET['viewid']);
    $stmt->execute();
    $reviews = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  
    $stmt = $con->prepare('SELECT AVG(Rating_Value) AS overall_rating, COUNT(*) AS total_reviews FROM tbl_ratings WHERE Recipe_Id = ?');
    $stmt->bind_param('i', $_GET['viewid']);
    $stmt->execute();
    $reviews_info = $stmt->get_result()->fetch_assoc();
    
    $recipeQuery = "SELECT * FROM tbl_recipes WHERE Recipe_Id = '$recipeid'";
    $recipeResult = mysqli_query($con, $recipeQuery);

    if ($recipeResult) {
        $recipe = mysqli_fetch_assoc($recipeResult);

        $imageQuery = "SELECT * FROM tbl_recipeimages WHERE Recipe_Id = '$recipeid'";
        $imageResult = mysqli_query($con, $imageQuery);
        $recipe['images'] = mysqli_fetch_all($imageResult, MYSQLI_ASSOC);

        $stepsQuery = "SELECT * FROM tbl_recipesteps WHERE Recipe_Id = '$recipeid'";
        $stepsResult = mysqli_query($con, $stepsQuery);
        $recipe['steps'] = mysqli_fetch_all($stepsResult, MYSQLI_ASSOC);

        $ingredientsQuery = "SELECT * FROM tbl_recipeingredients WHERE Recipe_Id = '$recipeid'";
        $ingredientsResult = mysqli_query($con, $ingredientsQuery);
        $recipe['ingredients'] = mysqli_fetch_all($ingredientsResult, MYSQLI_ASSOC);

        $nutritionQuery = "SELECT * FROM tbl_nutritions WHERE Recipe_Id = '$recipeid'";
        $nutritionResult = mysqli_query($con, $nutritionQuery);
        $recipe['nutrition'] = mysqli_fetch_assoc($nutritionResult);
        ?>
            <div id="viewport">
                <div id="js-scroll-content">
                    <section class="about-sec section">
                        <div class="book-table-shape">
                            <img src="images/table-leaves-shape.png" alt="">
                        </div>
                        <div class="book-table-shape book-table-shape2">
                            <img src="images/table-leaves-shape.png" alt="">
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="wrap">
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <center>
                                                <div class="flex">
                                                    <div class="inputBox">
                                                        <?php foreach ($recipe['images'] as $image) { ?>
                                                            <img src="<?php echo $image['Image_Url']; ?>" alt="Recipe Image"><br><br><br>
                                                        <?php } ?>
                                                       

                                                        <button class="dish-add-btn" style="width:90px;" onclick="window.print();">
                                                            <i class="uil uil-print"></i> Print
                                                        </button><br><br>
                                                        <h5 class="h5-title">Ingredients</h5><br>
                                                        <?php foreach ($recipe['ingredients'] as $ingredient) { ?>
                                                            <div class="recipe-container">
                                                                <b>• </b><?php echo $ingredient['Ingredient_Name']; ?><br><br>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="inputBox">
                                                        <h3 class="h3-title"><?php echo $recipe['Recipe_Name']; ?></h3>
                                                        <br>
                                                        <p><b><i class="uil uil-clock" style="font-size: 22px; color: black;line-height:10px;"> </i> Prep : </b>
                                                            <?php echo $recipe['Preparation_Time']; ?> </p>
                                                        <p><b><i class="uil uil-stopwatch" style="font-size: 29px; color: black;line-height:10px;"></i>Cook :</b>
                                                            <?php echo $recipe['Cooking_Time']; ?></p>
                                                        <p><b><i class="uil uil-tag" style="font-size: 22px; color: black;line-height:10px;"></i>&nbsp;Servings :</b>
                                                            <?php echo $recipe['Servings']; ?></p>
                                                        <p><b>Nutrition : Per serving</b>
                                                            <div class="nutritional-information">
                                                                <div class="nutrient-box">
                                                                    kcal <?php echo $recipe['nutrition']['Kcal']; ?>
                                                                </div>
                                                                <div class="nutrient-box">
                                                                    fat <?php echo $recipe['nutrition']['Fat']; ?>
                                                                </div>
                                                                <div class="nutrient-box">
                                                                    saturates <?php echo $recipe['nutrition']['Saturates']; ?>
                                                                </div>
                                                                <div class="nutrient-box">
                                                                    carbs <?php echo $recipe['nutrition']['Carbs']; ?>
                                                                </div>
                                                                <div class="nutrient-box">
                                                                    sugars <?php echo $recipe['nutrition']['Sugars']; ?>
                                                                </div>
                                                                <div class="nutrient-box">
                                                                    fibre <?php echo $recipe['nutrition']['Fibre']; ?>
                                                                </div>
                                                                <div class="nutrient-box">
                                                                    protein <?php echo $recipe['nutrition']['Protein']; ?>
                                                                </div>
                                                                <div class="nutrient-box">
                                                                    salt <?php echo $recipe['nutrition']['Salt']; ?>
                                                                </div>
                                                            </div><br>
                                                            <h5 class="h5-title">Steps</h5><br>
                                                            <?php foreach ($recipe['steps'] as $step) { ?>
                                                                <div class="recipe-container">
                                                                    <b>• </b><?php echo $step['Step_Name']; ?><br><br>
                                                                </div>
                                                            <?php } ?>
                                                    </div>
                                                </div>
                                                <?php if (!empty($recipe['Recipe_Video'])) { ?>
                                                    <video width="100%" height="auto" controls autoplay muted loop>
                                                        <source src="<?php echo $recipe['Recipe_Video']; ?>" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                <?php } ?>
                                                <br>
                                                <div class="reviews">
                                            <div class="overall_rating">
                                                <span class="num"><?=number_format($reviews_info['overall_rating'], 1)?></span>
                                                <span class="stars"><?=str_repeat('&#9733;', round($reviews_info['overall_rating']))?></span>
                                                <span class="total"><?=$reviews_info['total_reviews']?> reviews</span>
                                            </div>
                                                </div>
                                                <div class="con" style=" position: relative;float: right;">
                                             
                                                <span></span>
                                                <label for="sort_by">Sort By</label>
                                                <select class="sort_by" id="sort_by" name="sort_by">
                                                    <option value="newest"<?=isset($_GET['sort_by']) && $_GET['sort_by'] == 'newest' ? 'selected' : ''?>>Newest</option>
                                                    <option value="oldest"<?=isset($_GET['sort_by']) && $_GET['sort_by'] == 'oldest' ? 'selected' : ''?>>Oldest</option>
                                                    <option value="rating_highest"<?=isset($_GET['sort_by']) && $_GET['sort_by'] == 'rating_highest' ? 'selected' : ''?>>Rating - High to Low</option>
                                                    <option value="rating_lowest"<?=isset($_GET['sort_by']) && $_GET['sort_by'] == 'rating_lowest' ? 'selected' : ''?>>Rating - Low to High</option>
                                                </select>
                                            </div><script>
                                            document.addEventListener("DOMContentLoaded", function () {

    const sortSelect = document.getElementById('sort_by'); // Fetch the select element

  

    sortSelect.addEventListener('change', function () {
        // Redirect to the same page with the sort_by parameter in the URL
        window.location.href = window.location.pathname + '?viewid=<?php echo $_GET['viewid']; ?>&sort_by=' + this.value;
    });
});

                                            </script><br>
                                                                                        <?php foreach ($reviews as $review): ?>
                                                <div class="review" style="text-align:left;">
                                                    <h3 class="name"><?=htmlspecialchars($review['User_Name'], ENT_QUOTES)?></h3>
                                                    <div>
                                                        <span class="rating"><?=str_repeat('&#9733;', $review['Rating_Value'])?></span>
                                                        <span class="date"><?=time_elapsed_string($review['Placed_On'])?></span>
                                                    </div>
                                                    <p class="content"><?=htmlspecialchars($review['Comments'], ENT_QUOTES)?></p>
                                                </div>
                                            <?php endforeach; ?>
                                            <?php if ($limit && $reviews_info['total_reviews'] > $_GET['reviews_per_pagination_page']): ?>
                                            <div class="pagination">
                                                <?php if ($_GET['current_pagination_page'] > 1): ?>
                                                    <a href="#" data-pagination_page="<?=$_GET['current_pagination_page']-1?>" data-records_per_page="<?=$_GET['reviews_per_pagination_page']?>">Prev</a>
                                                <?php endif; ?>
                                                <div>Page <?=$_GET['current_pagination_page']?></div>
                                                <?php if ($_GET['current_pagination_page'] * $_GET['reviews_per_pagination_page'] < $reviews_info['total_reviews']): ?>
                                                    <a href="#" data-pagination_page="<?=$_GET['current_pagination_page']+1?>" data-records_per_page="<?=$_GET['reviews_per_pagination_page']?>">Next</a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>


                                            <br>
                                                
                                                <div class="login">
                                                    <a style="color:#ff8243;" onclick="history.back()">Go Back !</a>
                                                </div>
                                            </center>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Footer -->
                    <?php include('footer.php'); ?>
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
    <?php
    } else {
        // Handle query failure
        echo "Error executing the recipe query: " . mysqli_error($con);
    }
}
?>
