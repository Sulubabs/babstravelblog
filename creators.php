<?php
session_start();
require_once('connection.php');
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}
// Check if the user is logged in and is a creator
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'administrator') {
  header('Location: login.php'); // Redirect to the login page
  exit();
}
$admin_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT * FROM authusers WHERE userid = $admin_id");
if (!$result || mysqli_num_rows($result) == 0) {
  header("Location: login.php");
  exit();
}
$userobj = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html>

<head>
  <title>Travel Blog Creator Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
<script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>     
  <link rel="stylesheet" href="lib/bootstrap.min.css">
  <script src="lib/jquery.min.js"></script>
  <script src="lib/popper.min.js"></script>
  <script src="lib/bootstrap.min.js"></script>
  <!-- Include DataTables CSS and JS -->
<link rel="stylesheet" href="lib/jquery.dataTables.min.css">
<script src="lib/jquery.dataTables.min.js"></script>


</head>

<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark nav-pills nav-fill">
<div class="container-fluid">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="#">Travel Blog Creator </a>
  <div class="collapse navbar-collapse">
  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
      <a class="nav-link " href="admindashboard.php">Dashboard</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="creators.php">Posts content</a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="updateadminprofile.php">Profile</a>
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
    <div class="row"><div class="col-md-2 bg-dark text-light pt-3" style="min-height:100vh">
                <div class="sidebar-sticky">
                <img src="<?php echo $userobj['picture']?>" class="rounded mx-auto d-block" alt="..." style="max-width:100%;max height:20vh">
                <h3>My Profile</h3>
      <p>Name: <?php echo $userobj['lastname'] .' '. $userobj['firstname']?></p>
      <p>Email: <?php echo $userobj['email']?></p>
      <p>Role: <?php echo $userobj['role']?></p>
      <p>Facebook: <?php if($userobj['facebook'] != '' & $userobj['facebook'] != ' ' ){echo $userobj['facebook'];}else{ echo 'No link';}?></p>
      <p>Twitter: <?php if($userobj['twitter'] != ''  & $userobj['twitter'] != ' '){echo $userobj['twitter'];}else{ echo 'No link';}?></p>
      <p>Instagram: <?php if($userobj['instagram'] != '' & $userobj['instagram'] != ' '){echo $userobj['instagram'];}else{ echo 'No link';}?></p>
      
     </div>
            </div><div class="col-sm-10 mt-4">
                      
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
   
      <div class="card shadow p-3">
        
      <h3>Recent Posts</h3><!-- HTML code for the table -->
        <table id="blog-posts-table" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Facebook</th>
              <th>Instagram</th>
              <th>Twitter</th>
              <th>Status</th>
              <th>Date joined</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            <?php


            // Fetch blog posts data
            $sql = "SELECT * FROM authusers WHERE role= 'creator'";
            $result = mysqli_query($conn, $sql);

            // Generate table rows
            while ($row = mysqli_fetch_assoc($result)) {
              // Format created timestamp
              $created = date('F j, Y', strtotime($row['created']));

              // Generate row HTML code
              echo '<tr>';
              echo '<td>' . $row['firstname'] .$row['lastname']. '</td>';
              echo '<td>' . $row['email'] . '</td>';
              echo '<td>' . $row['facebook'] . '</td>';
              echo '<td>' . $row['instagram'] . '</td>';
              echo '<td>' . $row['twitter'] . '</td>';
              if ($row['status'] !='active') {
                echo '<td class="text-danger">Suspend</td>';
              } else {
                echo '<td class="text-primary">Active</td>';
              }
              echo '<td>' . $created . '</td>';
              echo '<td>';
            if ($row['status'] !='active'){
              echo '<button class="btn btn-sm btn-warning" onclick="unblockPost(' .$row['userid'] . ')">Unblock</button>';
            }else{
              echo '<button class="btn btn-sm btn-secondary" onclick="blockPost('.$row['userid'] . ')">Block</button>';
            }
            echo' <a href="#" class="btn btn-sm  btn-danger" onclick="deletePost('.$row['userid'] . ')">Delete</a></td>';
              echo '</tr>';
            }

            ?>
            <!-- PHP code will generate table rows here -->
          </tbody>
        </table>
       
      </div>  
      <!-- JavaScript code to initialize DataTable -->
        <script>
          $(document).ready(function () {
            $('#blog-posts-table').DataTable({
              "searching": true,
              "ordering": true,
              "info": true
            });
          });
        </script>
        <script>
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
    xhttp.open('GET', 'delete_creator.php?id=' + postId, true);
    xhttp.send();
  }
}

// function to handle click event on block button
function blockPost(postId) {
  if (confirm('Are you sure you want to blockthis creator?')) {
    // send AJAX request to update post status in database
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // reload page to show updated list of posts
        window.location.reload();
      }
    };
    xhttp.open('GET', 'block_creator.php?id=' + postId, true);
    xhttp.send();
  }
}
// function to handle click event on block button
function unblockPost(postId) {
  if (confirm('Are you sure you want to unblock this creator?')) {
    // send AJAX request to update post status in database
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // reload page to show updated list of posts
        window.location.reload();
      }
    };
    xhttp.open('GET', 'unblock_creator.php?id=' + postId, true);
    xhttp.send();
  }
}
        </script>


      </div>
    </div>
  </div>
<?php 
// Close database connection
mysqli_close($conn);?>
</body>

</html>