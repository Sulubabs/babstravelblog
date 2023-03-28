<?php
session_start();
require_once('connection.php');
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$creator_id=$_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT * FROM authusers WHERE userid = $creator_id");
        if (!$result || mysqli_num_rows($result) == 0) {
            header("Location: login.php");
            exit();
        }
        $userobj = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Content Creator Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
<script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>     <style>
      .parent-div {
  max-height:30px;
  overflow: hidden;
}
    </style>
  </head>
<body>
     
<nav class="navbar navbar-expand-sm bg-dark navbar-dark nav-pills nav-fill">
<div class="container-fluid">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="#">Travel Blog Creator </a>
  <div class="collapse navbar-collapse">
  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
     <li class="nav-item">
      <a class="nav-link active" href="dashboard.php">Dashboard</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="createcontent.php">Posts content</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="updateprofile.php">Profile</a>
    </li>
   
  
  </ul>
  <div class="d-flex">
    <a href="logout.php" class="btn btn-light">Logout</a>
  </div>
  </div>
  <!-- Links -->
</div>
</nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 bg-dark text-light pt-3" style="min-height:100vh">
                <div class="sidebar-sticky">
                <img src="<?php echo $userobj['picture']?>" class="rounded mx-auto d-block" alt="..." style="max-width:100%;max height:20vh">
                <h3>My Profile</h3>
      <p>Name: <?php echo $userobj['lastname'] .' '. $userobj['firstname']?></p>
      <p>Email: <?php echo $userobj['email']?></p>
      <p>Role: <?php echo $userobj['role']?></p><p>Facebook: <?php if($userobj['facebook'] != '' & $userobj['facebook'] != ' '){echo $userobj['facebook'];}else{ echo 'No link';}?></p>
      <p>Twitter: <?php if($userobj['twitter'] != '' & $userobj['twitter'] != ' '){echo $userobj['twitter'];}else{ echo 'No link';}?></p>
      <p>Instagram: <?php if($userobj['instagram'] != '' & $userobj['instagram'] != ' '){echo $userobj['instagram'];}else{ echo 'No link';}?></p>
     </div>
            </div>

            <!-- Main content area -->
            <div class="col-md-10">
                
        <div class="m-1">
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>
<?php
if(isset($_SESSION['success'])) {
    $success_message = $_SESSION['success'];
    unset($_SESSION['success']);
?>
   <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div>
    <?php echo $success_message ?>
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php } ?>

<?php
if(isset($_SESSION['failed'])) {
    $failed_message = $_SESSION['failed'];
    unset($_SESSION['failed']);
?>
  <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
  <?php echo $failed_message ?>
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php } ?>
        </div>
   
                <h3 class="my-3">My Posts</h3>
                <div class="row">
                    <?php 
                        // Your PHP code to fetch the blog posts from the database and display them as cards
                        $sql = "SELECT * FROM blogpost WHERE creator = '$creator_id' ORDER BY id DESC";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Extract post details
                            $post_id = $row['id'];
                            $post_title = $row['title'];
                            $post_content = $row['content'];
                            $post_fore_image = $row['fore_image'];
                            $post_main_image = $row['main_image'];
                    ?>
                    <div class="col-md-3 mb-4">
                        <div class="card shadow-sm bordered">
                            <img src="<?php echo $post_fore_image; ?>" class="card-img-top" style="height:200px" alt="<?php echo $post_title; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><a href="#" class="card-link"><?php echo $post_title; ?></a></h5>
                                <div class="card-text parent-div" style="max-height: 100px;" >
                                <?php echo $post_content; ?>
                        </div>

                            </div>
                            <div class="card-body">                                
                                <a href="update_post.php?id=<?php echo $post_id; ?>" class="btn btn-sm btn-info">Update</a>
                                <?php if ($row['blocked']): ?>
                                    <button class="btn btn-sm btn-warning" onclick="unblockPost(<?php echo $post_id; ?>)">Unhide</button>
                            <?php else: ?>
                                <button class="btn btn-sm btn-secondary" onclick="blockPost(<?php echo $post_id; ?>)">Hide</button>
                            <?php endif; ?>
                                <button class="btn btn-sm btn-danger" onclick="deletePost(<?php echo $post_id; ?>)">Delete</button>

                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>
// function to handle click event on view button
function viewPost(postId) {
  window.location.href = 'view_post.php?id=' + postId;
}

// function to handle click event on update button
function updatePost(postId) {
  window.location.href = 'edit_post.php?id=' + postId;
}

// function to handle click event on delete button
function deletePost(postId) {
  if (confirm('Are you sure you want to delete this post?')) {
    // send AJAX request to delete post from database
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // reload page to show updated list of posts
        window.location.reload();
      }
    };
    xhttp.open('GET', 'delete_post.php?id=' + postId, true);
    xhttp.send();
  }
}

// function to handle click event on block button
function blockPost(postId) {
  if (confirm('Are you sure you want to hide this post from viewers?')) {
    // send AJAX request to update post status in database
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // reload page to show updated list of posts
        window.location.reload();
      }
    };
    xhttp.open('GET', 'block_post.php?id=' + postId, true);
    xhttp.send();
  }
}
// function to handle click event on block button
function unblockPost(postId) {
  if (confirm('Are you sure you want to unblock this post?')) {
    // send AJAX request to update post status in database
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // reload page to show updated list of posts
        window.location.reload();
      }
    };
    xhttp.open('GET', 'unblock_post.php?id=' + postId, true);
    xhttp.send();
  }
}
</script>

</body>
</html>