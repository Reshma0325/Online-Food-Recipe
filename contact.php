<?php
include 'connection.php';
session_start();
$sql="select * from `tbl_Users` where User_Id = $_SESSION[viewer_id]";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['User_Name'];
$mail=$row['User_Mail'];
$mobile=$row['User_Mobile'];
$id=$row['User_Id'];
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
    include('viewerheader.php');
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
                        <div class="sec-title text-center mb-5">
                                <p class="sec-sub-title mb-3">Feedback</p>
                        </div>
                                <div class="wrapper">   
                                <form action =""  method ="POST">
                                   
	                            <center>
                                <h1>Say Something !</h1><br>
                                <input type="hidden" value="<?php echo $id; ?>" name="user_id">

                                <div class="textbox">
                                
                
    		                    <i class="uil uil-user" style="font-size:32px; color:black;"></i><input type="text" placeholder="Enter your name" value="<?php echo $name; ?>" name="user_name" required/>
  		                        </div>
		                        <div class="textbox">
    		                    <i class="uil uil-envelope" style="font-size:32px; color:black;"></i><input type="email" placeholder="Enter your email-id "  value="<?php echo $mail; ?>"name="user_mail" required/>
  		                        </div>
                                  <div class="textbox">
    		                    <i class="uil uil-phone" style="font-size:32px; color:black;"></i><input type="text" placeholder="Enter your mobile no. " value="<?php echo $mobile; ?>" name="user_mobile" required/>
  		                        </div><br>
                                <textarea name="message"  placeholder="enter your message" id="" cols="36" rows="10"></textarea>
                                <br><br>
                                <tr>
                                <td colspan="2" align="center"><input type="submit" class="btn" name="submit" value="Submit"></td>
                                </tr>
                                
                               
	                            

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
    $user_id= $_POST['user_id'];
    $user_name = $_POST['user_name']; 
    $user_mail = $_POST['user_mail'];
    $user_mobile = $_POST['user_mobile'];
    $message = $_POST['message'];
    $date=date('Y-m-d');
    $res = mysqli_query($con, "SELECT * FROM `tbl_Messages` WHERE User_Id = '$user_id' AND User_Name = '$user_name' AND User_Mail = '$user_mail' AND User_Mobile = '$user_mobile' AND message = '$message'") or die('query failed');
    if(mysqli_num_rows($res) > 0){
        ?>
        <script>
           swal({
           title: "Alert!",
           text: "Message Already send!",
           icon: "warning",
       }).then(function() {
       window.location = "contact.php";
       });
       </script>
       <?php
    }else{
       mysqli_query($con, "INSERT INTO `tbl_Messages` (`Id`, `User_Id`, `User_Name`, `User_Mail`, `User_Mobile`, `Message`, `Placed_On`) VALUES('','$user_id', '$user_name', '$user_mail', '$user_mobile', '$message','$date')") or die('query failed');
       ?><script>
       swal({
       title: "Success!",
       text: "Message Sent Successfull",
       icon: "success",
   }).then(function() {
   window.location = "contact.php";
   });
   </script>
   <?php
    }
        
        }
       
    


?>