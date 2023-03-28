<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'connection.php';?>

// Fetch all blog posts for the current user
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM blogpost WHERE creator = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$posts = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Content Creator Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="lib/bootstrap.min.css">
    <script src="lib/jquery.min.js"></script>
    <script src="lib/popper.min.js"></script>
    <script src="lib/bootstrap.min.js"></script>
</head>
<body>
    <div class="container-fluid mt-3">
        <h2 class="mb-3">Content Creator Dashboard</h2>
        <div class="row">
            <?php foreach ($posts as $post) : ?>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $post['title']; ?></h5>
                            <p class="card-text"><?php echo substr($post['content'], 0, 100) . '...'; ?></p>
                            <a href="view_post.php?id=<?php echo $post['id']; ?>" class="btn btn-primary btn-sm">View Post</a>
                            <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="btn btn-secondary btn-sm">Edit Post</a>
                            <a href="delete_post.php?id=<?php echo $post['id']; ?>" class="btn btn-danger btn-sm">Delete Post</a>
                            <?php if ($post['blocked']): ?>
                                <a href="unblock_post.php?id=<?php echo $post['id']; ?>" class="btn btn-warning btn-sm">Unblock Post</a>
                            <?php else: ?>
                                <a href="block_post.php?id=<?php echo $post['id']; ?>" class="btn btn-warning btn-sm">Block Post</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="add_post.php" class="btn btn-primary">Add Post</a>
        <a href="logout.php" class="btn btn-danger float-right">Logout</a>
    </div>
</body>
</html>
