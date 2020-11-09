<?php
$fname = $lname = $email = $addr = $tel = $pass = $cpass = NULL;
static $register_error = "";
static $pass_error = "";
if (isset($_POST['first_name'])) {

	$fname =  $_POST['first_name'];
	$lname = $_POST['last_name'];
	$email = $_POST['email'];
	$addr = $_POST['address'];
	$pass = $_POST['pass'];
	$cpass = $_POST['cnfrm_pass'];
	$tel = $_POST['contact'];

	if (strcmp($pass, $cpass) == 0) {
		// $mysqli = new mysqli("localhost","my_user","my_password","my_db");
		include ('dbconnection.php');
		if ($mysql->connect_errno) {
			echo "Failed to connect to MySQL: " . $mysqli->connect_error;
			exit();
		}
		$maxR = $mysql->query("select max(user_id) as nro from user_addr;");
		$maxR = $maxR->fetch_assoc();
		$maxR = $maxR['nro'];
		$maxR++;
		$login_query = "insert into user_login(email,passwd) values('{$email}','{$pass}');";
		$addr_query = "insert into user_addr(user_id,fname,lname,email,address,phone) values('{$maxR}' , '{$fname}' , '{$lname}' , '{$email}' , '{$addr}' , {$tel});";

		echo $login_query;
		echo $addr_query;

		if ($mysql->query($login_query) && $mysql->query($addr_query)) {
			header("location:login.php");
		} else {
			$register_error = "Sorry could not register";
		}
	} else $pass_error = "Passwords do not match";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Registration</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form class="login100-form validate-form" action="registration.php" method="post">
					<span class="login100-form-title p-b-33">
						Registration
					</span>
					<p align="center">
						<font color="red"><?php echo $register_error; ?></font>
					</p>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="first_name" placeholder="First Name">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="last_name" placeholder="Last Name">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="cnfrm_pass" placeholder="Confirm Password">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					<p align="center">
						<font color="red"><?php echo $pass_error; ?></font>
					</p>


					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="address" placeholder="Address">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="number" name="contact" placeholder="Contact">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-20">
						<button type="submit" class="login100-form-btn">
							Register
						</button>
					</div>

					<div class="text-center p-t-45 p-b-4">
						<span class="txt1">
							Back to
						</span>

						<a href="login.php" class="txt2 hov1">
							Sign in
						</a>
					</div>

				</form>
			</div>
		</div>
	</div>

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="js/main.js"></script>

</body>

</html>