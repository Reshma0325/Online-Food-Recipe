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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
   
    <link rel="stylesheet" href="css/bootstrap.min.css">
  
    <link rel="stylesheet" href="css/swiper-bundle.min.css">

 
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="style.css">
    <style>
        .pagination {
    display: flex;
    list-style: none;
    padding: 0;
    justify-content: center;
}

.pagination a {
    color: #333;
    text-decoration: none;
    padding: 8px 12px;
    margin: 0 4px;
    border: 1px solid #ccc;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.pagination a:hover {
    background-color: #eee;
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

<section style="background-image: url(images/menu-bg.png);" class="our-menu section bg-light repeat-img" id="menu">
    <div class="sec-wp">
        <div class="container" style="display: flex; justify-content: center;">
            <button class="styled-button" onclick="window.location='addsubcategory.php'">Add Subcategory</button>
        </div>
        <div class="container">
            <div class="menu-list-row">
                <?php
                $recipesPerPage = 8;
                $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($currentPage - 1) * $recipesPerPage;

                $sql = "SELECT * FROM `tbl_Subcategories` LIMIT $offset, $recipesPerPage";
                $result = mysqli_query($con, $sql);
                $count = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $category_id=$row['Category_Id'];
                    $sql2 = "SELECT * FROM `tbl_Categories` where Category_Id ='$category_id'";
                    $result2 = mysqli_query($con, $sql2);
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                    if ($count % 4 == 0) {
                ?>
                        <div class="row g-xxl-3 bydefault_show" id="menu-dish">
                <?php
                    }
                ?>
                        <div class="col-lg-3 col-sm-4 dish-box-wp breakfast" data-cat="breakfast">
                            <div class="dish-box text-center">
                                <div class="dish-title"><br>
                                    <img src="<?php echo $row['Subcategory_Image']; ?>" alt="" style="width: 50px; height: 40px;">
                                    <h5 class="h5-title"><?php echo $row['Subcategory_Name']; ?></h5>
                                    <p style="color:black;">Subcategory : <?php echo $row['Subcategory_Id']; ?></p>
                                    <p><b style="color:black;">Category : </b><?php echo $row['Category_Id']; ?>_<?php echo $row2['Category_Name']; ?></p>
                                    
                                </div>
                                <div class="dist-bottom-row">
                                    <ul>
                                        <li>
                                            <a href="editsubcategory.php?editid=<?php echo $row['Subcategory_Id']; ?>" class="header-btn"><i class="uil uil-edit"></i></a>
                                        </li>
                                        <li>
                                            <div class="header-btn">
                                            <a href="deletesubcategory.php?deleteid=<?php echo $row['Subcategory_Id'];?>" class="del-btn"><i class="uil uil-trash"></i></a>
                </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                <?php
                    $count++;
                    if ($count % 4 == 0) {
                ?>
                        </div>
                <?php
                    }
                }
            }
                ?>
            </div>
            <div class="pagination">
                                        <?php
                                        $totalRecipesQuery = "SELECT COUNT(*) as total FROM tbl_subcategories";
                                        $totalRecipesResult = mysqli_query($con, $totalRecipesQuery);
                                        $totalRecipes = mysqli_fetch_assoc($totalRecipesResult)['total'];
                                        $totalPages = ceil($totalRecipes / $recipesPerPage);

                            
                                        for ($i = 1; $i <= $totalPages; $i++) {
                                            echo "<a href='?page=$i'>$i</a> ";
                                        }
                                        ?>
                                    </div>
                                    <div class="login text-center">
                    <a style="color:#ff8243;" onclick="history.back()">Go Back !</a>
                </div>
        </div>
    </div>
</section>

            </section>

        
    
    <?php 
    include('footer.php');
    ?>
    </div>
        </div>
    </div>
    <?php
if(isset($_GET['m'])){
?>
    <div class="flash-data" data-flashdata="<?php echo $_GET['m'] ?>"></div>
<?php
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
    $('.del-btn').on('click', function (e) {
        e.preventDefault();

        const href = $(this).attr('href');

        Swal.fire({
            title: 'Are you sure to delete?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                
                window.location.href = href;
            }
        });
    });

    const flashdata = $('.flash-data').data('flashdata');
    if (flashdata) {
        Swal.fire({
            icon: 'success',
            title: 'Record Deleted',
            text: 'Record has been deleted successfully!'
        });
    }
</script>

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
