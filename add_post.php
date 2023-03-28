<?php
session_start();
require_once('connection.php'); // Database connection configuration 0492312244
// Check if the user is logged in and is a creator
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'creator') {
    header('Location: login.php'); // Redirect to the login page
    exit();
  }
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $main_image = $_FILES['main_image']['name'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $location = $_POST['location'];
    $creator = $_SESSION['user_id'];
    // Prepend the URL to the file names
    // Prepend the URL to the file names
    // $fore_image_url = 'https://www.example.com/images/' . $fore_image;
    // $main_image_url = 'https://www.example.com/images/' . $main_image;

    // Upload images to server and get their paths
    
    $main_image_path = uploadImage('main_image', 'mainimages/');

    // Insert blog post data into the database
    $sql = "INSERT INTO blogpost (title, location, main_image, content,category, creator) VALUES ('$title', '$location', '$main_image_path', '$content','$category', '$creator')";

    if(mysqli_query($conn, $sql)) {
        // Post added successfully
        $_SESSION['success'] = "Post added successfully.";
        header("Location: dashboard.php");
        exit();
    } else {
        // Post adding failed
        $_SESSION['failed'] = "Post adding failed. Please try again.";
        header("Location: dashboard.php");
        exit();
    }
}
function uploadImage($input_name, $upload_dir) {
    // Check if file was uploaded successfully
    if(isset($_FILES[$input_name]) && $_FILES[$input_name]['error'] === UPLOAD_ERR_OK) {
        $image_url = 'http://localhost/travelblog/';
        // Check if file is an image
        $file_type = exif_imagetype($_FILES[$input_name]['tmp_name']);
        if($file_type === false) {
            // File is not an image
            return null;
        }
        // Generate a unique name for the file
        $file_name = uniqid() . '_' . $_FILES[$input_name]['name'];
        // Move the uploaded file to the upload directory
        move_uploaded_file($_FILES[$input_name]['tmp_name'],$upload_dir . $file_name);
        // Return the file path
        return $image_url . $upload_dir . $file_name;
    }
    // File upload failed
    return null;
}
?>
