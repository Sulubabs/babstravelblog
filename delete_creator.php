<?php
require_once 'connection.php'; // Include the database configuration file
session_start(); // Start a session

// Check if the user is logged in and is a creator
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'administrator') {
    header('Location: login.php'); // Redirect to the login page
    exit();
}

// Check if the post ID is provided
if (!isset($_GET['id'])) {
    header('Location: dashboard.php'); // Redirect to the dashboard page
    exit();
}

$user_id = $_GET['id'];

// Check if the post belongs to the current user
// $stmt = $conn->prepare("SELECT role FROM authusers WHERE id = ?");
// $stmt->bind_param('i', $post_id);
// $stmt->execute();
// $stmt->bind_result($creator);
// $stmt->fetch();
// $stmt->close();

// if ($creator != 'administrator') {
//     header('Location: dashboard.php'); // Redirect to the dashboard page
//     exit();
// }

// Delete the post from the database
$stmt = $conn->prepare("DELETE FROM authusers WHERE userid = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->close();

// Redirect to the dashboard page with a success message
$_SESSION['success'] = 'Creator deleted successfully.';
//header('Location: dashboard.php');
exit();
