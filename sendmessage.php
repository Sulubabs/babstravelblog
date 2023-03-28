<?php
    session_start();
    include 'connection.php';

    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message']) && isset($_POST['subject'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        $subject = mysqli_real_escape_string($conn, $_POST['subject']);

        $sql = "INSERT INTO contacts (subject, name, email, message, created) VALUES ('$subject', '$name', '$email', '$message', NOW())";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['success'] = 'message added successfully.';
        } else {
            $_SESSION['failed'] = 'Error adding message: ' . mysqli_error($conn);
        }
    } else {
        $_SESSION['failed'] = 'Please fill all fields.';
    }
    // echo mysqli_error($conn);
    header('Location: messagesuccess.php');
    exit();
?>
