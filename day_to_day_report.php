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
    </style>
</head>

<body class="body-fixed">
    <?php
    include('adminheader.php');
    ?>

    <div id="viewport">
        <div id="js-scroll-content">
            <section class="about-sec section">
            <div class="header-search-form-wrapper">
    <form action="" class="header-search-form for-des">
        <div class="search-input-wrapper">
         <b> From :</b>&nbsp;<input type="date" name="from" class="form-input" >&nbsp;&nbsp; <b>To :</b>&nbsp; <input type="date" name="to" class="form-input">
           
         
        </div>
        <br>
     
    <input type="submit" class="btn" name="submit" value="Search !" style="display: block; margin: 0 auto; width: 150px;">
    
    </form>
</div>   <br><br>
                <div class="sec-wp">
                    <div class="dist-bottom-row"
                        style="display: flex; justify-content: center;">
                        <ul>
                            <li>
                                <a onclick="window.print()" class="header-btn"
                                    style="width: 110px;color:#ffffff; background: linear-gradient(145deg, #000000, #000000);box-shadow: inset 4px 4px 8px #000000, inset -4px -4px 8px #000000;">Print
                                    !</a>
                            </li>
                        </ul>

                    </div>
                    <div class="container"><br>
                        <?php
                        if (isset($_GET['submit']) && !empty($_GET['submit'])) {
                            $from = $_GET['from'];
                            $to = $_GET['to'];
                            $recipe_query = "SELECT * FROM tbl_recipes WHERE Placed_On BETWEEN '$from' AND '$to'";

                            $recipe_result = mysqli_query($con, $recipe_query);
                            if (mysqli_num_rows($recipe_result) == 0) {
                                ?>
                                <script>
                                    Swal.fire({
                                        title: 'No Recipes Found!',
                                        text: 'Sorry, no recipes matched your search criteria.',
                                        icon: 'info'
                                    }).then(function () {
                                        window.location = "day_to_day_report.php";
                                    });
                                </script>
                        <?php
                            } else {
                                ?>
                                <p style="text-align:center; font-size:20px;">The Recipes From <b><?php echo $from;?></b> To <b><?php echo $to;?></b></p>
                                <table class="table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">Recipe_Id</th>
                                            <th scope="col">User_Id</th>
                                            <th scope="col">Recipe_Name</th>
                                            <th scope="col">Category_Id</th>
                                            <th scope="col">Subcategory_Id</th>
                                            <th scope="col">Placed_On</th>
                                            <th scope="col">Total_Ratings</th>
                                            <th scope="col">Average_Rating</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while ($row = mysqli_fetch_assoc($recipe_result)) {
                                                $recipe_id = $row['Recipe_Id'];
                                                $user_id = $row['User_Id'];
                                                $recipe_name = $row['Recipe_Name'];
                                                $category_id = $row['Category_Id'];
                                                $subcategory_id = $row['Subcategory_Id'];
                                                $placed_on = $row['Placed_On'];
                                                $total_rating = $row['Total_Ratings'];
                                                $average_rating = $row['Average_Rating'];
                                                echo '<tr>
                                                      <td>' . $recipe_id . '</td>
                                                      <td>' . $user_id . '</td>
                                                      <td>' . $recipe_name . '</td>
                                                      <td>' . $category_id . '</td>
                                                      <td>' . $subcategory_id . '</td>
                                                      <td>' . $placed_on . '</td>
                                                      <td>' . $total_rating . '</td>
                                                      <td>' . $average_rating . '</td>
                                                    </tr> ';
                                            }
                                        ?>
                                    </tbody>
                                </table><br>
                        <?php
                            }
                        } else {
                            echo "Please enter a search term.";
                        }
                        ?>

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
