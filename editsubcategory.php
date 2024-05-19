<?php
include 'connection.php';

if(isset($_GET['editid'])){
    $subcategory_id=$_GET['editid'];
    $sql="select * from `tbl_Subcategories` where Subcategory_Id='$subcategory_id'";
      $result=mysqli_query($con,$sql);
      if($result){
          while($row=mysqli_fetch_assoc($result)){
            $query ="SELECT Category_Id,Category_Name FROM tbl_Categories";
            $result = $con->query($query);
            if($result->num_rows> 0){
              $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
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
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="sec-title text-center mb-5">
                                <p class="sec-sub-title mb-3">Update</p>
                        </div>
                <div class="wrap">
        <form action="" method="POST" enctype="multipart/form-data">

            <center>
                <h1 style="text-align:center;">Edit Subcategory</h1>
                <div class="flex">
                    <div class="inputBox">
                    <input type="hidden" value="<?php echo $row['Subcategory_Id']; ?>" name="subcategory_id">
                    <div class="textbox">
    		                    <i class="uil uil-subject" style="font-size:32px; color:black;"></i><input type="text" placeholder="Enter Subcategory Name" value="<?php echo $row['Subcategory_Name']; ?>" name="subcategory_name" required/>
  		                        </div>
                                  <tr>
                                <i class="uil uil-pizza-slice" style="font-size:32px; color:black;"></i>
                                
      		                    <td align="right"><font size="3"><b>Category Id&nbsp;:&nbsp;</b></font></td>
    	                        <td>
		                        <select name="category_id" style="width: 10em; height: 2em; font-size: 15px; ">
                                <option value="<?php echo $row['Category_Id']; ?>"><?php echo $row['Category_Id']; ?></option>
                                    <?php 
                                    foreach ($options as $option) {
                                    ?>
                                    <option><?php echo $option['Category_Id'];?>&nbsp;<?php echo $option['Category_Name']; ?> </option>
                                    <?php 
                                    }
                                    ?>
                              
                                </select>
      	                        </td>
  		                        </tr>
                        </div>
                        <div class="inputBox">
                        <div class="textbox">
                        <label for="image">
                                <i class="uil uil-image" style="font-size: 32px; color: black;">  </i>
                                <font size="3"><b>&nbsp;&nbsp;&nbsp;&nbsp;Subategory Image&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></font>
                                </label>
                            <img src="<?php echo $row['Subcategory_Image']; ?>" alt="Subcategory Image">
                            <input type="file" name="subcategory_image">
                            <input type="hidden" name="old_subcategory_image" value="<?php echo $row['Subcategory_Image']; ?>">
                        </div>
                       
                    </div>
                </div>

                <br>
                <tr>
                    <td colspan="2" align="center"><input type="submit" class="btn" name="submit" value="Subcategory !"></td>
                    
                </tr>
                
                <br>
                <div class="login">
                    <a style="color:#ff8243;" onclick="history.back()">Go Back !</a>
                </div>

        </form>
    </div>
       <?php }
       }
     } ?> 
                                </div>       
                                </div>
                                </div>   
</section>
 <!-- footer starts  -->
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
    $subcategory_image = $_FILES['subcategory_image'];
    $old_subcategory_image = $_POST['old_subcategory_image'];
    $subcategory_id = $_POST['subcategory_id'];
    $subcategory_name = $_POST['subcategory_name'];
    $category_id = $_POST['category_id'];
   

    if ($_FILES['subcategory_image']['error'] === 0) {
        $imagefilename = $subcategory_image['name'];
        $imagefiletemp = $subcategory_image['tmp_name'];
        $filename_separate = explode('.', $imagefilename);
        $file_extension = strtolower($filename_separate[1]);
        $extension = array('jpeg', 'jpg', 'png');

        if (in_array($file_extension, $extension)) {
            $upload_image = 'images/subcategory/' . $imagefilename;
            move_uploaded_file($imagefiletemp, $upload_image);
        }
    } else {
        $upload_image = $old_subcategory_image;
    }
  
            $query = "UPDATE `tbl_Subcategories` SET `Subcategory_Name`='$subcategory_name',`Category_Id`='$category_id',`Subcategory_Image`='$upload_image' WHERE Subcategory_Id = '$subcategory_id'";
            $update_result = mysqli_query($con, $query);

            if ($update_result) {
                ?>
                <script>
                    swal({
                        title: "Success",
                        text: "Subcategory Updated Successfully!",
                        icon: "success",
                    }).then(function () {
                        window.location = "subcategory.php";
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
                    });
                </script>
            <?php
            }
        } 
   
?>
