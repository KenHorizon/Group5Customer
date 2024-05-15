<?php

use classes\{database, subscription, user};

require 'assets/php/user.php';
include("assets/php/subscription.php");
include("assets/php/main.php");

session_start();
?>
<?php
$username = filter_input(INPUT_POST, "user", FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
$result = database::query("SELECT * FROM account WHERE email = '$username' AND password = '$password'");
$notice = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($username)) {
		$notice = "Please Insert Username!";
	} elseif (empty($password)) {
		$notice = "Please Insert Password!";
	} else {
		if (mysqli_num_rows($result) > 0) {
			$user->register = $username;
			// echo "<h1>" . $validate_account_email . "</h1> <br>";
			if ($user->isEmpty()) {
				$validate_user_type = $user->user()['type'];
				$validate_account_uuid = $user->account()['uuid'];;
				$validate_account_email = $user->account()['email'];;
				// echo "<h1>".$user_name."</h1> <br>";
				// Check the email and password and later the user account if the account is activated
				if ($user->account()['email'] === $username && $user->account()['password'] === $password) {
					if ($user->account()['activated'] == 1) {
						$_SESSION['uuid'] = $validate_account_uuid;
						$_SESSION['email'] = $validate_account_email;
						$_SESSION['password'] = $user->account()['password'];
						$_SESSION['type'] = $validate_user_type;
						$_SESSION['subscriptionStart'] = $user->membership()['subscription_date'];
						subscription::main($_SESSION['email']);
						// echo "<h1>".$_SESSION['uuid']."</h1> <br>";
						// echo "<h1>".$_SESSION['email']."</h1> <br>";
						// echo "<h1>".$_SESSION['password']."</h1> <br>";
						// echo "<h1>".$_SESSION['type']."</h1> <br>";
						header("Location: account.php?username=$username");
					} else {
						database::query("UPDATE account SET activated = 1 WHERE email = '$validate_account_email");
						$_SESSION['uuid'] = $validate_account_uuid;
						$_SESSION['email'] = $validate_account_email;
						$_SESSION['password'] = $user->account()['password'];
						$_SESSION['type'] = $validate_user_type;
						$_SESSION['subscriptionStart'] = $user->membership()['subscription_date'];
						subscription::main($_SESSION['email']);
						// echo "<h1>".$_SESSION['uuid']."</h1> <br>";
						// echo "<h1>".$_SESSION['email']."</h1> <br>";
						// echo "<h1>".$_SESSION['password']."</h1> <br>";
						// echo "<h1>".$_SESSION['type']."</h1> <br>";
						header("Location: account.php?username=$username");
					}
				} else {
					$notice = "Incorrect Email/Password!";
				}
			}
			// echo "<h1>".$user_uuid."</h1> <br>";
			// echo "<h1>".$validate_account['uuid']."</h1> <br>";
			// echo "<h1>".$validate_account['username']."</h1> <br>";
			// echo "<h1>".$validate_account['email']."</h1> <br>";
		} else {
			$notice = "Incorrect Email/Password!";
		}
	}
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="/assets/img/icon.ico">
	<title>Beyond Horizon: Stars</title>
	<link rel="stylesheet" href="assets/css/style.css" />
	<!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
	<link rel="stylesheet" href="assets/css/input_box.css" />
	<!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
	<link rel="stylesheet" href="assets/css/icons_addon.css" />
	<!-- ICONS API -->
</head>
<header>
	<div class="navigation" id="navigationMenu">
		<a class="button" id="home"><i class="material-icons">home</i>Home</a>
		<a class="button" href="about.php" id="about"><i class="material-icons">people</i>About</a>
		<a class="button" href="create_account.php" id="sign_up"><i class="material-icons">create</i>Sign-Up</a>
	</div>
</header>

<body>
	<div class="main">

		<img class="header" src="assets/img/title.png">
		<div class="background">
			<div class="home-page">
				<div>

					<h1>Welcome To Beyond Horizon</h1>
					<p>
						Beyond Horizon: Stars is a community service who provide sources
						and help each other it's focus on helping others in Github
					</p>
					<p>
						other's source code/coding and others in Community :
						<a href="logo.html">Github</a>
					</p>

					<hr style="margin: 0% 1%" />
					<p style="font-size: 20px">
						Sponsored by: <br /><b>League of Legends</b> <br />Where the soul
						is trapped forever
					</p>
					<img src="assets/gif/Fuwawa_512_C.gif" width="100px" title="Fuwawa Pat" alt="Fuwawa Pat" />
				</div>
				<br />
				<div class="login-form-background">
					<textIcon>
						<textIconImg class="material-icons">login</textIconImg>
						<div>
							<h1>Login</h1>
						</div>
					</textIcon>
					<hr />
					<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
						<div class="login-form">
							<label>Email</label>
							<input type="text" for="fname" class="input-box" name="user" placeholder="Email" />
							<label>Password</label>
							<input type="password" class="input-box" name="password" id="rememberPasswordInput" placeholder="Password" />
							<div class="group">
								<label id="rememberPassword">Remember Me</label>
								<input type="checkbox" for="rememberPassword" class="input-box" name="rememberPasswords" id="checkboxRememberPassword" placeholder="Password" />
								<a href="send_email.php" style="margin: 0 20px;"> Forgot Password</a>
								<?php
								echo "<label style='margin: 0 auto; color: red;'><b>" . $notice . "</b></label>";
								?>
							</div>
						</div>
						<div style="font-size: 14px">
							<a>Don't have account yet?</a>
							<a href="createAccount.php">Click Here</a>
						</div>
						<br />
						<div>
							<button type="submit" class="input-button">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="module" defer src="assets/javascript/index/login.js"></script>
</body>

</html>