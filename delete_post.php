<?php
require_once 'connection.php'; // Include the database configuration file
session_start(); // Start a session

// Check if the user is logged in and is a creator
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'creator') {
    header('Location: login.php'); // Redirect to the login page
    exit();
}

// Check if the post ID is provided
if (!isset($_GET['id'])) {
    header('Location: dashboard.php'); // Redirect to the dashboard page
    exit();
}

$post_id = $_GET['id'];

// Check if the post belongs to the current user
$stmt = $conn->prepare("SELECT creator FROM blogpost WHERE id = ?");
$stmt->bind_param('i', $post_id);
$stmt->execute();
$stmt->bind_result($creator);
$stmt->fetch();
$stmt->close();

if ($creator != $_SESSION['user_id']) {
    header('Location: dashboard.php'); // Redirect to the dashboard page
    exit();
}

// Delete the post from the database
$stmt = $conn->prepare("DELETE FROM blogpost WHERE id = ?");
$stmt->bind_param('i', $post_id);
$stmt->execute();
$stmt->close();

// Redirect to the dashboard page with a success message
$_SESSION['success'] = 'Blog post deleted successfully.';
//header('Location: dashboard.php');
exit();
