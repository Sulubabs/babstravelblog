<?php
session_start();
include_once('connection.php');
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    

    // Prepare the SQL statement
    $sql = "SELECT * FROM authusers WHERE email='$email'";

    // Execute the SQL statement
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Fetch the user data
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $row["password"])) {
            // Set session variables
            $_SESSION["user_id"] = $row["userid"];
            $_SESSION["role"] = $row["role"];

            // Redirect based on the user's role
            if ($row["role"] == "creator") {
                header("Location: dashboard.php");
            } else {
                header("Location: admindashboard.php");
            }
            exit;
        } else {
            // Incorrect password
            echo "Incorrect password.";
        }
    } else {
        // User not found
        echo "User not found.";
    }
}

mysqli_close($conn);
?>
