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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   
  
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
   
    <link rel="stylesheet" href="css/bootstrap.min.css">
 
    <link rel="stylesheet" href="css/swiper-bundle.min.css">

  
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
 
    <link rel="stylesheet" href="style.css">
</head>
<body class="body-fixed">
 
    <?php 
    include('adminheader.php');
    ?>

    <div id="viewport">
        <div id="js-scroll-content">
<section class="about-sec section" >
<div class="book-table-shape">
                    <img src="images/table-leaves-shape.png" alt="">
                </div>

                <div class="book-table-shape book-table-shape2">
                    <img src="images/table-leaves-shape.png" alt="">
                </div>
                <?php
	if(isset($_GET['deleteid'])){
        $category_id=$_GET['deleteid'];
        $sql="delete from tbl_Categories where Category_Id='$category_id'";
        $result=mysqli_query($con,$sql);
        if($result){?>
            <script>
                swal({
                title: "Success",
                text: "Deleted successfully !",
                icon: "success",
            })
            .then(function() {
            window.location = "category.php";
            });
            </script>
            <?php }
        else{?>
            <script>
                swal({
                title: "Error !",
                text: "Delete Failed",
                icon: "error",
            }).then(function() {
            window.location = "category.php";
            });
            </script> 
            <?php }
    }
    ?>
  
                </div>       
                                </div>
                                </div>   
</section>


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