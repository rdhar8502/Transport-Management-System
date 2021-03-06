<?php 
include('../functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome TCSS online transport management system</title>
	<link rel="stylesheet" type="text/css" href="../static/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../static/css/style.css">
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
	<section>
		<div class="container content-menu">
			<div class="row content-body">
				<div class="col-md-2">
					<a href="create_user.php">
						<div class="image admin-image"><img src="../images/add_user.png">
						<p>Add User</p>
						</div>
					</a>
				</div>
				<div class="col-md-2 col-md-offset-1">
					<a href="../user_info.php">
						<div class="image admin-image"><img src="../images/user.png">
						<p>Admin Info</p>
						</div>
					</a>
				</div>
				<div class="col-md-2 col-md-offset-1">
					<a href="order_Status_admin.php">
						<div class="image admin-image"><img src="../images/order.png">
						<p>User Order</p>
						</div>
					</a>
				</div>
				<div class="col-md-2 col-md-offset-1">
					<a href="create_route.php">
						<div class="image admin-image"><img src="../images/route.png">
						<p>Add route</p>
						</div>
					</a>
				</div>
			</div>
		</div>
	</section>
	<script src="../static/js/jquery.js"></script>
	<script src="../static/js/bootstrap.min.js"></script>
</body>
</html>