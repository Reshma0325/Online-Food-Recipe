<?php
include 'connection.php';

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    ?>
    <div class="menu-list-row">
    <?php
    $recipe_query = "SELECT * FROM tbl_recipes JOIN tbl_recipeimages ON tbl_recipes.Recipe_ID = tbl_recipeimages.Recipe_ID WHERE Category_Id = '$category_id'";
    $recipe_result = mysqli_query($con, $recipe_query);
   
    

    if (mysqli_num_rows($recipe_result) > 0) {
        ?>
    <div class="row g-xxl-5 bydefault_show" id="menu-dish"><?php
        while ($recipe = mysqli_fetch_assoc($recipe_result)) {

            $recipe_name = $recipe['Recipe_Name'];
            $servings = $recipe['Servings'];
            $preparation_time = $recipe['Preparation_Time'];
            $cooking_time = $recipe['Cooking_Time'];
            $recipeimage = $recipe['Image_Url'];
            $rating = $recipe['Average_Rating'];

            ?>
             
             <div class="col-lg-4 col-sm-6 dish-box-wp breakfast" data-cat="breakfast">
                                                <div class="dish-box text-center">
                                                    <div class="dist-img">
                                                        <img src="<?php echo $recipeimage; ?>" alt="<?php echo $recipe_name; ?>" style="width: 260px; height: 260px;">
                                                    </div>
                                                    <div class="dish-rating">
                                                      
                                                        
                                                      <i class="uil uil-star">&nbsp;<?php echo $rating; ?></i>
                                                  </div>
                                                    <div class="dish-title">
                                                        <h3 class="h3-title"><?php echo $recipe_name; ?></h3>
                                                        <p><?php echo $servings; ?> servings</p>
                                                    </div>
                                                    <div class="dish-info">
                                                        <ul>
                                                            <li>
                                                                <p>preparation</p>
                                                                <b><?php echo $preparation_time; ?></b>
                                                            </li>
                                                            <li>
                                                                <p>cooking</p>
                                                                <b><?php echo $cooking_time; ?></b>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="dist-bottom-row">
                                                    <ul>
                                                        <li>     
                                                            <a href="admin_viewrecipe.php?viewid=<?php echo $recipe['Recipe_Id'];?>" class="header-btn" style="width: 110px;color:#ffffff; background: linear-gradient(145deg, #ffc954, #ffbc00);box-shadow: inset 4px 4px 8px #d6a029, inset -4px -4px 8px #ffd837;">View Recipe</a>
                                                        </li>
                                                        <li>
                                                            <a href="admin_editrecipe.php?editid=<?php echo $recipe['Recipe_Id']; ?>" class="header-btn"><i class="uil uil-edit"></i></a>
                                                        </li>
                                                        <li>
                                                             <div class="header-btn">
                                                                <a href="admin_deleterecipe.php?deleteid=<?php echo $recipe['Recipe_Id'];?>" class="del-btn"><i class="uil uil-trash"></i></a>
                                                            </div>
                                                        </li>    
                                                    </ul>
                                                        </ul>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            <?php
                            
    }else {
        echo "no recipes available";
    }
}else if (isset($_GET['subcategory_id'])) {
    $selected_subcategory_id = $_GET['subcategory_id'];
    ?>
    <div class="menu-list-row">
    <?php
     $recipe_query = "SELECT * FROM tbl_recipes JOIN tbl_recipeimages ON tbl_recipes.Recipe_ID = tbl_recipeimages.Recipe_ID WHERE Subcategory_Id = '$selected_subcategory_id'";
     $recipe_result = mysqli_query($con, $recipe_query);
     

   
    $count = 0;

    if (mysqli_num_rows($recipe_result) > 0) { ?>
    <div class="row g-xxl-5 bydefault_show" id="menu-dish"><?php
        while ($recipe = mysqli_fetch_assoc($recipe_result)) {

            $recipe_name = $recipe['Recipe_Name'];
            $servings = $recipe['Servings'];
            $preparation_time = $recipe['Preparation_Time'];
            $cooking_time = $recipe['Cooking_Time'];
            $recipeimage = $recipe['Image_Url'];
            $rating = $recipe['Average_Rating'];
 ?>
                
            
             <div class="col-lg-4 col-sm-6 dish-box-wp breakfast" data-cat="breakfast">
                                                <div class="dish-box text-center">
                                                    <div class="dist-img">
                                                        <img src="<?php echo $recipeimage; ?>" alt="<?php echo $recipe_name; ?>" style="width: 260px; height: 260px;">
                                                    </div>
                                                    <div class="dish-rating">
                                                      
                                                        
                                                      <i class="uil uil-star">&nbsp;<?php echo $rating; ?></i>
                                                  </div>
                                                    <div class="dish-title">
                                                        <h3 class="h3-title"><?php echo $recipe_name; ?></h3>
                                                        <p><?php echo $servings; ?> servings</p>
                                                    </div>
                                                    <div class="dish-info">
                                                        <ul>
                                                            <li>
                                                                <p>preparation</p>
                                                                <b><?php echo $preparation_time; ?></b>
                                                            </li>
                                                            <li>
                                                                <p>cooking</p>
                                                                <b><?php echo $cooking_time; ?></b>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="dist-bottom-row">
                                                    <ul>
                                                        <li>     
                                                            <a href="admin_viewrecipe.php?viewid=<?php echo $recipe['Recipe_Id'];?>" class="header-btn" style="width: 110px;color:#ffffff; background: linear-gradient(145deg, #ffc954, #ffbc00);box-shadow: inset 4px 4px 8px #d6a029, inset -4px -4px 8px #ffd837;">View Recipe</a>
                                                        </li>
                                                        <li>
                                                            <a href="admin_editrecipe.php?editid=<?php echo $recipe['Recipe_Id']; ?>" class="header-btn"><i class="uil uil-edit"></i></a>
                                                        </li>
                                                        <li>
                                                             <div class="header-btn">
                                                                <a href="admin_deleterecipe.php?deleteid=<?php echo $recipe['Recipe_Id'];?>" class="del-btn"><i class="uil uil-trash"></i></a>
                                                            </div>
                                                        </li>    
                                                    </ul>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            <?php
                            
    } else {
        echo "no recipes available for this subcategory";
    }
} else {
    echo "Invalid request";
}
?>
