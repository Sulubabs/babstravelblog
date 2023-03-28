

<?php
session_start();
require_once('connection.php');
// Get the post ID from the URL parameter
$post_id = $_GET['id'];

// Fetch the blog post from the database
$result = mysqli_query($conn, "SELECT * FROM blogpost WHERE id = $post_id AND creator = {$_SESSION['user_id']}");
if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: creatordashboard.php");
    exit();
}
$post = mysqli_fetch_assoc($result);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $post['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $location = $_POST['location'];
    
    $main_image_url = $post['main_image'];
    // $category_id = $_POST['category_id'];

    // // Upload images to server and get their paths
    // $fore_image_path = uploadImage('fore_image', 'foreimages/');
    // $main_image_path = uploadImage('main_image', 'mainimages/');



    
    if (isset($_FILES['main_image']) && $_FILES['main_image']['error'] == 0) {
        $main_image = $_FILES['main_image'];
        // $main_image_url = 'uploads/' . time() . '_' . $main_image['name'];
        $main_image_url = uploadImage('main_image', 'mainimages/');
        // echo 'main image changed';
    }else{
        $main_image_url = $post['main_image'];
    }

    // update the blog post in the database
    $sql = "UPDATE blogpost SET title = ?, content = ?,location = ?, main_image = ? WHERE id = ? AND creator = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssii', $title, $content, $location, $main_image_url, $post_id, $_SESSION['user_id']);
    if ($stmt->execute()) {
        $_SESSION['success'] = 'post updated successfully.';
        header('Location: dashboard.php');
    } else {
        echo 'Error updating post: ' . $stmt->error;
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
