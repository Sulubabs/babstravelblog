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
$post_id = $_GET['id'];

// Update the status of the post to 'blocked'
$sql = "UPDATE blogpost SET blocked = false WHERE id = ? AND creator = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $post_id, $_SESSION['user_id']);
$stmt->execute();

// Redirect back to the dashboard
//header('Location: dashboard.php');
exit;
?>
