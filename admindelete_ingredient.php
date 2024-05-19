<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ingredientId = $_POST['ingredient_id'];

    $deleteQuery = "DELETE FROM `tbl_recipeingredients` WHERE Ingredient_Id = ? ";
    $stmt = $con->prepare($deleteQuery);
    $stmt->bind_param('i', $ingredientId);
    if ($stmt->execute()) {
        // Optionally, you can delete related records in other tables here

        // Send a success response
        http_response_code(200);
    } else {
        // Send an error response
        http_response_code(500);
    }
} else {
    http_response_code(405); // Method Not Allowed
}
?>
