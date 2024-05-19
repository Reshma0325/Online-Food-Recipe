<?php
include 'connection.php';
	if(isset($_GET['editid'])){
        $category_id=$_GET['editid'];
        $sql="select * from tbl_Categories where Category_Id='$category_id'";
        $result=mysqli_query($con,$sql);
        if($result){
            while($row=mysqli_fetch_assoc($result)){
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
</head>
<body class="body-fixed">

    <?php 
    include('adminheader.php');
    ?>

    <div id="viewport">
        <div id="js-scroll-content">
<section class="about-sec section" id="register">
<div class="book-table-shape">
                    <img src="images/table-leaves-shape.png" alt="">
                </div>

                <div class="book-table-shape book-table-shape2">
                    <img src="images/table-leaves-shape.png" alt="">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="sec-title text-center mb-5">
                                <p class="sec-sub-title mb-3">Edit</p>
                        </div>
                <div class="wrap">
        <form action="" method="POST" enctype="multipart/form-data">

            <center>
                <h1 style="text-align:center;">Edit Category</h1>
                <div class="flex">
                    <div class="inputBox">
                    <input type="hidden" value="<?php echo $row['Category_Id']; ?>" name="category_id">
                        <div class="textbox">
                            <i class="uil uil-pizza-slice" style="font-size: 32px; color: black;"></i><input type="text" placeholder="Enter category name" name="category_name" value="<?php echo $row['Category_Name']; ?>" required />
                        </div>
                        </div>
                        <div class="inputBox">
                        <div class="textbox">
                            <label for="image">
                                <i class="uil uil-image" style="font-size: 32px; color: black;"> </i>
                                <font size="3"><b>&nbsp;&nbsp;&nbsp;&nbsp;Category Image&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></font>
                            </label>
                            <img src="<?php echo $row['Category_Image']; ?>" alt="Category Image">
                            <input type="file" name="category_image">
                            <input type="hidden" name="old_category_image" value="<?php echo $row['Category_Image']; ?>">
                        </div>
                        
                    </div>
                </div>
                <?php }
        }
?>
                <br>
                <tr>
                    <td colspan="2" align="center"><input type="submit" class="btn" name="submit" value="Edit Category !"></td>
                    
                </tr>
                
                <br>
                <div class="login">
                    <a style="color:#ff8243;" onclick="history.back()">Go Back !</a>
                </div>

        </form>
    </div>
       <?php } ?> 
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
<?php
if (isset($_POST['submit'])) {
    $category_image = $_FILES['category_image'];
    $old_category_image = $_POST['old_category_image'];
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
  

    if ($_FILES['category_image']['error'] === 0) {
        $imagefilename = $category_image['name'];
        $imagefiletemp = $category_image['tmp_name'];
        $filename_separate = explode('.', $imagefilename);
        $file_extension = strtolower($filename_separate[1]);
        $extension = array('jpeg', 'jpg', 'png');

        if (in_array($file_extension, $extension)) {
            $upload_image = 'images/category/' . $imagefilename;
            move_uploaded_file($imagefiletemp, $upload_image);
        }
    } else {
        $upload_image = $old_category_image;
    }
 
            $query = "UPDATE `tbl_Categories` SET `Category_Name`='$category_name',`Category_Image`='$upload_image' WHERE Category_Id = '$category_id'";
            $update_result = mysqli_query($con, $query);

            if ($update_result) {
                ?>
                <script>
                    swal({
                        title: "Success",
                        text: "Category edited Successfully!",
                        icon: "success",
                    }).then(function () {
                        window.location = "category.php";
                    });
                </script>
            <?php
            } else {
                ?>
                <script>
                    swal({
                        title: "Alert !",
                        text: "Update failed",
                        icon: "error",
                    }).then(function () {
                        window.location = "category.php";
                    });
                </script>
            <?php
            }
        } 


?>

