<?php
// Start the session
session_start();

// Include the database connection file
include_once('connection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

// Check if the post ID is set
if (!isset($_GET['id'])) {
  header('Location: dashboard.php');
  exit;
}

// Get the post ID from the URL parameter
$user_id = $_GET['id'];

// Update the status of the post to 'blocked'
$sql = "UPDATE authusers SET status = 'active' WHERE userid = $user_id AND role = 'creator' ";
$stmt = $conn->prepare($sql);
// $stmt->bind_param('i', );
$stmt->execute();

// Redirect back to the dashboard
//header('Location: dashboard.php');
exit;
?>
