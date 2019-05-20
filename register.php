<?php include('functions.php') ?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css">
	<link rel="stylesheet" href="static/css/style.css">
</head>
<body>
<header class="header header-page">
		<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="header-text">
				<a class="logo" href="index.php"><h2>TCSS online transport management system</h2></a>
				</div>
			<!-- notification message -->
				<?php if (isset($_SESSION['success'])) : ?>
					<div class="error success" >
						<h3>
							<?php 
								echo $_SESSION['success']; 
								unset($_SESSION['success']);
							?>
						</h3>
					</div>
				<?php endif ?>
				</div>
				<!-- logged in user information -->
		</div>
		
		</div>
	</header>
<div class="header">
	<h2>Register</h2>
</div>
<form method="post" action="register.php">
	<?php echo display_error(); ?>
	<div class="form-input-group">
		<label>Username</label>
		<input type="text" name="username" value="<?php echo $username; ?>">
	</div>
	<div class="form-input-group">
		<label>Email</label>
		<input type="email" name="email" value="<?php echo $email; ?>">
	</div>
	<div class="form-input-group">
		<label>Password</label>
		<input type="password" name="password_1">
	</div>
	<div class="form-input-group">
		<label>Confirm password</label>
		<input type="password" name="password_2">
	</div>
	<div class="form-input-group">
		<button type="submit" class="btn" name="register_btn">Register</button>
	</div>
	<p>
		Already a member? <a href="login.php">Sign in</a>
	</p>
</form>
<script src="static/js/jquery.js"></script>
<script src="static/js/bootstrap.min.js"></script>
</body>
</html>