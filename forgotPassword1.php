<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/PHPMailer.php';
require 'vendor/SMTP.php';
require 'vendor/Exception.php';

static $email_error = "";
if (isset($_POST["email"])) {
	$email = $_POST['email'];
	$randomNumber = rand(1000, 9999);
	include ('dbconnection.php');
	$query = "select * from user_login where email='{$email}';";
	$result = $mysql->query($query);
	$result = $result->fetch_assoc();
	if ($result) {
		$mail = new PHPMailer(true);
		$subject = "HMD change Password";
		$body = "Your OTP for changing password is '{$randomNumber}'.";
		try {
			//$mail->SMTPDebug = 1;                   // Enable verbose debug output
			$mail->isSMTP();                                            // Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = 'handmedownapp1@gmail.com';                     // SMTP username
			$mail->Password   = 'hmdhmd23';                               // SMTP password
			$mail->SMTPSecure = "ssl";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
			$mail->Port       = 465;                                    // TCP port to connect to

			//Recipients
			$mail->isHTML(true);
			$mail->setFrom('handmedownapp1@gmail.com', 'HMD');
			$mail->addAddress($email);     // Add a recipient
			$mail->Subject = $subject;
			$mail->Body = $body;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
		$_SESSION['randomNumber'] = $randomNumber;
		$_SESSION['email'] = $email;
		header('location:forgotPassword2.php');
	} else {
		$email_error = "This email does not exist";
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>Reset Password</title>
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
				<form class="login100-form validate-form" action="forgotPassword1.php" method="post">
					<span class="login100-form-title p-b-33">
						Change Password
					</span>

					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					<p>
						<font color="red"><?php echo $email_error; ?></font>
					</p>
					<div class="container-login100-form-btn m-t-20">
						<button type="submit" class="login100-form-btn">
							Confirm Email
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
				<div class="text-center">
					<span class="txt1">
						Create an account?
					</span>

					<a href="registration.php" class="txt2 hov1">
						Sign up
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