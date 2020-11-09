<?php
	session_start();
	
	static $OTP_error="";
	if(isset($_POST['enteredNumber'])){
		$enteredNumber = $_POST['enteredNumber'];
		$email = $_SESSION['email'];
		$randomNumber = $_SESSION['randomNumber'];
		if($enteredNumber == $randomNumber){
			header('location:forgotPassword3.php');
		} else{
			$OTP_error = "Wrong OTP";
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Reset Password</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
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
				<form class="login100-form validate-form" action="forgotPassword2.php" method="post">
					<span class="login100-form-title p-b-33">
						Change Password
					</span>
			
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="enteredNumber" placeholder="Enter 4 digit OTP number received at your mail">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					<p><font color="red"><?php echo $OTP_error; ?></font></p>
					<div class="container-login100-form-btn m-t-20">
						<button type="submit" class="login100-form-btn">
							Confirm OTP
						</button>
					</div>
					
					</form>
					
					<div class="text-center p-t-45 p-b-4">
						<span class="txt1">
							Back to
						</span>

						<a href="login.php" class="txt2 hov1">
							 Sign in
						</a>
					</div>
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