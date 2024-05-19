<?php
include 'connection.php';
session_start();
$query ="SELECT Category_Id,Category_Name FROM tbl_Categories";
    $result = $con->query($query);
    if($result->num_rows> 0){
      $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
 $res = mysqli_query($con, "SELECT * FROM `tbl_Users` WHERE User_Id=$_SESSION[publisher_id]") or die('query failed');
                                if(mysqli_num_rows($res) > 0){
                                $row = mysqli_fetch_assoc($res);
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
        xhr.open("GET", "getsubcategories.php?category_id=" + selectedCategory, true);

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
            <input type="text" name="ingredient_name[]" required/>
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
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    function addStep() {
        var container = document.querySelector('.steps-container');
        var newItem = document.createElement('div');
        newItem.classList.add('step-item');
        newItem.innerHTML = `
            <input type="text" name="step_name[]" required/>
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
</script>



</head>
<body class="body-fixed">

    <?php 
    include('publisherheader.php');
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
                <h1 style="text-align:center;">Add Recipe</h1>
                <div class="flex">
                
                    <div class="inputBox">
                    <input type="hidden" value="<?php echo $row['User_Id']; ?>" name="user_id">
                    <div class="textbox">
                <i class="uil uil-shopping-basket" style="font-size:32px; color:black;"></i>
                <input type="text" placeholder="Enter Recipe Name" name="recipe_name" required/>
            </div>
            
           
            
        
            <tr>
                <i class="uil uil-pizza-slice" style="font-size:32px; color:black;"></i>
                <td align="right"><font size="3"><b>&nbsp;Category &nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></font></td>
    	        <td>
		            <select id="category"  onchange="updateSubcategories()" name="category_id"  style="width: 10em; height: 2em; font-size: 15px; ">
                    <?php 
                    foreach ($options as $category) {
                    ?>
                    <option value="<?php echo $category['Category_Id']; ?>"><?php echo $category['Category_Name']; ?></option>
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
                    <option value="">Select Subcategory</option>       
                    </select>
      	        </td>
  		    </tr>  <br><br>
            <!-- Recipe Ingredients -->
            <div class="textbox">
                <label for="ingredient">
                    <i class="uil uil-list-ul" style="font-size: 32px; color: black;"></i>
                    <font size="3">
                        <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ingredients&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                    </font>
                    <button type="button" class="add-ingredient"><i class="uil uil-plus" style=" font-size: 18px; color: green;"></i></button>
                </label>
                
                <div class="ingredients-container">
                    <div class="ingredient-item">
                        <input type="text" name="ingredient_name[]" required/>
                        <button type="button" class="remove-ingredient"><i class="uil uil-trash" style="font-size: 18px; color: red;"></i></button>
                    </div>
                </div>
                
            </div>
           
    
            </div>               
         
            <div class="inputBox">
            <div class="textbox" style="line-height:10px;">
            
            <i class="uil uil-clock" style="font-size: 32px; color: black;">  </i>
            <td align="right"><font size="3"><br>&nbsp;&nbsp;<b>Preparation Time&nbsp;:</b></font></td>
        
        <input type="text"  name="preparation_time" required/>
    
    
    </div>
    
    <tr>
    <div class="textbox" style="line-height:10px;">
    
            <i class="uil uil-stopwatch" style="font-size: 32px; color: black;">  </i>
            <td align="right"><font size="3"><br>&nbsp;&nbsp;<b>Cooking Time&nbsp;:</b></font></td>
        
        <input type="text"  name="cooking_time" required/>
    </td>
    
    </div>
    </tr>
    <div class="textbox">
                <i class="uil uil-tag" style="font-size:32px; color:black;"></i>
                <input type="text" placeholder="Servings" name="servings" required/>
            </div>
           <!-- Recipe Images -->
           <div class="textbox" style="line-height:10px;">                
                    <i class="uil uil-image" style="font-size: 32px; color: black;"></i>
                    <font size="3">
                       <br>&nbsp;&nbsp;<b>Recipe Image&nbsp;:</b>
                    </font>
              
               
                <div class="images-container">
                    <div class="image-item">
                        <input type="file" name="recipe_image" required/>
                    </div>
                </div>
                
            </div>
            <div class="textbox"  style="line-height:10px;">
               
                    <i class="uil uil-video" style="font-size: 32px; color: black;">  </i>
                    <font size="3">
                        <br>&nbsp;&nbsp;<b>Recipe Video&nbsp;:</b>
                    </font>
                
                <input type="file" name="recipe_video" required>
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
                
                <div class="steps-container">
                    <div class="step-item">
                        <input type="text" name="step_name[]" required/>
                        <button type="button" class="remove-step"><i class="uil uil-trash" style="font-size: 18px; color: red;"></i></button>
                    </div>
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
                    <input type="text"  name="kcal" placeholder="Kcal" required/>        
                </div>
                <div class="textbox">
                    <input type="text"  name="fat" placeholder="Fat" required/>
                </div>
                </div>
                <div class="nestedInputBox" style="display: flex; gap: 1.5rem; justify-content: space-between;text-align: left;width: 90%;">
                <div class="textbox">
                    <input type="text"  name="saturates" placeholder="Saturates" required/>
                </div>
                <div class="textbox">
                    <input type="text"  name="carbs" placeholder="Carbs" required/>
                </div> 
                
            </div> 
                
        <div class="nestedInputBox" style="display: flex; gap: 1.5rem; justify-content: space-between;text-align: left;width: 90%;">
            <div class="textbox">
                <input type="text"  name="sugars" placeholder="Sugar" required/>
            </div>
            <div class="textbox">
                <input type="text"  name="fibre" placeholder="Fibre" required/>
            </div>
            </div>
                <div class="nestedInputBox" style="display: flex; gap: 1.5rem; justify-content: space-between;text-align: left;width: 90%;">
            <div class="textbox">
                <input type="text"  name="protein" placeholder="Protein" required/>
            </div>
            <div class="textbox">
                <input type="text"  name="salt" placeholder="Salt" required/>
            </div>
        </div>



                    </div>
                </div>

                <br>
                <tr>
                    <td colspan="2" align="center"><input type="submit" class="btn" name="submit" value="Add Recipe !"></td>
                    
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
// Function to upload a file
function uploadFile($file, $targetDirectory, $allowedExtensions) {
    $filename = $file['name'];
    $filetemp = $file['tmp_name'];
    $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedExtensions)) {
        $uploadPath = $targetDirectory . $filename;
        move_uploaded_file($filetemp, $uploadPath);
        return $uploadPath;
    } else {
        return false; // File extension not allowed
    }
}

if (isset($_POST['submit'])) {
    // Get data from the form
    $user_id = $_POST['user_id'];
    $recipe_name = $_POST['recipe_name'];
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
    $ingredient_names = $_POST['ingredient_name'];
    $step_names = $_POST['step_name'];
    $recipe_image = $_FILES['recipe_image'];

    $check_query = "SELECT * FROM `tbl_recipes` WHERE `Recipe_Name`='$recipe_name'";
    $result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($result) > 0) { ?>
        <script>
            swal({
                title: "Alert!",
                text: "Recipe name already exists! Please choose a different name.",
                icon: "error",
            }).then(function() {
                window.location = "addrecipe.php";
            });
        </script>
    <?php } else {

    // Insert into tbl_recipes
    $recipe_query = "INSERT INTO `tbl_recipes`(`User_Id`, `Recipe_Name`, `Servings`, `Preparation_Time`, `Cooking_Time`, `Category_Id`, `Subcategory_Id`, `Recipe_Video`)
                    VALUES('$user_id', '$recipe_name', '$servings', '$preparation_time', '$cooking_time', '$category_id', '$subcategory_id', '')";
    mysqli_query($con, $recipe_query);

    // Get the last inserted recipe_id
    $recipe_id = mysqli_insert_id($con);
     
    $nutrition_query = "INSERT INTO `tbl_nutritions`(`Recipe_Id`, `Kcal`, `Fat`, `Saturates`, `Carbs`, `Sugars`, `Fibre`, `Protein`, `Salt`)
                    VALUES('$recipe_id', '$kcal', '$fat', '$saturates', '$carbs', '$sugars', '$fibre', '$protein', '$salt')";
    mysqli_query($con, $nutrition_query);

    
    // Upload and insert recipe video
    $allowedExtensionsVideo = ['mp4', 'avi', 'mov'];
    $uploadedVideo = uploadFile($recipe_video, 'images/recipevideos/', $allowedExtensionsVideo);
    if ($uploadedVideo) {
        $video_query = "UPDATE `tbl_recipes` SET `Recipe_Video`='$uploadedVideo' WHERE `Recipe_Id`='$recipe_id'";
        mysqli_query($con, $video_query);
    }

    // Insert into tbl_recipesteps
    foreach ($step_names as $step_name) {
        $step_query = "INSERT INTO `tbl_recipesteps`(`Recipe_Id`, `Step_Name`) VALUES ('$recipe_id', '$step_name')";
        mysqli_query($con, $step_query);
    }

    // Insert into tbl_recipeingredients
    foreach ($ingredient_names as $ingredient_name) {
        $ingredient_query = "INSERT INTO `tbl_recipeingredients`(`Recipe_Id`, `Ingredient_Name`) VALUES ('$recipe_id', '$ingredient_name')";
        mysqli_query($con, $ingredient_query);
    }


    $imagefilename=$recipe_image['name'];   
    $imagefileerror=$recipe_image['error'];   
    $imagefiletemp=$recipe_image['tmp_name'];
    $filename_separate=explode('.',$imagefilename);
    $file_extension=strtolower($filename_separate[1]);
    $extension=array('jpeg','jpg','png');

    if(in_array($file_extension,$extension)){
        $upload_image='images/recipeimages/'.$imagefilename;
        move_uploaded_file($imagefiletemp,$upload_image);

    // Insert uploaded image into tbl_recipeimages
    $image_query = "INSERT INTO `tbl_recipeimages`(`Recipe_Id`, `Image_Url`) VALUES('$recipe_id', '$upload_image')";
    mysqli_query($con, $image_query);

    if (mysqli_affected_rows($con) > 0) { 
        $i = 100;

                $commission_query = "INSERT INTO `tbl_payments`(`User_Id`, `Recipe_Id`, `Amount`) VALUES ('$user_id', '$recipe_id', '$i')";
                mysqli_query($con, $commission_query);

        ?>
        <script>
            swal({
                title: "Success",
                text: "Recipe Added Successfully With your Commission Amount! ",
                icon: "success",
            }).then(function() {
                window.location = "publisherviewrecipe.php";
            });
        </script>
    <?php } else { echo "error".mysqli_error($con)?>
        <script>
            swal({
                title: "Alert!",
                text: "Recipe insertion failed!",
                icon: "error",
            }).then(function() {
                window.location = "publisherviewrecipe.php";
            });
        </script>
    <?php }
} else { ?>
    <script>
        swal({
            title: "Alert!",
            text: "Image upload failed!",
            icon: "error",
        }).then(function() {
            window.location = "publisherviewrecipe.php";
        });
    </script>
<?php }
}
}

?>

