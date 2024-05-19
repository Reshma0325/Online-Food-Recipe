<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stepId = $_POST['step_id'];

    $deleteQuery = "DELETE FROM `tbl_recipesteps` WHERE Step_Id = ? ";
    $stmt = $con->prepare($deleteQuery);
    $stmt->bind_param('i', $stepId);
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
