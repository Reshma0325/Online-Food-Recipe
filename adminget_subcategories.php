<?php
include 'connection.php';

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    $subcategory_query = "SELECT * FROM tbl_subcategories WHERE Category_Id = '$category_id'";
    $subcategory_result = mysqli_query($con, $subcategory_query);

    ?>
    <div class="menu-tab-wp">
        <div class="row">
            <div class="col-lg-10 m-auto"><br>
                <div class="menu-tab text-center">
                    <ul class="filters">
                        <?php

                         if (mysqli_num_rows($subcategory_result) > 0) {
                            while ($subcategory = mysqli_fetch_assoc($subcategory_result)) {
                                $subcategory_name = $subcategory['Subcategory_Name'];
                                $subcategory_id = $subcategory['Subcategory_Id'];
                                $subcategory_image = $subcategory['Subcategory_Image'];
                        ?>
                                <li class="filter" data-filter=".subcategory-<?php echo $subcategory_id; ?>" onclick="showRecipesForSubcategory('<?php echo $subcategory_id; ?>')">
                                    <img src="<?php echo $subcategory_image; ?>" alt="<?php echo $subcategory_name; ?>" style="width: 50px; height: 40px;"> 
                                    <p style="font-size: 14px; margin: 55px 0 0; position: absolute; color: black;"><?php echo $subcategory_name; ?></p>
                                </li>
                        <?php
                            }
                        } else {
                            echo "<li>No subcategories available</li>";
                        }

                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div> 
    <?php }else {
    echo "Invalid request";
}
?>
