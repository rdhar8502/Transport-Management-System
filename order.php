<?php include('functions.php') ?>

<!DOCTYPE html>
<html>
<head>
	<title>Order</title>
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
				<div class="profile_info">
						<div class="col-md-1 user-pic"><img src="images/user.png" ></div>

						<div class="col-md-1 user-info">
							<?php  if (isset($_SESSION['user'])) : ?>
								<strong><?php echo $_SESSION['user']['username']; ?></strong>

								<small>
									<i  style="color: #888; font-size:15px;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
									<br>
									<a href="index.php?logout='1'" style="color: red; font-size:12px;">logout</a>
								</small>

							<?php endif ?>
						</div>
				</div>
		</div>
		
		</div>
	</header>

<div class="header">
	<h2>Booking Order</h2>
</div>
	<form method="post" action="order.php">
		<?php echo display_error(); ?>
		<div class="form-input-group">
			<label>From</label>
			<select id="user_type" name="from">
				<?php 
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "transport";
					
					$conn = new mysqli($servername, $username, $password, $dbname); // The Connection
					$sql = ("SELECT place_name FROM `place`");
					$result = $conn->query($sql);
					while ($row = $result->fetch_assoc()) {
						echo "<option value=".$row["place_name"].">".$row["place_name"]."</option>";
					}
				?>
			</select>
		</div>
		<div class="form-input-group">
			<label>To</label>
			<select id="user_type" name="to">
				<?php 
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "transport";
					
					$conn = new mysqli($servername, $username, $password, $dbname); // The Connection
					$sql = ("SELECT place_name FROM `place`");
					$result = $conn->query($sql);
					while ($row = $result->fetch_assoc()) {
						echo "<option value=".$row["place_name"].">".$row["place_name"]."</option>";
					}
				?>
			</select>
		</div>
		<div class="form-input-group">
			<label>Date</label>
			<input type="date" name="date">
		</div>
		<div class="form-input-group">
			<label>Weight(in kg)</label>
			<input type="text" name="weight">
		</div>
		<div class="form-input-group">
			<button type="submit" class="btn" name="order_btn">Place Order</button>
		</div>
	</form>
<script src="static/js/jquery.js"></script>
<script src="static/js/bootstrap.min.js"></script>
</body>
</html>