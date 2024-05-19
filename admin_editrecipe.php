<?php
include 'connection.php';
session_start();
$query ="SELECT Category_Id,Category_Name FROM tbl_Categories";
    $result = $con->query($query);
    if($result->num_rows> 0){
      $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    $recipeid=$_GET['editid'];
   
    $recipeQuery = "SELECT * FROM tbl_recipes WHERE Recipe_Id = '$recipeid'";
    $recipeResult = mysqli_query($con, $recipeQuery);

    if ($recipeResult) {
        $recipe = mysqli_fetch_assoc($recipeResult);

        $imageQuery = "SELECT * FROM tbl_recipeimages WHERE Recipe_Id = '$recipeid'";
        $imageResult = mysqli_query($con, $imageQuery);
        $recipe['images'] = mysqli_fetch_all($imageResult, MYSQLI_ASSOC);

        $stepsQuery = "SELECT * FROM tbl_recipesteps WHERE Recipe_Id = '$recipeid'";
        $stepsResult = mysqli_query($con, $stepsQuery);
        $recipe['steps'] = mysqli_fetch_all($stepsResult, MYSQLI_ASSOC);

        $ingredientsQuery = "SELECT * FROM tbl_recipeingredients WHERE Recipe_Id = '$recipeid'";
        $ingredientsResult = mysqli_query($con, $ingredientsQuery);
        $recipe['ingredients'] = mysqli_fetch_all($ingredientsResult, MYSQLI_ASSOC);

        $nutritionQuery = "SELECT * FROM tbl_nutritions WHERE Recipe_Id = '$recipeid'";
        $nutritionResult = mysqli_query($con, $nutritionQuery);
        $recipe['nutrition'] = mysqli_fetch_assoc($nutritionResult);
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
    <style>
    .ingredient-item,.image-item,.step-item{
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .ingredient-input,.image-input,.step-input  {
        width: 70%;
        padding: 8px;
        margin-right: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        transition: background-color 0.3s;
    }

    .add-ingredient,.remove-ingredient,.add-image,.remove-image,.add-step,.remove-step {
        padding: 1px;
        color: white;
        border-color: black;
        border-radius: 4px;
        cursor: pointer;
        background-color: #fff;
    }
    .nestedInputBox {
        display: flex;
        gap: 1.5rem;
        justify-content: space-between;
        text-align: left;
        width: 90%;
    }

 
</style>


<script>
function updateSubcategories() {
    var selectedCategory = document.getElementById("category").value;
    var subcategoryDropdown = document.getElementById("subcategory");
    subcategoryDropdown.innerHTML = '<option value="">Select Subcategory</option>';

    if (selectedCategory) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "adminget_subcategories.php?category_id=" + selectedCategory, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var subcategories = JSON.parse(xhr.responseText);
                subcategories.forEach(function (subcategory) {
                    var option = document.createElement("option");
                    option.value = subcategory.Subcategory_Id;
                    option.text = subcategory.Subcategory_Name;
                    subcategoryDropdown.add(option);
                });
            }
        };

        xhr.send();
    }
}
</script>




<script>
document.addEventListener('DOMContentLoaded', function () {
    function addIngredient() {
        var container = document.querySelector('.ingredients-container');
        var newItem = document.createElement('div');
        newItem.classList.add('ingredient-item');
        newItem.innerHTML = `
            <input type="text" name="new_ingredient_name[]">
            <button type="button" class="remove-ingredient"><i class="uil uil-trash" style=" font-size: 18px; color: red;"></i></button>
        `;
        container.appendChild(newItem);
        updateTextBGColor(newItem.querySelector('input'));

        newItem.querySelector('.remove-ingredient').addEventListener('click', removeIngredient);
    }
    function removeIngredient(event) {
        var container = event.target.closest('.ingredient-item');
        if (container) {
            container.remove();
        }
    }

    function updateTextBGColor(input) {
        input.style.backgroundColor = input.value.trim() !== '' ? '#f0f0f0' : 'white';
    }


    document.querySelector('.add-ingredient').addEventListener('click', addIngredient);


    document.addEventListener('input', function (event) {
        if (event.target.tagName === 'INPUT') {
            updateTextBGColor(event.target);
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.remove-ingredient').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            var ingredientId = this.getAttribute('data-ingredient-id');
            if (confirm('Are you sure you want to delete this ingredient?')) {
                deleteIngredient(ingredientId);
            }
        });
    });
});

function deleteIngredient(ingredientId) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'admindelete_ingredient.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Optionally, update the UI to reflect the deletion
                alert('Ingredient deleted successfully');
                window.location.reload();
            } else {
                alert('Failed to delete recipe');
            }
        }
    };
    xhr.send('ingredient_id=' + encodeURIComponent(ingredientId));
}

</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    function addStep() {
        var container = document.querySelector('.steps-container');
        var newItem = document.createElement('div');
        newItem.classList.add('step-item');
        newItem.innerHTML = `
            <input type="text" name="new_step_name[]">
            <button type="button" class="remove-step"><i class="uil uil-trash" style=" font-size: 18px; color: red;"></i></button>
        `;
        container.appendChild(newItem);
        updateTextBGColor(newItem.querySelector('input'));

        newItem.querySelector('.remove-step').addEventListener('click', removeStep);
    }
    function removeStep(event) {
        var container = event.target.closest('.step-item');
        if (container) {
            container.remove();
        }
    }

    function updateTextBGColor(input) {
        input.style.backgroundColor = input.value.trim() !== '' ? '#f0f0f0' : 'white';
    }


    document.querySelector('.add-step').addEventListener('click', addStep);


    document.addEventListener('input', function (event) {
        if (event.target.tagName === 'INPUT') {
            updateTextBGColor(event.target);
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.remove-step').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            var stepId = this.getAttribute('data-step-id');
            if (confirm('Are you sure you want to delete this step?')) {
                deleteRecipe(stepId);
            }
        });
    });
});


function deleteRecipe(stepId) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'admindelete_recipe.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Optionally, update the UI to reflect the deletion
                alert('Step deleted successfully');
                window.location.reload();
            } else {
                alert('Failed to step recipe');
            }
        }
    };
    xhr.send('step_id=' + encodeURIComponent(stepId));
}

</script>



</head>
<body class="body-fixed">

    <?php 
    include('adminheader.php');
    ?>

<div id="viewport" style="overflow-y: auto;
    max-height: 100vh; ">
        <div id="js-scroll-content">
<section class="about-sec section">
<div class="book-table-shape">
                    <img src="images/table-leaves-shape.png" alt="">
                </div>

                <div class="book-table-shape book-table-shape2">
                    <img src="images/table-leaves-shape.png" alt="">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            
                        <div class="wrap">
        <form action="" method="POST" enctype="multipart/form-data">

            <center>
                <h1 style="text-align:center;">Edit Recipe</h1>
                <div class="flex">
                
                    <div class="inputBox">
                    <input type="hidden" value="<?php echo $recipe['Recipe_Id']; ?>" name="recipe_id">
                    
            
                <i class="uil uil-shopping-basket" style="font-size:32px; color:black;"></i>
                <font size="3">
              <b> <?php echo $recipe['Recipe_Name']; ?></b></font><br>

            
           
            
        
            <tr>
    <i class="uil uil-pizza-slice" style="font-size:32px; color:black;"></i>
    <td align="right"><font size="3"><b>&nbsp;Category &nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></font></td>
    <td>
        <select id="category" onchange="updateSubcategories()" name="category_id" style="width: 10em; height: 2em; font-size: 15px; ">
            <?php 
        
            foreach ($options as $category) {
            ?>
            <option value="<?php echo $category['Category_Id']; ?>" <?php if ($category['Category_Id'] == $recipe['Category_Id']) echo 'selected'; ?>>
                <?php echo $category['Category_Id'] . ' - ' . $category['Category_Name']; ?>
            </option>
            <?php 
            }
            ?>        
        </select>
    </td>
</tr>


            <br>
            <br>
            <tr>
                <i class="uil uil-subject" style="font-size:32px; color:black;"></i>
                <td align="right"><font size="3"><b>Subcategory&nbsp;:&nbsp;</b></font></td>
    	        <td>
		            <select  id="subcategory" name="subcategory_id"  style="width: 10em; height: 2em; font-size: 15px; ">
                    <option value="<?php echo $recipe['Subcategory_Id']; ?>"><?php echo $recipe['Subcategory_Id']; ?></option>       
                    </select>
      	        </td>
  		    </tr> 


  <br><br>

            <!-- Recipe Ingredients -->
            <div class="textbox">
    <label for="ingredient">
        <i class="uil uil-list-ul" style="font-size: 32px; color: black;"></i>
        <font size="3">
            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ingredients&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
        </font>
        <button type="button" class="add-ingredient"><i class="uil uil-plus" style=" font-size: 18px; color: green;"></i></button>
              
    </label>
    <br><br>
    <div class="ingredients-container">
        <?php foreach ($recipe['ingredients'] as $ingredient) { ?>
            <div class="ingredient-item">
            <input type="hidden" name="ingredient_id[]" value="<?php echo $ingredient['Ingredient_Id']; ?>">
                    <input type="text" name="ingredient_name[]" value="<?php echo $ingredient['Ingredient_Name']; ?>">
                    <?php $ingredient_id=$ingredient['Ingredient_Id']; ?>
                    <a href="#" class="remove-ingredient" data-ingredient-id="<?php echo $ingredient_id; ?>">
                        <button type="button"><i class="uil uil-trash" style="font-size: 18px; color: red;"></i></button>
                    </a>

        
            </div>
        <?php } ?>
    </div>
</div>



           
    
            </div>                
         
            <div class="inputBox">
            <div class="textbox" style="line-height:10px;">
            
            <i class="uil uil-clock" style="font-size: 32px; color: black;">  </i>
            <td align="right"><font size="3"><br>&nbsp;&nbsp;<b>Preparation Time&nbsp;:</b></font></td>
        
        <input type="text"  name="preparation_time" value="<?php echo $recipe['Preparation_Time']; ?>" required/>
    
    
    </div>
    
    <tr>
    <div class="textbox" style="line-height:10px;">
    
            <i class="uil uil-stopwatch" style="font-size: 32px; color: black;">  </i>
            <td align="right"><font size="3"><br>&nbsp;&nbsp;<b>Cooking Time&nbsp;:</b></font></td>
        
        <input type="text"  name="cooking_time" value="<?php echo $recipe['Cooking_Time']; ?>" required/>
    </td>
    
    </div>
    </tr>



    <div class="textbox">
                <i class="uil uil-tag" style="font-size:32px; color:black;"></i>
                <input type="text" placeholder="Servings" name="servings" value="<?php echo $recipe['Servings']; ?>" required/>
            </div>
           <!-- Recipe Images -->
           <div class="textbox" style="line-height:10px;">                
                    <i class="uil uil-image" style="font-size: 32px; color: black;"></i>
                    <font size="3">
                       <br>&nbsp;&nbsp;<b>Recipe Image&nbsp;:</b>
                    </font>
              <br><br>
                    <?php foreach ($recipe['images'] as $image) { ?>
                                                            <img src="<?php echo $image['Image_Url']; ?>" alt="Recipe Image"><br><br><br>
                                                        

                <div class="images-container">
                    <div class="image-item">
                        <input type="file" name="recipe_image"  value="<?php echo $image['Image_Url']; ?>">
                        <input type="hidden" name="old_recipe_image" value="<?php echo $image['Image_Url']; ?>">
                    </div>
                </div>
                <?php } ?>
                
            </div>
     

            <div class="textbox"  style="line-height:10px;">
               
                    <i class="uil uil-video" style="font-size: 32px; color: black;">  </i>
                    <font size="3">
                        <br>&nbsp;&nbsp;<b>Recipe Video&nbsp;:</b>
                    </font><br><br>
                    <?php if (!empty($recipe['Recipe_Video'])) { ?>
                                <video width="100%" height="auto" controls autoplay muted loop>
                                    <source src="<?php echo $recipe['Recipe_Video']; ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                </video>
                                <?php } ?><br>
                <input type="file" name="recipe_video"  value="<?php echo $recipe['Recipe_Video']; ?>">
                <input type="hidden" name="old_recipe_video" value="<?php echo $recipe['Recipe_Video']; ?>">
              
            </div>

            
             <!-- Recipe Steps -->
             <div class="textbox">
                <label for="steps">
                    <i class="uil uil-file-check-alt" style="font-size: 32px; color: black;"></i>
                    <font size="3">
                        <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recipe Steps&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                    </font>
                    <button type="button" class="add-step"><i class="uil uil-plus" style=" font-size: 18px; color: green;"></i></button>
                </label>
      <br><br>
                <div class="steps-container">
                <?php foreach ($recipe['steps'] as $step) { ?>
                    <div class="step-item">
                    
                    
                    <input type="hidden" name="step_id[]" value="<?php echo $step['Step_Id']; ?>">
                    <input type="text" name="step_name[]" value="<?php echo $step['Step_Name']; ?>">
                    <?php $step_id=$step['Step_Id']; ?>
                    <a href="#" class="remove-step" data-step-id="<?php echo $step_id; ?>">
                        <button type="button"><i class="uil uil-trash" style="font-size: 18px; color: red;"></i></button>
                    </a>

                    </div>
                        
                    
                    <?php } ?>
                </div>
              
  
                
            </div>
            <label for="nutritions">
                    <i class="uil uil-clipboard-alt" style="font-size: 32px; color: black;">  </i>
                    <font size="3">
                        <b>&nbsp;&nbsp;&nbsp;Nutritions - Per Serve&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                    </font>
                </label>  
                
                <div class="nestedInputBox" style="display: flex; gap: 1.5rem; justify-content: space-between;text-align: left;width: 90%;">
                <div class="textbox">
                    <input type="text"  name="kcal" value="<?php echo $recipe['nutrition']['Kcal']; ?>" placeholder="Kcal" required/>        
                </div>
                <div class="textbox">
                    <input type="text"  name="fat"  value="<?php echo $recipe['nutrition']['Fat']; ?>" placeholder="Fat" required/>
                </div>
                </div>
                <div class="nestedInputBox" style="display: flex; gap: 1.5rem; justify-content: space-between;text-align: left;width: 90%;">
                <div class="textbox">
                    <input type="text"  name="saturates" value="<?php echo $recipe['nutrition']['Saturates']; ?>" placeholder="Saturates" required/>
                </div>
                <div class="textbox">
                    <input type="text"  name="carbs" value="<?php echo $recipe['nutrition']['Carbs']; ?>" placeholder="Carbs" required/>
                </div> 
                
            </div> 
                
        <div class="nestedInputBox" style="display: flex; gap: 1.5rem; justify-content: space-between;text-align: left;width: 90%;">
            <div class="textbox">
                <input type="text"  name="sugars"  value=" <?php echo $recipe['nutrition']['Sugars']; ?>" placeholder="Sugar" required/>
            </div>
            <div class="textbox">
                <input type="text"  name="fibre" value="<?php echo $recipe['nutrition']['Fibre']; ?>"  placeholder="Fibre" required/>
            </div>
            </div>
                <div class="nestedInputBox" style="display: flex; gap: 1.5rem; justify-content: space-between;text-align: left;width: 90%;">
            <div class="textbox">
                <input type="text"  name="protein"  value="<?php echo $recipe['nutrition']['Protein']; ?>" placeholder="Protein" required/>
            </div>
            <div class="textbox">
                <input type="text"  name="salt" value="<?php echo $recipe['nutrition']['Salt']; ?>"  placeholder="Salt" required/>
            </div>
        </div>



                    </div>
                </div>

                <br>
                <tr>
                    <td colspan="2" align="center"><input type="submit" class="btn" name="submit" value="Update Recipe !"></td>
                    
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
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get data from the form
    $recipe_id = $_POST['recipe_id'];
  
    $servings = $_POST['servings'];
    $kcal = $_POST['kcal'];
    $fat = $_POST['fat'];
    $saturates = $_POST['saturates'];
    $carbs = $_POST['carbs'];
    $sugars = $_POST['sugars'];
    $fibre = $_POST['fibre'];
    $protein = $_POST['protein'];
    $salt = $_POST['salt'];
    $preparation_time = $_POST['preparation_time'];
    $cooking_time = $_POST['cooking_time'];
    $category_id = $_POST['category_id'];
    $subcategory_id = $_POST['subcategory_id'];
    $recipe_video = $_FILES['recipe_video'];
    $recipe_image = $_FILES['recipe_image'];
    $old_recipe_image = $_POST['old_recipe_image'];
    $old_recipe_video = $_POST['old_recipe_video'];

    $stepIds = $_POST['step_id'];
    $stepNames = $_POST['step_name'];
    
    if (is_array($stepIds) && is_array($stepNames) && count($stepIds) === count($stepNames) && !empty($stepIds)) {
        foreach ($stepIds as $index => $stepId) {
            $stepName = $stepNames[$index];
            if ($stepId !== '' && $stepName !== '') {
                $updateQuery = "UPDATE tbl_recipesteps SET Step_Name = ? WHERE Step_Id = ?";
                $stmt = $con->prepare($updateQuery);
                $stmt->bind_param('si', $stepName, $stepId);
                $stmt->execute();
                $stmt->close();
            } else {
                echo "Empty step ID or name at index $index<br>";
            }
        }
    } else {
        echo "Invalid input data";
    }
    



    if (isset($_POST['new_step_name'])) {
        $newStepNames = $_POST['new_step_name'];
        if (is_array($newStepNames)) {
            foreach ($newStepNames as $newStepName) {
                if ($newStepName !== '') {
                    $insertQuery = "INSERT INTO tbl_recipesteps (Recipe_Id, Step_Name) VALUES (?, ?)";
                    $stmt = $con->prepare($insertQuery);
                    $stmt->bind_param('is', $recipe_id, $newStepName);
                    $stmt->execute();
                }
            }
        }
    }

    $ingredientIds = $_POST['ingredient_id'];
    $ingredientNames = $_POST['ingredient_name'];
    
    if (is_array($ingredientIds) && is_array($ingredientNames) && count($ingredientIds) === count($ingredientNames) && !empty($ingredientIds)) {
        foreach ($ingredientIds as $index => $ingredientId) {
            $ingredientName = $ingredientNames[$index];
            if ($ingredientId !== '' && $ingredientName !== '') {
                $updateQuery = "UPDATE tbl_recipeingredients SET Ingredient_Name = ? WHERE Ingredient_Id = ?";
                $stmt = $con->prepare($updateQuery);
                $stmt->bind_param('si', $ingredientName, $ingredientId);
                $stmt->execute();
                $stmt->close();
            } else {
                echo "Empty step ID or name at index $index<br>";
            }
        }
    } else {
        echo "Invalid input data";
    }
    



    if (isset($_POST['new_ingredient_name'])) {
        $newIngredientNames = $_POST['new_ingredient_name'];
        if (is_array($newIngredientNames)) {
            foreach ($newIngredientNames as $newIngredientName) {
                if ($newIngredientName !== '') {
                    $insertQuery = "INSERT INTO tbl_recipeingredients (Recipe_Id, Ingredient_Name) VALUES (?, ?)";
                    $stmt = $con->prepare($insertQuery);
                    $stmt->bind_param('is', $recipe_id, $newIngredientName);
                    $stmt->execute();
                }
            }
        }
    }
    
    


    // Update recipe details in tbl_recipes
    $recipe_query = "UPDATE `tbl_recipes` SET 
                        `Servings`='$servings', 
                        `Preparation_Time`='$preparation_time', 
                        `Cooking_Time`='$cooking_time', 
                        `Category_Id`='$category_id', 
                        `Subcategory_Id`='$subcategory_id'
                        WHERE `Recipe_Id`='$recipe_id'";
    mysqli_query($con, $recipe_query);

    
    // Upload and update recipe image in tbl_recipeimages
    if ($_FILES['recipe_image']['error'] === 0) {
        $imagefilename = $recipe_image['name'];
        $imagefiletemp = $recipe_image['tmp_name'];
        $filename_separate = explode('.', $imagefilename);
        $file_extension = strtolower($filename_separate[1]);
        $extension = array('jpeg', 'jpg', 'png');

        if (in_array($file_extension, $extension)) {
            $upload_image = 'images/recipeimages/' . $imagefilename;
            move_uploaded_file($imagefiletemp, $upload_image);      
        }
    }else {
        $upload_image = $old_recipe_image;
    }

    $image_query = "UPDATE `tbl_recipeimages` SET `Image_Url`='$upload_image' WHERE `Recipe_Id`='$recipe_id'";
    mysqli_query($con, $image_query);

    // Upload and update recipe video in tbl_recipes
    if ($_FILES['recipe_video']['error'] === 0) {
        $videofilename = $recipe_video['name'];
        $videofiletemp = $recipe_video['tmp_name'];
        $filename_separate = explode('.', $videofilename);
        $file_extension = strtolower(end($filename_separate));
        $allowedExtensionsVideo = ['mp4', 'avi', 'mov'];

        if (in_array($file_extension, $allowedExtensionsVideo)) {
            $upload_video = 'images/recipevideos/' . $videofilename;
            move_uploaded_file($videofiletemp, $upload_video);      
        }
    }else {
        $upload_video = $old_recipe_video;
    }


    $video_query = "UPDATE `tbl_recipes` SET `Recipe_Video`='$upload_video' WHERE `Recipe_Id`='$recipe_id'";
            mysqli_query($con, $video_query);

    // Update nutrition details in tbl_nutritions
    $nutrition_query = "UPDATE `tbl_nutritions` SET 
                            `Kcal`='$kcal',
                            `Fat`='$fat',
                            `Saturates`='$saturates',
                            `Carbs`='$carbs',
                            `Sugars`='$sugars',
                            `Fibre`='$fibre', 
                            `Protein`='$protein',
                            `Salt`='$salt'
                            WHERE `Recipe_Id`='$recipe_id'";
    mysqli_query($con, $nutrition_query);

   

    // Check if any update was successful
    if (mysqli_affected_rows($con) > 0) {
        // Display success message and redirect
        ?>
        <script>
            swal({
                title: "Success",
                text: "Recipe updated Successfully!",
                icon: "success",
            }).then(function() {
                window.location = "recipes.php";
            });
        </script>
        <?php
    } else {
        // Display error message and redirect
        ?>
        <script>
            swal({
                title: "Alert!",
                text: "Recipe update failed!",
                icon: "error",
            }).then(function() {
                window.location = "recipes.php";
            });
        </script>
        <?php
    }
}
?>
