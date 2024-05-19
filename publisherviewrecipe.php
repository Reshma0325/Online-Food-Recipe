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
                            $recipe_query = "SELECT * FROM tbl_recipes JOIN tbl_recipeimages ON tbl_recipes.Recipe_ID = tbl_recipeimages.Recipe_ID WHERE User_Id = '$publisher_id'";
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
                                                <div class="dist-bottom-row">
                                                    <ul>
                                                       
                                        <li>
                                        <a href="view.php?viewid=<?php echo $recipe['Recipe_Id'];?>" class="header-btn" style="width: 110px;color:#ffffff; background: linear-gradient(145deg, #ffc954, #ffbc00);box-shadow: inset 4px 4px 8px #d6a029, inset -4px -4px 8px #ffd837;">View Recipe</a>       
                                        </li>
                                        <li>
                                                    
                                                    <a href="editrecipe.php?editid=<?php echo $recipe['Recipe_Id']; ?>" class="header-btn"><i class="uil uil-edit"></i></a>
                                                </li>
                                        <li>
                                            <div class="header-btn">
                                            <a href="deleterecipe.php?deleteid=<?php echo $recipe['Recipe_Id'];?>" class="del-btn"><i class="uil uil-trash"></i></a>
                                    </div>
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
    <?php
if(isset($_GET['m'])){
?>
    <div class="flash-data" data-flashdata="<?php echo $_GET['m'] ?>"></div>
<?php
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
    $('.del-btn').on('click', function (e) {
        e.preventDefault();

        const href = $(this).attr('href');

        Swal.fire({
            title: 'Are you sure to delete?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                
                window.location.href = href;
            }
        });
    });

    const flashdata = $('.flash-data').data('flashdata');
    if (flashdata) {
        Swal.fire({
            icon: 'success',
            title: 'Record Deleted',
            text: 'Record has been deleted successfully!'
        });
    }
</script>

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