<?php
require("partials/_dbconnect.php");

$showAlert = false;
$alert = "";
$alertType;
$usernameExists = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM `myusers123_` WHERE `username`='$username' ";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$usernameExists = true;

		while ($row = mysqli_fetch_assoc($result)) {
			if (password_verify($password, $row['password'])) {
				session_start();
				$_SESSION['loggedin'] = true;
				$_SESSION['username'] = $row['username'];
				$_SESSION['name'] = $row['name'];
				header("location: index.php");
				exit;
			} else {
				$showAlert = true;
				$alert = "Invalid Password !";
				$alertType = "warning";
			}
		}
	} else {
		$showAlert = true;
		$alert = "User Doesn't Exists";
		$alertType = "warning";
	}
}

?>




<?php
require("partials/_loginHeader.php");
?>


<section class="container">
	<section class="login-form">
		<form method="post" action="login.php" role="login">
			<?php

			if ($showAlert) {
				echo '<div class="container p-0 justify-content-center "><div class="alert alert-' . $alertType . '" role="alert">
' . $alert . '
</div></div>';
			}
			?>
			<!-- <img src="images/login/logo.png" class="img-responsive" alt="" /> -->
			<h1 style="color:black">
				<center>Login To Notty</center>
			</h1>
			<input type="text" name="username" placeholder="Username" maxlength="15" required class="form-control input-lg" />
			<input type="password" name="password" placeholder="Password" required class="form-control input-lg" />
			<button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Sign in</button>
			<div>
				<a href="signup.php">Create account</a> or <a href="/reset_password.php">reset password</a>
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