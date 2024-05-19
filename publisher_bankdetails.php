<?php
include 'connection.php';
session_start();
$publisher_id = $_SESSION['publisher_id'];
if(!isset($publisher_id)){
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@latest"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
.bankbox {
    width: 90%;
    max-width: 400px; 
    background-color: #ffffff; 
    border-radius: .1rem;
    margin: 0.3rem auto;
    padding: 0.5rem 0.8rem;
    color: #000000; 
    font-size: 0.9rem;
    border: .05rem solid #949292;
    box-sizing: border-box; 
}

.bankbox input[type="text"],
.bankbox input[type="number"],
.bankbox select {
    width: calc(100% - 16px); 
    outline: none;
    border: 1px solid #fff;
    padding: 4px;
    margin-bottom: 4px;
    border-radius: 8px;
    background: #e4e4e4;
    font-size: 0.8rem;
    box-sizing: border-box; 
}

.bankbox select {
    appearance: none; 
    background-image: url('data:image/svg+xml;utf8,<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>'); /* Adds custom arrow */
    background-repeat: no-repeat;
    background-position: right 4px top 50%;
    background-size: 6px 6px;
}
.bankform label {
    text-align: left;
    display: inline-block;
    width: 100%;
    padding-left: 35px;
}

    </style>
</head>
<body class="body-fixed">
    <!-- start of header  -->
    <?php 
    include('publisherheader.php');
    ?>
    <!-- header ends  -->
    <div id="viewport" style="overflow-y: auto; max-height: 100vh; ">
        <div id="js-scroll-content">
<section class="about-sec section" id="register">
  

                        <div class="container">
                        <div class="row">
                        <div class="col-lg-12">
                        
                        <center><h1>FILL YOUR ACCOUNT DETAILS</h1></center>
                                
                        <div class="wrapper" style="width: 500px;">
    <form action="" method="POST" enctype="multipart/form-data" class="bankform">
    <input type="hidden" value="<?php echo $publisher_id; ?>" name="user_id">
        <label for="a_no"><b>Account Number:</b></label><br>
        <input type="number" max="9999999999" id="a_no" name="a_no" required class="bankbox"><br>
        
        <label for="b_name"><b>Banks:</b></label><br>
        <select id="b_name" name="b_name" class="bankbox">
            <option disabled selected>Select Your Bank</option>
            <option value="SBI">State Bank Of India</option>
            <option value="ICICI">ICICI Bank</option>
            <option value="Canara">Canara Bank</option>
            <option value="IOB">Indian Overseas Bank</option>
        </select><br>
        
        <label for="ifsc"><b>IFSC Code:</b></label><br>
        <input type="number" id="ifsc" name="ifsc" max="99999999999" required class="bankbox"><br>
        
        <label for="a_name"><b>Account Name:</b></label><br>
        <input type="text" id="a_name" name="a_name" required class="bankbox"><br><br>

        <input type="submit" class="btn" name="submit" value="Submit"><br>
        <div class="login">
            <a style="color:#ff8243;" onclick="history.back()">Go Back</a>
        </div>
    </form>
</div>

                         
                                       
                </div>    
                        </div>
                    </div>
                
            </section>
            <?php include('footer.php'); ?>
           
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
if(isset($_POST['submit']))
{
   $a_no = $_POST['a_no'];
   $b_name = $_POST['b_name'];
   $ifsc = $_POST['ifsc'];
   $a_name = $_POST['a_name'];
   $user_id = $_POST['user_id'];
   $date=date('Y-m-d');

   $check_query = "SELECT * FROM `tbl_bankaccount` WHERE `Account_Name`='$a_name'";
   $result = mysqli_query($con, $check_query);

   if (mysqli_num_rows($result) > 0) { ?>
         <script>
                Swal.fire({
                    title: "Warning !",
                    text: "your bank details already exists!",
                    icon: "warning"
                });
            </script>
   <?php } else {

   
   
    $bank_query = "INSERT INTO `tbl_bankaccount`(`User_Id`, `Account_Number`, `Bank_Name`, `IFSC`, `Account_Name`, `date`)
                    VALUES('$user_id', '$a_no', '$b_name', '$ifsc', '$a_name','$date')";
    mysqli_query($con, $bank_query);

    ?>
        
             <script>
                Swal.fire({
                    title: "Success!",
                    text: "Details added successfully!",
                    icon: "success"
                });
            </script>
    
    <?php } 
  

}
?>