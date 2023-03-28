<?php
session_start();
require_once('connection.php');
// set number of results per page
$results_per_page = 4;

// get current page number
if (isset($_GET['postid'])) {
    $current_post = $_GET['postid'];
} else {
    $current_page = 1;
}
// Fetch the blog post from the database
$result = mysqli_query($conn, "SELECT * FROM blogpost WHERE id = $current_post");
if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: index.php");
    exit();
}
$row = mysqli_fetch_assoc($result);
$post_id = $row['id'];
$post_title = $row['title'];
$post_views = $row['views'];
$post_content = $row['content'];
$post_category = $row['category'];
$post_main_image = $row['main_image'];
$post_creator = $row['creator'];
$timestamp = $row['created'];
$date = date('d', strtotime($timestamp));
$month = date('F', strtotime($timestamp));
$year = date('Y', strtotime($timestamp));

$user_result = mysqli_query($conn, "SELECT * FROM authusers WHERE userid = $post_creator");
        if (!$user_result || mysqli_num_rows($user_result) == 0) {
            header("Location: login.php");
            exit();
        }
        $userobj = mysqli_fetch_assoc($user_result);
        if (!isset($_SESSION['viewed_posts'][$post_id])) {

            // Increment the views count in the database
            $up_sql = "UPDATE blogpost SET views = views + 1 WHERE id = $post_id";
            mysqli_query($conn, $up_sql);
          
            // Add this post ID to the viewed_posts session variable to prevent multiple views
            $_SESSION['viewed_posts'][$post_id] = true;
          }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog Post - My Blog</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <style>
      .ttf{
        text-transform: capitalize;
      }
    </style>
  </head>
<body>

    <!-- Navbar -->
     
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark nav-pills nav-fill">
<div class="container-fluid">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="#">BABSTRAVELBLOG </a>
  <div class="collapse navbar-collapse">
  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
     <li class="nav-item">
      <a class="nav-link active" href="index.php">Home</a>
    </li>
     <li class="nav-item">
      <a class="nav-link" href="index.php">Blog</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="contact-us.php">Support</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="about-us.php">About</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="login.php">Members</a>
    </li>
    
   
  
  </ul>
  <div class="d-flex">
    <a href="login.php" class="btn btn-light">Login/signup</a>
  </div>
  </div>
  <!-- Links -->
</div>
</nav>

    

    <!-- Blog Post Details -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 " style="padding:2px">
                <h1 class="ttf"><?php echo $post_title ?></h1>
                <p class="text-muted">Posted on <?php echo $month .' '. $date .', '.$year ?></p>
                <img src="<?php echo $post_main_image ?>" alt="Blog Post Image" class="img-fluid mb-3" >
                <div>
                <?php echo $post_content ?>
                </div>
            </div>
            <div class="col-md-4">
 <!-- Blog Post Content -->
 <div class="container my-5">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="mb-4">Blog Post Title</h1>
            <p class="lead">by <a href="#"><?php echo $userobj['firstname'] . ' ' .$userobj['lastname'] ?></a></p>
            <hr>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">About the Author</h5>
                    <p class="card-text"><?php echo $userobj['description'] ?></p>
                </div>
            </div>
            <div class="card my-4">
                <div class="card-body">
                    <h5 class="card-title">Latest Posts</h5>
                    <ul class="list-group">
                    <?php
                                // Query to get unique categories and their counts
                                $rec_sql = "SELECT * FROM blogpost ORDER BY created DESC LIMIT 5";
                                $rec_result = mysqli_query($conn, $rec_sql);
                                // Check if there are any results
                                if (mysqli_num_rows($rec_result) > 0) {
                                    // Loop through the results and display each category and its count
                                    while ($rec_row = mysqli_fetch_assoc($rec_result)) {
                                        $etimestamp=$rec_row['created'];
                                        $edate = date('d', strtotime($etimestamp));
                                        $emonth = date('F', strtotime($etimestamp));
                                        $eyear = date('Y', strtotime($etimestamp));
                                        ?>
                                        <li class="list-group-item">
                                        <img src="<?php echo  $rec_row['main_image']?>" alt="post" style="width:100px;height:100px">
                                        <a href="#" class="btn btn-link"><?php echo $rec_row['title'] ?></a>
                                        </li>                               
                                
                            
                                        <?php

                                    }
                                } else {
                                    echo "No categories found.";
                                }


                                ?>
                       
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

              
              </div>
             <div class="col-md-8">
      <h2>Comments</h2>
      <ul class="list-group">
      <?php
    // // Get post ID from query string parameter
    // $post_id = $_GET['id'];

    // Fetch comments for the post from the database
    $com_sql = "SELECT * FROM comments WHERE postid = '$post_id' ORDER BY created DESC";
    $com_result = mysqli_query($conn, $com_sql);
    $num_of_row=mysqli_num_rows($com_result); 
    // Check if any comments were found
    if (mysqli_num_rows($result) > 0) {
        echo '<h4>'.$num_of_row.' Comments</h4>';
        // Loop through each comment and display it
        while ($row = mysqli_fetch_assoc($com_result)) {
            $comment_id = $row['id'];
            $comment = $row['comment'];
            $name = $row['name'];
            $email = $row['email'];
            $created = date('M d, Y', strtotime($row['created']));
            ?>
                    <li class="list-group-item">
          <div class="row">
            <div class="col-md-12">
              <h5><?php echo $name?></h5>
              <p class="text-muted">Posted on <?php echo $created?></p>
              <p>
                 <?php echo $comment?>
                        </p> 
            </div>
          </div>
        </li>
        
            <?php

          
        }
    } else {
        echo '<h4>05 Comments</h4>';
    }
?>
</ul>
      <div class="m-2 card shasow-sm p-2">
        <h2>Add Comment</h2>
        <form action="addcomment.php" method="POST">
        <input type="hidden" name="post_id" hidden value="<?php echo $post_id?>"> 
          <div class="mb-2">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="mb-2">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email">
          </div>
          <div class="mb-2">
            <label for="comment" class="form-label">Comment</label>
            <textarea class="form-control" id="comment" name="comment"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
   
  </div>
    </div>
    </body>
