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
   <script src="sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/swiper-bundle.min.css">    
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="body-fixed">

    <?php 
    include('header.php');
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
                            
                                
                                <div class="wrapper">   
                                <form action =""  method = "POST" enctype="multipart/form-data">
                                   
	                            <center>
                                <h1>Sign Up</h1><br>
                                <tr>
      		                    <td align="right"><font size="3"><b>Log in as&nbsp;:&nbsp;</b></font></td>
    	                        <td>
		                        <select name="user_type"  style="width: 13em; height: 2em; font-size: 15px; ">
                                <option value="viewer">Viewer</option>
                                <option value="publisher">Publisher</option>
                                <option value="advertiser">Advertiser</option>
                                </select>
      	                        </td>
  		                        </tr>
                                  <div class="textbox">
    		                    <i class="uil uil-user" style="font-size:32px; color:black;"></i><input type="text" placeholder="Enter your name" name="user_name" required/>
  		                        </div>
		                        <div class="textbox">
    		                    <i class="uil uil-envelope" style="font-size:32px; color:black;"></i><input type="email" placeholder="Enter your email-id " name="user_email" required/>
  		                        </div>
                                  <div class="textbox">
    		                    <i class="uil uil-phone" style="font-size:32px; color:black;"></i><input type="text" placeholder="Enter your mobile no. " name="user_mobile" required/>
  		                        </div>
                                
                                <tr>
                                <i class="uil uil-mars" style="font-size:32px; color:black;"></i>
                                
      		                    <td align="right"><font size="3"><b>Gender&nbsp;:&nbsp;</b></font></td>
    	                        <td>
		                        <select name="user_gender"  style="width: 13em; height: 2em; font-size: 15px; ">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                                </select>
      	                        </td>
  		                        </tr>
                                
                                  <div class="textbox">
    		                    <i class="uil uil-calender" style="font-size:32px; color:black;"></i><input type="date" placeholder="Enter your dob " name="user_dob" required/>
  		                        </div>   
                                  <div class="textbox" style="line-height:10px;">
    
    <i class="uil uil-image" style="font-size: 32px; color: black;">  </i>
    <td align="right"><font size="3"><b>Select Profile Image&nbsp;:</b></font>
<td>
                                  
                                <input type="file" name="user_image" required>
                                 </div>
		                        <div class="textbox">
    		                    <i class="uil uil-eye"  style="font-size:32px; color:black;"></i><input type="password" name="password" placeholder="enter your password" required/>
  		                        </div>
                                  <div class="textbox">
    		<i class="uil uil-eye"  style="font-size:32px; color:black;"></i><input type="password" name="cpassword"  placeholder="confirm your password" required/>
  		</div>
		                        <br>
                                <tr>
                                <td colspan="2" align="center"><input type="submit" class="btn" name="submit" value="Sign Up!"></td>
                                </tr>
                                <br>
                                <div class="login">
                                    Already an user? <a href="login.php">Login</a><br><br>
                                    <a style="color:#ff8243;" onclick="history.back()">Go Back !</a>
                                </div>
	                            

                                </form>
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
<?php
if(isset($_POST['submit'])){
    $user_image = $_FILES['user_image'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_mobile = $_POST['user_mobile'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['cpassword'];
    $user_type = $_POST['user_type'];
    $user_gender = $_POST['user_gender'];
    $user_dob = $_POST['user_dob'];
    $date = date('Y-m-d');
    
    $imagefilename=$user_image['name'];   
    $imagefileerror=$user_image['error'];   
    $imagefiletemp=$user_image['tmp_name'];
    $filename_separate=explode('.',$imagefilename);
    $file_extension=strtolower($filename_separate[1]);
    $extension=array('jpeg','jpg','png');

    if(in_array($file_extension,$extension)){
        $upload_image='userimages/'.$imagefilename;
        move_uploaded_file($imagefiletemp,$upload_image);

        if ($password == $confirmpassword) {
            $check_query = "select * from tbl_users where User_Mail='$user_email'";
            $check_result = mysqli_query($con, $check_query);
        
            if (mysqli_num_rows($check_result) == 0) {
                $query = "INSERT INTO `tbl_users`(`User_Id`, `User_Name`, `User_Mail`, `User_Mobile`, `User_Type`, `User_Gender`, `User_Date_Of_Birth`, `User_Password`, `User_Joined_On`, `User_Image`) VALUES('', '$user_name', '$user_email', '$user_mobile', '$user_type', '$user_gender', '$user_dob','$password','$date','$upload_image')";
                mysqli_query($con, $query);
        
                if (mysqli_affected_rows($con) == 1) { ?>
                     <script>
                    swal({
                    title: "Success",
                    text: "Registered Successfully !, Now you can signup",
                    icon: "success",
                }).then(function() {
                window.location = "login.php";
                });
                </script>
                    <?php }
            }
            else { ?>
                <script>
                    swal({
                    title: "Alert!",
                    text: "Login ID already exists!",
                    icon: "warning",
                });
                </script>
                <?php }
        }
        else {  ?>
            <script>
                swal({
                title: "Alert!",
                text: "Password and confirm password does not match!",
                icon: "error",
            });
            </script>
            <?php  }
    }

}
?>