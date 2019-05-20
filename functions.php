<?php 
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'transport');

// variable declaration
$username = "";
$email    = "";
$errors   = array(); 

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}

// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $email;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	// form validation: ensure that the form is correctly filled
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', '$user_type', '$password')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: home.php');
		}else{
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', 'user', '$password')";
			mysqli_query($db, $query);


			header('location: login.php');				
		}
	}
}

if (isset($_POST['order_btn'])) {
	order();
}

function order(){
	global $db, $errors, $username, $email;
	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username    =  ($_SESSION['user']['username']);
	$email       =  ($_SESSION['user']['email']);
	$pickup  	 =  e($_POST['from']);
	$drop_loc  	 =  e($_POST['to']);
	$date  		 =  e($_POST['date']);
	$weight  	 =  e($_POST['weight']);

	// form validation: ensure that the form is correctly filled
	if (empty($pickup)) { 
		array_push($errors, "from is required"); 
	}
	if (empty($drop_loc)) { 
		array_push($errors, "to is required"); 
	}
	if (empty($date)) { 
		array_push($errors, "date is required"); 
	}
	if (empty($weight)) { 
		array_push($errors, "weight is required"); 
	}
	
	// register user if there are no errors in the form
	if (count($errors) == 0) {

		$query = "INSERT INTO `order-db` (`username`, `email`, `pickup`, `drop_loc`, `date`, `weight`) 
					VALUES ('$username', '$email', '$pickup', '$drop_loc', '$date', '$weight')";
		mysqli_query($db, $query);
		
		$_SESSION['success']  = "Order place successfully";
		header('location: index.php');
		
	}
}

if (isset($_POST['add_route_btn'])) {
	route();
}

function route()
{
	global $db, $errors;
	$location  =  e($_POST['location_name']);
	
	if (empty($location)) { 
		array_push($errors, "location name is required"); 
	}
	
	if (count($errors) == 0) {

		$query = "INSERT INTO `place` (`place_name`) 
					VALUES ('$location')";
		mysqli_query($db, $query);
		
		$_SESSION['success']  = "Add location successfully";
		header('location: home.php');
		
	}
}

// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}

if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: admin/home.php');		  
			}else{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";

				header('location: index.php');
			}
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

if (isset($_GET['order_status'])) {
	order_status();
}

function order_status()
{
	global $db;
	$email    =  ($_SESSION['user']['email']);
	echo $email;
	$query = "SELECT * FROM `order-db` WHERE email='$email' ";
		$results = mysqli_query($db, $query);
		echo $results;

		if (mysqli_num_rows($results) >= 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";

				header('location: order_status.php');
			}
}

function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}