<?php
include 'connection.php';

if (isset($_GET['category_id']) && is_numeric($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    
    $query = "SELECT Subcategory_Id, Subcategory_Name FROM tbl_Subcategories WHERE Category_Id = $category_id";
    $result = mysqli_query($con, $query);

    if ($result) {
        $subcategories = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($subcategories);
    } else {
        echo json_encode(['error' => 'Error executing query']);
    }
} else {
    echo json_encode(['error' => 'Invalid or missing category_id parameter']);
}

mysqli_close($con);
?>
