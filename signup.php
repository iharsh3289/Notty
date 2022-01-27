<?php
require("partials/_dbconnect.php");

$showAlert = false;
$alert = "";
$alertType;
$usernameExists = false;
$emailExists = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = $_POST['name'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];

	$sql = "SELECT * FROM `myusers123_` WHERE `username`='$username' ";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$usernameExists = true;
	}

	$sql = "SELECT * FROM `myusers123_` WHERE `email`='$email' ";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$emailExists = true;
	}




	if ($usernameExists) {
		$showAlert = true;
		$alert = "Username Already Exists";
		$alertType = "danger";
	} else if ($emailExists) {
		$showAlert = true;
		$alert = "Username Already Exists";
		$alertType = "danger";
	} else {

		if ($password != $cpassword) {
			$showAlert = true;
			$alert = "Password Doesn't Match";
			$alertType = "warning";
		} else {
			$password = password_hash($password, PASSWORD_DEFAULT);
			$sql = "INSERT INTO `myusers123_` (`sno`, `name`, `username`, `email`, `password`, `date created`) VALUES (NULL, '$name', '$username', '$email', '$password', CURRENT_TIMESTAMP)";
			$result = mysqli_query($conn, $sql);



			if ($result) {
				$showAlert = true;
				$alert = "Account Created Succesfully. Login To Continue";
				$alertType = "success";
			} else {
				$showAlert = true;
				$alert = "Something Went Wrong";
				$alertType = "warning";
			}
		}
	}
}

?>


<?php
require("partials/_signupHeader.php");

?>
<section class="container">

	<section class="login-form">
		<form method="post" action="signup.php" role="login">
			<?php

			if ($showAlert) {
				echo '<div class="container p-0 justify-content-center "><div class="alert alert-' . $alertType . '" role="alert">
	' . $alert . '
  </div></div>';
			}
			?>
			<!-- <img src="images/login/logo.ico" class="img-responsive" alt="" /> -->
			<h1 style="color:black">
				<center>Create An Account</center>
			</h1>
			<input type="text" name="name" placeholder="Name" maxlength="15" required class="form-control input-lg" />
			<input type="text" name="username" placeholder="Username" maxlength="30" required class="form-control input-lg" />
			<input type="email" name="email" placeholder="Email" maxlength="50" required class="form-control input-lg" />
			<input type="password" name="password" placeholder="Password" required class="form-control input-lg" />
			<input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control input-lg" />
			<button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Create Account</button>
			<div>
				Already Have Account <a class="btn btn-sm btn-primary btn-block" href="login.php">Login To Account</a>
			</div>
		</form>
		<div class="form-links">
			<a href="index.php">www.notty.com</a>
		</div>
	</section>
</section>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<?php
require("partials/_footer.php");
?>