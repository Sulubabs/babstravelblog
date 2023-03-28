<?php
session_start();
require_once('connection.php');
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$creator_id=$_SESSION['user_id'];
$user_result = mysqli_query($conn, "SELECT * FROM authusers WHERE userid = $creator_id");
        if (!$user_result || mysqli_num_rows($user_result) == 0) {
            header("Location: login.php");
            exit();
        }
        $userobj = mysqli_fetch_assoc($user_result);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Update Post</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
<script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script> 
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

<div class="container-fluid ">
  <div class="row">
    <div class="col-sm-2 bg-dark text-light pt-3">
      <img src="<?php echo $userobj['picture']?>" class="rounded mx-auto d-block" alt="..." style="max-width:100%;max height:20vh">
                <h3>My Profile</h3>
      <p>Name: <?php echo $userobj['lastname'] .' '. $userobj['firstname']?></p>
      <p>Email: <?php echo $userobj['email']?></p>
      <p>Role: <?php echo $userobj['role']?></p>
      <p>Facebook: <?php if($userobj['facebook'] != '' & $userobj['facebook'] != ' '){echo $userobj['facebook'];}else{ echo 'No link';}?></p>
      <p>Twitter: <?php if($userobj['twitter'] != '' & $userobj['twitter'] != ' '){echo $userobj['twitter'];}else{ echo 'No link';}?></p>
      <p>Instagram: <?php if($userobj['instagram'] != '' & $userobj['instagram'] != ' '){echo $userobj['instagram'];}else{ echo 'No link';}?></p>
      

    </div>
    <div class="col-sm-10 mt-3">
     <div class='row'>        
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
   
        <div class='col-8 m-auto card p-5 shadow p-3 mb-5 bg-body rounded"'>
        <div class="" >
        <h2 class="mb-4">Update Post</h2>
        <?php
       ;
        // Get the post ID from the URL parameter
        $post_id = $_GET['id'];

        // Fetch the blog post from the database
        $result = mysqli_query($conn, "SELECT * FROM blogpost WHERE id = $post_id AND creator = {$_SESSION['user_id']}");
        if (!$result || mysqli_num_rows($result) == 0) {
            header("Location: creatordashboard.php");
            exit();
        }
        $post = mysqli_fetch_assoc($result);

        // Check if the post exists and belongs to the current user
        if (!$post) {
            echo '<div class="alert alert-danger" role="alert">Post not found or does not belong to you.</div>';
        } else {
            ?>
            <div class="row">

            
            <form action="handleupdate.php?id=<?php echo $post_id; ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group p-2">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title" value="<?php echo $post['title']; ?>" required>
                </div>
                <div class="form-group p-2">
                    <label for="title">City:</label>
                    <input type="text" class="form-control" name="location" value="<?php echo $post['location']; ?>" required>
                </div>
                <div class="form-group p-2">
          <label for="title">Category:</label>
          <select class=" form-control form-select" name="category">
     <option selected value="<?php echo $post['category'] ?>"><?php echo $post['category'] ?></option>
        <option value="beaches">Beaches</option>
        <option value="mountains">Mountains</option>
        <option value="cities">Cities</option>
        <option value="historical_sites">Historical Sites</option>
        <option value="national_parks">National Parks</option>
</select>
        </div>
                <div class="row">
                <div class="form-group p-2 col">
                        <label for="fore_image">Main Image:</label>
                        <br>
                        <?php if (!empty($post['main_image'])) : ?>
                            <img src="<?php echo $post['main_image'] ?>" height="200">
                            <br>
                            <small class="text-muted">Current Image</small>
                        <?php endif; ?>
                        <input type="file" class="form-control-file" id="main_image" name="main_image">
                    </div>
                </div>
                
                
                <div class="form-group p-2">
                    <label for="content">Content:</label>
                    <textarea name="content" id="editor"><?php echo $post['content']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Post</button>
            </form>
            </div>
            <?php
        }
        ?>
    </div>

        </div>

     </div>
   
  
</div>
  </div>
</div>
  <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
  <script>
		ClassicEditor
			.create( document.querySelector('#editor' ), {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'underline', 'subscript', 'superscript', '|', 'fontSize', '|', 'bulletedList', 'numberedList', 'link', 'undo', 'redo' ],
        fontSize: {
            options: [ 8, 9, 10, 11, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30 ]
        }			} )
			.catch( error => {
				console.error( error );
			} );
	</script>
</body>
</html>
