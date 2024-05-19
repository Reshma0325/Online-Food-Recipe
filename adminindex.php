<?php
include 'connection.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
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
    <style>
.styled-button {   
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    border: 2px solid #000000; 
    color: #ff8243; 
    border-radius: 5px;
    transition: background-color 0.3s;
}
.styled-button:hover {
    letter-spacing: .2rem;
}
.dish-boxes {
    border-radius: 30px;
    background: linear-gradient(145deg, #ececec, #ffffff);
    box-shadow: 28px 28px 45px #d4d4d4, -28px -28px 45px #ffffff;
    display: flow-root;
    transition: 0.8s cubic-bezier(0.22, 0.78, 0.45, 1.02);
}
.dish-boxes:hover {
    transform: scale(1.03);
}
.recipes-box-img {
    width: 50px; 
    height: 50px; 
    border-radius: 50%;
    margin-top: -15px; 
    box-shadow: 10px 10px 60px #d4d4d4;
    margin-left: auto;
    margin-right: auto;
    display: block;
}

    </style>
</head>
<body class="body-fixed">

    <?php 
    include('adminheader.php');

    $sql="select count(Recipe_Id) from tbl_recipes";
    $result=mysqli_query($con, $sql);
    $recipe=mysqli_fetch_array($result);
    $recipe_count = array_shift($recipe);

    $sql1="select count(Category_Id) from tbl_categories";
    $result1=mysqli_query($con, $sql1);
    $category=mysqli_fetch_array($result1);
    $category_count = array_shift($category);

    $sql2="select count(Subcategory_Id) from tbl_subcategories";
    $result2=mysqli_query($con, $sql2);
    $subcategory=mysqli_fetch_array($result2);
    $subcategory_count = array_shift($subcategory);

    $sql3="select count(User_Id) from tbl_users where User_Type ='viewer'";
    $result3=mysqli_query($con, $sql3);
    $viewer=mysqli_fetch_array($result3);
    $viewer_count = array_shift($viewer);

    $sql4="select count(User_Id) from tbl_users where User_Type='publisher'";
    $result4=mysqli_query($con, $sql4);
    $publisher=mysqli_fetch_array($result4);
    $publisher_count = array_shift($publisher);

    $sql5="select count(User_Id) from tbl_users where User_Type='advertiser'";
    $result5=mysqli_query($con, $sql5);
    $advertiser=mysqli_fetch_array($result5);
    $advertiser_count = array_shift($advertiser);

    $payment1="select count(Payment_Id) from tbl_payments where Status ='pending'";
    $payment_result=mysqli_query($con, $payment1);
    $payment_pending_1=mysqli_fetch_array($payment_result);
    $payment_pending_count1 = array_shift($payment_pending_1);

    $payment2="select count(Payment_Id) from tbl_payments where Status ='₹ 100  is credited'";
    $payment_result2=mysqli_query($con, $payment2);
    $payment_pending_2=mysqli_fetch_array($payment_result2);
    $payment_pending_count2 = array_shift($payment_pending_2);

    $payment3="select count(Payment_Id) from tbl_payments";
    $payment_result3=mysqli_query($con, $payment3);
    $payment_pending_3=mysqli_fetch_array($payment_result3);
    $payment_pending_count3 = array_shift($payment_pending_3);

   
    ?>

    <div id="viewport">
        <div id="js-scroll-content">
<section class="about-sec section" >
    <div class="sec-wp">
  
        <div class="container">
            <div class="row">
            <div class="col-lg-2">
                <br> <br>
                <div class="dish-boxes text-center">      
                    <div class="recipes-box-img back-img">
                        <img src="images/sushi.png" alt="" style="background-position: 5px 1px; width: 60px; height:50px;border-radius:50%;">
                    </div>
                    <a href="recipes.php"><h6 class="h6-title">Recipes</h6></a>
                    <p><b><?php echo $recipe_count; ?></b></p>
                </div>
            </div>
            <div class="col-lg-2">
                <br> <br>
                <div class="dish-boxes text-center">      
                    <div class="recipes-box-img back-img">
                        <img src="images/dish/1.png" alt="" style="background-position: 5px 1px; width: 60px; height:50px;border-radius:50%;">
                    </div>
                    <a href="category.php"><h6 class="h6-title">Categories</h6></a>
                    <p><b><?php echo $category_count; ?></b></p>
                </div>
            </div>
            <div class="col-lg-2">
                <br> <br>
                <div class="dish-boxes text-center">      
                    <div class="recipes-box-img back-img">
                        <img src="images/dish/4.png" alt="" style="background-position: 5px 1px; width: 60px; height:50px;border-radius:50%;">
                    </div>
                    <a href="subcategory.php"><h6 class="h6-title">Subcategories</h6></a>
                    <p><b><?php echo $subcategory_count; ?></b></p>
                </div>
            </div>
            <div class="col-lg-2">
                <br> <br>
                <div class="dish-boxes text-center">      
                    <div class="recipes-box-img back-img">
                        <img src="images/users/t11.jpg" alt="" style="background-position: 5px 1px; width: 60px; height:50px;border-radius:50%;">
                    </div>
                    <a href="admin_viewers.php"><h6 class="h6-title">Viewers</h6></a>
                    <p><b><?php echo $viewer_count; ?></b></p>
                </div>
            </div>
            
            <div class="col-lg-2">
                <br> <br>
                <div class="dish-boxes text-center">      
                    <div class="recipes-box-img back-img">
                        <img src="images/users/t5.jpg" alt="" style="background-position: 5px 1px; width: 60px; height:50px;border-radius:50%;">
                    </div>
                    <a href="admin_publishers.php"><h6 class="h6-title">Publishers</h6></a>
                    <p><b><?php echo $publisher_count; ?></b></p>
                </div>
            </div>
            <div class="col-lg-2">
                <br> <br>
                <div class="dish-boxes text-center">      
                    <div class="recipes-box-img back-img">
                        <img src="images/users/t8.jpg" alt="" style="background-position: 5px 1px; width: 60px; height:50px;border-radius:50%;">
                    </div>
                    <a href="admin_advertisers.php"><h6 class="h6-title">Advertisers</h6></a>
                    <p><b><?php echo $advertiser_count; ?></b></p> 
                </div>
            </div>
            
            </div>

            <div class="row">
            <div class="col-lg-4">
                <br> <br>
                <div class="dish-boxes text-center">      
                    <div class="recipes-box-img back-img">
                        <img src="images/dish/2.png" alt="" style="background-position: 5px 1px; width: 60px; height:50px;border-radius:50%;">
                    </div>
                    <a href="payment_pending_report.php"><h6 class="h6-title">Payment Pending<br>Report</h6></a>
                    <p><b><?php echo $payment_pending_count1; ?></b></p>
                </div>
            </div>
            <div class="col-lg-4">
                <br> <br>
                <div class="dish-boxes text-center">      
                    <div class="recipes-box-img back-img">
                        <img src="images/dish/5.png" alt="" style="background-position: 5px 1px; width: 60px; height:50px;border-radius:50%;">
                    </div>
                    <a href="payment_completed_report.php"><h6 class="h6-title">Payment Completed<br>Report</h6></a>
                    <p><b><?php echo $payment_pending_count2; ?></b></p>
                </div>
            </div>
            <div class="col-lg-4">
                <br> <br>
                <div class="dish-boxes text-center">      
                    <div class="recipes-box-img back-img">
                        <img src="images/dish/3.png" alt="" style="background-position: 5px 1px; width: 60px; height:50px;border-radius:50%;">
                    </div>
                    <a href="total_payments_report.php"><h6 class="h6-title">Total Payments<br>Report</h6></a>
                    <p><b><?php echo $payment_pending_count3; ?></b></p>
                </div>
            </div>
            
            </div>
            
            <div class="row">
            <div class="col-lg-3">
                <br> <br>
                <div class="dish-boxes text-center">      
                    <div class="recipes-box-img back-img">
                        <img src="images/dish/1.png" alt="" style="background-position: 5px 1px; width: 60px; height:50px;border-radius:50%;">
                    </div>
                    <a href="category_report.php"><h6 class="h6-title">Category / Subcategory <br>Report</h6></a>
                    <br>
                </div>
            </div>
            <div class="col-lg-3">
                <br> <br>
                <div class="dish-boxes text-center">      
                    <div class="recipes-box-img back-img">
                        <img src="images/dish/6.png" alt="" style="background-position: 5px 1px; width: 60px; height:50px;border-radius:50%;">
                    </div>
                    <a href="publisher_report.php"><h6 class="h6-title">Publishers Recipes<br>Report</h6></a>
                    <br>
                </div>
            </div>
            <div class="col-lg-3">
                <br> <br>
                <div class="dish-boxes text-center">      
                    <div class="recipes-box-img back-img">
                        <img src="images/main-b.jpg" alt="" style="background-position: 5px 1px; width: 60px; height:50px;border-radius:50%;">
                    </div>
                    <a href="day_to_day_report.php"><h6 class="h6-title">Day To Day Recipes<br>Report</h6></a>
                    <br>
                </div>
            </div>
            <div class="col-lg-3">
                <br> <br>
                <div class="dish-boxes text-center">      
                    <div class="recipes-box-img back-img">
                        <img src="images/pizza.png" alt="" style="background-position: 5px 1px; width: 60px; height:50px;border-radius:50%;">
                    </div>
                    <a href="day_report.php"><h6 class="h6-title">Particular Day Recipes<br>Report</h6></a>
                    <br>
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