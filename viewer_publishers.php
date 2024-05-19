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

</head>
<body class="body-fixed">



    <?php 
    include('viewerheader.php');
    ?>

    <div id="viewport" style="overflow-y: auto; max-height: 100vh; ">
        <div id="js-scroll-content">
            <section class="about-sec section">
            <div class="sec-title text-center mb-5">
                                <p class="sec-sub-title mb-3">Publishers</p>
                        </div>
                        <div class="container">
                                <div id="recipes-container">
                                    <?php 
                                    $publishersPerPage = 6;
                                    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $offset = ($currentPage - 1) * $publishersPerPage;

                                    $recipe_query = "SELECT * FROM tbl_users where  User_Type = 'publisher' LIMIT $offset, $publishersPerPage";
                                    $recipe_result = mysqli_query($con, $recipe_query);

                                
                                    if (mysqli_num_rows($recipe_result) > 0) {
                                        ?>
                                        <div class="row g-xxl-5 bydefault_show" id="menu-dish">
                                            <?php
                                        while ($recipe = mysqli_fetch_assoc($recipe_result)) {
                                         
                                            $user_id = $recipe['User_Id'];
                                            $user_name = $recipe['User_Name'];
                                            $user_mail = $recipe['User_Mail'];
                                            $user_joined_on = $recipe['User_Joined_On'];
                                            $user_image = $recipe['User_Image'];

                                            
                                    ?>
                               
                                            
                                    
                                            <div class="col-lg-4 col-sm-6 dish-box-wp breakfast" data-cat="breakfast">
                                                <div class="dish-box ">
                                                    <div class="testimonials-box-img back-img">
                                                        <img src="<?php echo $user_image; ?>" alt="<?php echo $user_name; ?>" style="background-position: 5px 1px; width: 150px; height:150px;float: left;border-radius:50%;">
                                                    </div><br>
                                                    <h6 class="h6-title"><b style="color:#ff8243;">Name : </b>
                                            <?php echo $user_name; ?>
                                            </h6>
                                            <h6 class="h6-title"><b style="color:#ff8243;">Mail : </b>
                                            <?php echo $user_mail; ?>
                                            </h6>
                                                   
                                                  <br>
                                                    <div class="dist-bottom-row" style="display: flex; justify-content: center;">
                                                        <ul>
                                                            <li>
                                                            
                                            <a href="publishers_recipe.php?viewid=<?php echo $recipe['User_Id'];?>" class="header-btn" style="width: 110px;color:#ffffff; background: linear-gradient(145deg, #ffc954, #ffbc00);box-shadow: inset 4px 4px 8px #d6a029, inset -4px -4px 8px #ffd837;">View Recipe</a>
                
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
                                        $totalRecipesQuery = "SELECT COUNT(*) as total FROM tbl_users where User_Type='publisher'";
                                        $totalRecipesResult = mysqli_query($con, $totalRecipesQuery);
                                        $totalRecipes = mysqli_fetch_assoc($totalRecipesResult)['total'];
                                        $totalPages = ceil($totalRecipes / $publishersPerPage);


                                        for ($i = 1; $i <= $totalPages; $i++) {
                                            echo "<a href='?page=$i'>$i</a> ";
                                        }
                                        ?>
                                    </div>
                                    
                            <?php
                            } 
                        
                            ?>
                        </div>
                   
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