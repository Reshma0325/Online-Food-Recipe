<?php
include 'connection.php';
session_start();
 $res = mysqli_query($con, "SELECT * FROM `tbl_Users` WHERE User_Id=$_SESSION[advertiser_id]") or die('query failed');
                                if(mysqli_num_rows($res) > 0){
                                $row = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Recipe</title>
     <!--- sweetalert cdn link --->  
   <script src="sweetalert.min.js"></script>
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
    include('advertiserheader.php');
    ?>
    <!-- header ends  -->
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
                                <p class="sec-sub-title mb-3">Update</p>
                        </div>
                <div class="wrap">
        <form action="" method="POST" enctype="multipart/form-data">

            <center>
                <h1 style="text-align:center;">Update Profile</h1>
                <div class="flex">
                    <div class="inputBox">
                    <input type="hidden" value="<?php echo $row['User_Id']; ?>" name="user_id">
                        <div class="textbox">
                            <i class="uil uil-user" style="font-size: 32px; color: black;"></i><input type="text" placeholder="Enter your name" name="user_name" value="<?php echo $row['User_Name']; ?>" required />
                        </div>
                        <div class="textbox">
                            <i class="uil uil-envelope" style="font-size: 32px; color: black;"></i><input type="email" placeholder="Enter your email-id " name="user_mail" value="<?php echo $row['User_Mail']; ?>" required />
                        </div>
                        <div class="textbox">
                            <i class="uil uil-phone" style="font-size: 32px; color: black;"></i><input type="text" placeholder="Enter your mobile no. " name="user_mobile" value="<?php echo $row['User_Mobile']; ?>" required />
                        </div>
                    
                   
                        <div class="textbox">
                            <i class="uil uil-mars" style="font-size: 32px; color: black;"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <select name="user_gender" style="width: 13em; height: 2em; font-size: 15px; ">
                                <option value="<?php echo $row['User_Gender']; ?>"><?php echo $row['User_Gender']; ?></option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                        <div class="textbox">
                            <i class="uil uil-calender" style="font-size: 32px; color: black;"></i><input type="date" placeholder="Enter your dob " name="user_dob" value="<?php echo $row['User_Date_Of_Birth']; ?>" required />
                        </div>
                        <div class="textbox">
                            <i class="uil uil-eye" style="font-size: 32px; color: black;"></i><input type="password" name="oldpassword" placeholder="enter your old password" required />
                        </div>
                        </div>
                        <div class="inputBox">
                        <div class="textbox">
                            <label for="image">
                                <i class="uil uil-image" style="font-size: 32px; color: black;"> </i>
                                <font size="3"><b>&nbsp;&nbsp;&nbsp;&nbsp;Select Profile Image&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></font>
                            </label>
                            <img src="<?php echo $row['User_Image']; ?>" alt="User Image">
                            <input type="file" name="user_image">
                            <input type="hidden" name="old_user_image" value="<?php echo $row['User_Image']; ?>">
                        </div>
                        <div class="textbox">
                            <i class="uil uil-eye" style="font-size: 32px; color: black;"></i><input type="password" name="newpassword" placeholder="enter your new password" required />
                        </div>
                        <div class="textbox">
                            <i class="uil uil-eye" style="font-size: 32px; color: black;"></i><input type="password" name="cpassword" placeholder="confirm your password" required />
                        </div>
                    </div>
                </div>

                <br>
                <tr>
                    <td colspan="2" align="center"><input type="submit" class="btn" name="submit" value="Update Profile !"></td>
                    
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
 <!-- footer starts  -->
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
    <script src="js/smooth-scroll.js"></script>
    <!-- custom js  -->
    <script src="main.js"></script>

</body>

</html>
<?php
if (isset($_POST['submit'])) {
    $user_image = $_FILES['user_image'];
    $old_user_image = $_POST['old_user_image'];
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_mail'];
    $user_mobile = $_POST['user_mobile'];
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
    $confirmpassword = $_POST['cpassword'];
    $user_gender = $_POST['user_gender'];
    $user_dob = $_POST['user_dob'];
    $date = date('Y-m-d');

    if ($_FILES['user_image']['error'] === 0) {
        $imagefilename = $user_image['name'];
        $imagefiletemp = $user_image['tmp_name'];
        $filename_separate = explode('.', $imagefilename);
        $file_extension = strtolower($filename_separate[1]);
        $extension = array('jpeg', 'jpg', 'png');

        if (in_array($file_extension, $extension)) {
            $upload_image = 'userimages/' . $imagefilename;
            move_uploaded_file($imagefiletemp, $upload_image);
        }
    } else {
        $upload_image = $old_user_image;
    }
    if ($newpassword == $confirmpassword) {
    $check_query = "SELECT * FROM `tbl_Users` WHERE User_Id ='$user_id'";
    $check_result = mysqli_query($con, $check_query);

    if ($check_result) {
        if (mysqli_num_rows($check_result) == 1) {
            $query = "UPDATE `tbl_Users` SET `User_Name`='$user_name',`User_Mail`='$user_email',`User_Mobile`='$user_mobile',`User_Gender`='$user_gender',`User_Date_Of_Birth`='$user_dob',`User_Password`='$newpassword',`User_Image`='$upload_image' WHERE User_Id = '$user_id'";
            $update_result = mysqli_query($con, $query);

            if ($update_result) {
                ?>
                <script>
                    swal({
                        title: "Success",
                        text: "Profile Updated Successfully!",
                        icon: "success",
                    }).then(function () {
                        window.location = "advertiserdetails.php";
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
                        window.location = "updateadvertiser.php";
                    });
                </script>
            <?php
            }
        } 
    } 
}else {
        ?>
            <script>
                swal({
                    title: "Alert !",
                    text: "New password and confirm Password not match!",
                    icon: "error",
                }).then(function () {
                    window.location = "updateadvertiser.php";
                });
            </script>
        <?php
    }
}
?>
