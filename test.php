<?php

use classes\database;

use function classes\callTest;

include("assets/php/database.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="icon" type="image/x-icon" href="assets/img/icon.png" />
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
		<a class="button" href="about.html" id="about"><i class="material-icons">people</i>About</a>
		<a class="button" href="createAccount.php" id="sign_up"><i class="material-icons">create</i>Sign-Up</a>
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
						<button type="submit" class="input-button">Login</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="module" defer src="assets/javascript/main.js"></script>
</body>

</html>