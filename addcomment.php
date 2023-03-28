<?php
    session_start();
    include 'connection.php';

    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['comment']) && isset($_POST['post_id'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $comment = mysqli_real_escape_string($conn, $_POST['comment']);
        $post_id = mysqli_real_escape_string($conn, $_POST['post_id']);

        $sql = "INSERT INTO comments (postid, name, email, comment, created) VALUES ('$post_id', '$name', '$email', '$comment', NOW())";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['success'] = 'Comment added successfully.';
        } else {
            $_SESSION['failed'] = 'Error adding comment: ' . mysqli_error($conn);
        }
    } else {
        $_SESSION['failed'] = 'Please fill all fields.';
    }
    // echo mysqli_error($conn);
    header('Location: blog-details.php?postid=' . $post_id);
    exit();
?>
