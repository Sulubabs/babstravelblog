<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<!-- Include Bootstrap CSS -->
	<link rel="stylesheet" href="lib/bootstrap.min.css">
	<!-- Include jQuery -->
	<script src="lib/jquery.min.js"></script>
	<!-- Include Bootstrap JS -->
	<script src="lib/bootstrap.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#submit-btn").click(function() {
				var password = $("#password").val();
				var confirm_password = $("#confirm-password").val();
				if (password != confirm_password) {
					alert("Password and Confirm Password do not match");
					return false;
				}
			});
		});
	</script>
</head>
<body>
	<div class="container">
	<div class="row m-3">
			<div class="col-6 m-auto card shadow p-3">
		<h2>Administrator Registration Form</h2>
		<form method="post" action="registeradminuser.php">
			<div class="form-group">
				<label for="firstname">First Name:</label>
				<input type="text" class="form-control" id="firstname" name="firstname" required>
			</div>
			<div class="form-group">
				<label for="lastname">Last Name:</label>
				<input type="text" class="form-control" id="lastname" name="lastname" required>
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" class="form-control" id="email" name="email" required>
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input type="password" class="form-control" id="password" name="password" required>
			</div>
			<div class="form-group">
				<label for="confirm-password">Confirm Password:</label>
				<input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
			</div>
			<button type="submit" class="btn btn-primary" id="submit-btn">Submit</button>
		</form>
	</div>
	</div>
	</div>
</body>
</html>
