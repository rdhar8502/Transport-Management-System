<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="static/css/style.css">
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
		<h2>Login</h2>
	</div>
	<form method="post" action="login.php">

		<?php echo display_error(); ?>

		<div class="form-input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="form-input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="form-input-group">
			<button type="submit" class="btn" name="login_btn">Login</button>
		</div>
		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
	</form>
	<script src="static/js/jquery.js"></script>
	<script src="static/js/bootstrap.min.js"></script>
</body>
</html>