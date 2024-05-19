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
    include('adminheader.php');
?>

<div id="viewport">
    <div id="js-scroll-content">
        <section class="about-sec section" >
            <div class="sec-wp">
            <div class="dist-bottom-row" style="display: flex; justify-content: center;">
                <ul>
                    <li>                        
                        <a onclick="window.print()" class="header-btn" style="width: 110px;color:#ffffff; background: linear-gradient(145deg, #000000, #000000);box-shadow: inset 4px 4px 8px #000000, inset -4px -4px 8px #000000;">Print !</a>
                    </li>                                           
                </ul>
                                                        
            </div>
            <div class="container"><br>
            
            <table class="table">
                <thead class="table-dark">
                <tr>
                    <th scope="col">Payment Id</th>
                    <th scope="col">User Id</th>
                    <th scope="col">Recipe Id</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Placed_On</th>
                </tr>
                </thead>
            <tbody>         
      <?php  
          $sql="select * from `tbl_payments`";
      
    $result=mysqli_query($con,$sql);
    if($result){
        while($row=mysqli_fetch_assoc($result)){
             $payment_id=$row['Payment_Id'];
             $user_id=$row['User_Id'];
             $recipe_id=$row['Recipe_Id'];
             $amount=$row['Amount'];
             $status=$row['Status'];
             $placed_on=$row['Placed_On'];
            echo'  <tr>
      <td>'.$payment_id.'</td>
      <td>'.$user_id.'</td>
      <td>'.$recipe_id.'</td>
       <td>'.$amount.'</td>
      <td>'.$status.'</td>
      <td>'.$placed_on.'</td>
    </tr> ';
        }
    }
    
    ?>
     
  </tbody>

            </tbody> 
            </table><br>
            
           
            <div class="login text-center">
                    <a style="color:#ff8243;" onclick="history.back()">Go Back !</a>
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