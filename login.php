<?php
include 'connection.php';
session_start();
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

<section class="about-sec section" id="login">
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
                                <form action =""  method ="POST">
                                   
	                            <center>
                                <h1>Login</h1><br>
	
		                        <div class="textbox">
    		                    <i class="uil uil-envelope" style="font-size:32px; color:black;"></i><input type="email" placeholder="Enter your email-id " name="user_mail" required/>
  		                        </div>
                               
                               
		                        <div class="textbox">
    		                    <i class="uil uil-eye"  style="font-size:32px; color:black;"></i><input type="password" name="user_password" placeholder="enter your password" required/>
  		                        </div>
		                        <br>
                                <tr>
                                <td colspan="2" align="center"><input type="submit" class="btn" name="submit" value="Login!"></td>
                                </tr>
                                <br>
                                <div class="login">
                                    Not an user? <a href="register.php">Register Here</a><br><br>
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
    $user_email = $_POST['user_mail'];
    $user_password = $_POST['user_password'];  
    $check_user_query = "SELECT * FROM tbl_Users WHERE User_Mail='$user_email' AND User_Password='$user_password'";
    $check_user_result = mysqli_query($con, $check_user_query);
    
    $check_admin_query = "SELECT * FROM tbl_Admins WHERE Admin_Mail='$user_email' AND Admin_Password='$user_password'";
    $check_admin_result = mysqli_query($con, $check_admin_query);

    if(mysqli_num_rows($check_user_result) > 0){
        $row = mysqli_fetch_assoc($check_user_result);
                if($row['User_Type'] == 'viewer'){
                   $_SESSION['viewer_name'] = $row['User_Name'];
                   $_SESSION['viewer_mail'] = $row['User_Mail'];
                   $_SESSION['viewer_id'] = $row['User_Id'];
                   ?>
                 <script>
                    swal({
                    title: "Success!",
                    text: "Login Successfull",
                    icon: "success",
                }).then(function() {
                window.location = "viewerindex.php";
                });
                </script>
                <?php
                 
                }elseif($row['User_Type'] == 'publisher'){
                   $_SESSION['publisher_name'] = $row['User_Name'];
                   $_SESSION['publisher_mail'] = $row['User_Mail'];
                   $_SESSION['publisher_id'] = $row['User_Id'];
                   ?>
                 <script>
                    swal({
                        title: "Success!",
                    text: "Login Successfull",
                    icon: "success",
                }).then(function() {
                window.location = "publisherindex.php";
                });
                </script>
                <?php
                 
                }
                elseif($row['User_Type'] == 'advertiser'){
                   $_SESSION['advertiser_name'] = $row['User_Name'];
                   $_SESSION['advertiser_mail'] = $row['User_Mail'];
                   $_SESSION['advertiser_id'] = $row['User_Id'];
                   ?>
                 <script>
                    swal({
                        title: "Success!",
                    text: "Login Successfull",
                    icon: "success",
                }).then(function() {
                window.location = "advertiserindex.php";
                });
                </script>
                <?php
                  
                }
             }
            elseif(mysqli_num_rows($check_admin_result) > 0){
                $row = mysqli_fetch_assoc($check_admin_result);
                $_SESSION['admin_name'] = $row['Admin_Name'];
                $_SESSION['admin_mail'] = $row['Admin_Mail'];
                $_SESSION['admin_id'] = $row['Admin_Id'];
                ?>
                <script>
                    swal({
                        title: "Success!",
                        text: "Admin Login Successfull",
                        icon: "success",
                    }).then(function() {
                        window.location = "adminindex.php";
                    });
                </script>
                <?php
            } else { ?>
                <script>
                    swal({
                        title: "Alert!",
                        text: "Incorrect email or password!",
                        icon: "error",
                    }).then(function() {
                        window.location = "login.php";
                    });
                </script>
            <?php }
        
                }
        
       
    


?>