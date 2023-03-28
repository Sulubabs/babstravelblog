<?php
    // Include the database connection and session start
require_once('db_config.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

// Get the blog post ID from the URL parameter
if (isset($_GET['id'])) {
  $post_id = $_GET['id'];
} else {
  header('Location: index.php');
  exit;
}

// Prepare the SELECT statement
$sql = "SELECT * FROM blogpost WHERE id = ? AND creator = ?";
$stmt = $mysqli->prepare($sql);

// Bind the parameters and execute the statement
$stmt->bind_param('ii', $post_id, $_SESSION['user_id']);
$stmt->execute();

// Fetch the result set
$result = $stmt->get_result();
$post = $result->fetch_assoc();

// Check if the blog post exists
if (!$post) {
  header('Location: index.php');
  exit;
}

    $post_id = $_GET["post_id"];

    // Fetching the blog post to be edited
    $sql = "SELECT * FROM blogpost WHERE id = $post_id";
    $result = mysqli_query($connection, $sql);
    $post = mysqli_fetch_assoc($result);

    // Updating the post
    if (isset($_POST["update_post"])) {
        $title = $_POST["title"];
        $content = $_POST["content"];
        $fore_image = $_POST["fore_image"];
        $main_image = $_POST["main_image"];

        // Updating the post in the database
        $sql = "UPDATE blogpost SET title = '$title', content = '$content', fore_image = '$fore_image', main_image = '$main_image' WHERE id = $post_id";
        mysqli_query($connection, $sql);

        header("Location: view_post.php?post_id=$post_id");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>
<body>
    <div class="container mt-5">
        <form method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $post["title"]; ?>">
            </div>
            <div class="form-group">
                <label for="fore_image">Fore Image</label>
                <input type="text" class="form-control" id="fore_image" name="fore_image" value="<?php echo $post["fore_image"]; ?>">
            </div>
            <div class="form-group">
                <label for="main_image">Main Image</label>
                <input type="text" class="form-control" id="main_image" name="main_image" value="<?php echo $post["main_image"]; ?>">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content"><?php echo $post["content"]; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="update_post">Update Post</button>
        </form>
    </div>
    <script>
        CKEDITOR.replace('content');
    </script>
</body>
</html>
