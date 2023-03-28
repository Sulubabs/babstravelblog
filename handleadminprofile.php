

<?php
session_start();
require_once('connection.php');
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$creator_id=$_SESSION['user_id'];

// $result = mysqli_query($conn, "SELECT * FROM authusers WHERE userid = $creator_id");
//         if (!$result || mysqli_num_rows($result) == 0) {
//             header("Location: login.php");
//             exit();
//         }
//         $userobj = mysqli_fetch_assoc($result);
// Fetch the blog post from the database
$result = mysqli_query($conn, "SELECT * FROM authusers WHERE userid = $creator_id");
if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: login.php");
    exit();
}
$post = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $p_url = $post['picture'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $facebook =$_POST['facebook'];
    $instagram = $_POST['instagram'];
    $twitter = $_POST['twitter'];
    $description = $_POST['description'];
    
    echo $instagram;

    // // Upload images to server and get their paths
    // $fore_image_path = uploadImage('fore_image', 'foreimages/');
    // $main_image_path = uploadImage('main_image', 'mainimages/');



    // check if the fore_image and main_image have been changed
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $picture = $_FILES['picture'];
        // $picturre_url = 'uploads/' . time() . '_' . $picturre['name'];
        $picture_url = uploadImage('picture', 'profile/');
    }else{
        $picture_url = $p_url;
    }
    

    // update the blog post in the database
    $sql = "UPDATE authusers SET firstname = ?, lastname = ?, facebook = ?, instagram = ?, twitter = ?, description = ?,picture = ? WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssi', $firstname, $lastname, $facebook, $instagram, $twitter,$description,$picture_url, $_SESSION['user_id']);
    if ($stmt->execute()) {
        $_SESSION['success'] = "Profile updated successfully.";
        header('Location: admindashboard.php');
    } else {
        $_SESSION['failed'] = "Profile update failed.";
        header('Location: admindashboard.php');
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
