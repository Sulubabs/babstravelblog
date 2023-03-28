<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<!-- Include Bootstrap CSS -->
	<link rel="stylesheet" href="lib/bootstrap.min.css">
	<style>
		.center {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row center">
			<div class="col-6 m-auto ">
				<div class="card shadow p-3">
				<h2 class="text-center">Login</h2>
				<form action="handlelogin.php" method="post">
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
					</div>
					<div class="form-group">
						<label for="password">Password:</label>
						<input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
					</div>
					<button type="submit" class="btn btn-primary btn-block">Login</button>
				</form>
				<div class="m-3">
					<a href="registercreator.php">Create Account</a>
				</div>
			</div>
				</div>
		</div>
	</div>
	<!-- Include Bootstrap JS -->
	<script src="lib/bootstrap.min.js"></script>
</body>
</html>
