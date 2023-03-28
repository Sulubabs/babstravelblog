<?php
session_start();
require_once('connection.php');
// set number of results per page
// $results_per_page = 4;

// // get current page number
// if (isset($_GET['page'])) {
//     $current_page = $_GET['page'];
// } else {
//     $current_page = 1;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Blog Site</title>
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
<script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>     
</head>
<body>
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

	<div class="container my-2">
		<h4 class="mb-4">Search</h1>
		
		<form class="mb-3" method="post">
			<div class="row">
				<div class="col-md-6 col-lg-4 mb-2">
					<input type="text" name="search" class="form-control" placeholder="Search...">
				</div>
				<div class="col-md-6 col-lg-4 mb-2">
					<select name="category" class="form-select">
						<option value="">All Categories</option>
						<?php
                                // Query to get unique categories and their counts
                                $loc_sql = "SELECT category, COUNT(*) AS count FROM blogpost GROUP BY category";
                                $loc_result = mysqli_query($conn, $loc_sql);
                                // Check if there are any results
                                if (mysqli_num_rows($loc_result) > 0) {
                                    // Loop through the results and display each category and its count
                                    while ($loc_row = mysqli_fetch_assoc($loc_result)) {
                                        echo '<option value="'. $loc_row['category'] .'">'. $loc_row['category'] .'</option>';
                                    }
                                } else {
                                    echo "No categories found.";
                                }

                                ?>
					</select>
				</div>
				<div class="col-md-6 col-lg-4 mb-2">
					<select name="location" class="form-select">
						<option value="">All Locations</option>
                        <?php
                                // Query to get unique categories and their counts
                                $loc_sql = "SELECT location, COUNT(*) AS count FROM blogpost GROUP BY location";
                                $loc_result = mysqli_query($conn, $loc_sql);
                                // Check if there are any results
                                if (mysqli_num_rows($loc_result) > 0) {
                                    // Loop through the results and display each category and its count
                                    while ($loc_row = mysqli_fetch_assoc($loc_result)) {
                                        echo '<option value="'. $loc_row['location'] .'">'. $loc_row['location'] .'</option>';
                                    }
                                } else {
                                    echo "No categories found.";
                                }

                                ?>
                               
						
					</select>
				</div>
			</div>
			<button type="submit" class="btn btn-primary">Filter</button>
		</form>
		
		<div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
			<?php include 'fetch_posts.php'; ?>
		</div>
	</div>
    
    <footer class="bg-dark text-center text-white py-3">
        &copy; BABSTRAVELBLOG <?php echo date('Y'); ?>
    </footer>
	
	<!-- Bootstrap JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha512-7Ad01r3gU8p6PAsb64cVi0Bg0TAS/mz9V7sQhYsGFXaMwizfzghig7uPcnbPkdk7VnZTAS9Xakz2voYF++s7sQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
