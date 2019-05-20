<?php include('../functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL - Create user</title>
	<link rel="stylesheet" type="text/css" href="../static/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../static/css/style.css">
	<style>
		.header {
			background: #003366;
		}
		button[name=register_btn] {
			background: #003366;
		}
	</style>
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
				<div class="profile_info">
						<div class="col-md-1 user-pic"><img src="../images/user.png" ></div>

						<div class="col-md-1 user-info">
							<?php  if (isset($_SESSION['user'])) : ?>
								<strong><?php echo $_SESSION['user']['username']; ?></strong>

								<small>
									<i  style="color: #888; font-size:15px;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
									<br>
									<a href="../index.php?logout='1'" style="color: red; font-size:12px;">logout</a>
								</small>

							<?php endif ?>
						</div>
				</div>
		</div>
		
		</div>
	</header>
	<div class="header-form">
		<h2>Admin - create user</h2>
	</div>
	
	<form method="post" action="create_user.php">

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
			<label>User type</label>
			<select name="user_type" id="user_type" >
				<option value=""></option>
				<option value="admin">Admin</option>
				<option value="user">User</option>
			</select>
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
			<button type="submit" class="btn" name="register_btn"> + Create user</button>
		</div>
	</form>
</body>
</html>