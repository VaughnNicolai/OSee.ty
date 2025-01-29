<?php
session_start(); // Start or resume session
header('Content-Type: application/json');

$response = array(
    "message" => "",
    "isSuccess" => false
);

if (isset($_SESSION['message'])) {
    $response["message"] = $_SESSION['message'];
    $response["isSuccess"] = true;
    unset($_SESSION['message']); // Clear session message after fetching it
}

// Return the notification as JSON
echo json_encode($response);
?>
