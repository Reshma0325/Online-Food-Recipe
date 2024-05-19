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
    <style>
        .header-search-form-wrapper {
    display: flex;
    justify-content: center;
}

.search-input-wrapper {
    display: flex;
    align-items: center;
    border-radius: 20px;
    overflow: hidden;
}

.form-input {
    border: none;
    padding: 10px 20px;
    flex: 1;
}

button {
    background-color: #fff;
    border: none;
    padding: 10px;
    cursor: pointer;
}
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
    <!-- start of header  -->
    <?php 
    include('adminheader.php');
    ?>
    <!-- header ends  -->
    <div id="viewport" style="overflow-y: auto; max-height: 100vh; ">
        <div id="js-scroll-content">
<section class="about-sec section" id="register">
<div style="display: flex; align-items: center;">
                <input type="button" class="btn" value="Print" onclick="window.print()" style="display: block; margin: 0 auto; width: 150px;">
</div>
                                 <br><br>

<div class="sec-wp">

                        <div class="container"><?php
    if(isset($_POST['submit'])){
    $from = $_POST['from'];
    $to = $_POST['to'];
  
   

    $recipe_query = "SELECT * FROM tbl_recipes 
    JOIN tbl_recipeimages ON tbl_recipes.Recipe_ID = tbl_recipeimages.Recipe_ID
    JOIN tbl_payments ON tbl_recipes.Recipe_ID = tbl_payments.Recipe_ID 
    WHERE tbl_payments.Placed_On BETWEEN '$from' AND '$to'";
    $recipe_result = mysqli_query($con, $recipe_query);

                         if(mysqli_num_rows($recipe_result) == 0) {
        ?>
        <script>
            Swal.fire({
                title: 'No Records Found!',
                text: 'Sorry, no Records found between the dates.',
                icon: 'info'
            }).then(function() {
                window.location = "admin_payment.php";
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
                                 $placed_on = $recipe['Placed_On'];
                                 $user_id = $recipe['User_Id'];

                                 
                         ?>
                                    
                                     <div class="col-lg-4 col-sm-4 dish-box-wp breakfast" data-cat="breakfast">
                    <div class="dish-box text-center">
                        <div class="dist-img">
                            <img src="<?php echo $recipeimage; ?>" alt="<?php echo $recipe_name; ?>" style="width: 200px; height: 200px;">
                        </div>
                        <div class="dish-title">
                            <h5 class="h5-title"><?php echo $recipe_name; ?></h5>
                        </div>
                        <div class="dish-info">
                            <p>User_Id: &nbsp;&nbsp; <b><?php echo $user_id; ?></b></p>
                            <p>Placed On: &nbsp;&nbsp; <b><?php echo $placed_on; ?></b></p>
                            <p>Status: &nbsp;&nbsp; <b><?php echo $recipe['Status']; ?></b></p>
                        </div>
                        <form id="updateForm<?php echo $recipe_id; ?>">
                            <input type="hidden" name="recipe_id" value="<?php echo $recipe_id; ?>">
                            <select name="update_payment" style="width: 200px; height:40px;">
                                <option value="" selected disabled><?php echo $recipe['Status']; ?></option>
                                <option value="₹ 100 is credited">credited</option>
                                <option value="pending">pending</option>
                            </select>
                            <button type="button" onclick="updatePayment(<?php echo $recipe_id; ?>)" class="header-btn"><i class="uil uil-edit"></i></button>
                        </form>
                        <div class="dist-bottom-row" style="display: flex; justify-content: center;"></div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="login text-center">
            <a style="color:#ff8243;" onclick="history.back()">Go Back!</a>
        </div>
        

        <script>
            function updatePayment(recipeId) {
                var formData = $('#updateForm' + recipeId).serialize();
                $.ajax({
                    type: 'POST',
                    url: 'update_payment.php',
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Payment status has been updated!',
                            icon: 'success'
                        }).then(function() {
                            // Reload the page to show updated data
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        </script>

<?php
    }
}
?>
                 
                        </div>
                    </div>
                   
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
