<?php
include 'connection.php';

if (isset($_POST['recipe_id']) && isset($_POST['update_payment'])) {
    $recipe_id = $_POST['recipe_id'];
    $update_payment = $_POST['update_payment'];

    // Sanitize inputs to prevent SQL injection
    $recipe_id = mysqli_real_escape_string($con, $recipe_id);
    $update_payment = mysqli_real_escape_string($con, $update_payment);

    // Update payment status
    $query = "UPDATE `tbl_payments` SET Status = '$update_payment' WHERE Recipe_Id = '$recipe_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "invalid request";
}
?>
