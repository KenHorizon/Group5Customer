<?php
require 'assets/php/include.php';
session_start();
?>
<?php
if ($_SESSION == null) {
	include("header.php");
} else {
	include("header_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="icon" type="image/x-icon" href="/assets/img/icon.ico">
	<title>Beyond Horizon: Stars | About</title>
	<link rel="stylesheet" href="assets/css/style.css" />
	<link rel="stylesheet" href="assets/css/icons_addon.css" />
</head>

<body>
	<div class="main">
		<div class="background">
			<h3>First Look of Making</h3>
			<div class="group-box-row">
				<img src="assets/img/history/pre1.jpg" width="50%" />
				<img src="assets/img/history/pre2.jpg" width="50%" />
				<img src="assets/img/history/pre3.jpg" width="50%" />
				<img src="assets/img/history/pre4.jpg" width="50%" />
			</div>
			<hr>
			<h3>All background I used</h3>
			<div class="group-box-row">
				<img src="assets/img/history/b1.png" width="50%" />
				<img src="assets/img/history/b2.jpg" width="50%" />
				<img src="assets/img/history/b3.jpg" width="50%" />
			</div>
			<hr>
			<h3>Second Look</h3>
			<div class="group-box-row">
				<img src="assets/img/history/alpha1.jpg" width="50%" />
				<img src="assets/img/history/alpha2.jpg" width="50%" />
				<img src="assets/img/history/alpha3.jpg" width="50%" />
				<img src="assets/img/history/alpha4.jpg" width="50%" />
				<img src="assets/img/history/alpha5.jpg" width="50%" />
			</div>
		</div>
	</div>
</body>

</html>