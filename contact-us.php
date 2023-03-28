<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
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
    
    <div class="container my-3">
        <h1 class="text-center">Contact Us</h1>
        <h5 class="text-center">Send message to Support</h5>

        <div class="row justify-content-center mt-1 ">
            <div class="col-md-6 card shadowed-sm p-3">
                <form action="sendmessage.php" method="POST">
                    <div class="mb-2">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    
                    <div class="mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-2">
                        <label for="name" class="form-label">subject</label>
                        <input type="text" class="form-control" id="name" name="subject" required>
                    </div>
                    <div class="mb-2">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-center text-white py-3">
        &copy; BABSTRAVELBLOG <?php echo date('Y'); ?>
    </footer>

    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>     
</body>
</html>
