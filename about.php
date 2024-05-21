<?php
require 'assets/php/include.php';
session_start();

if ($_SESSION != null) {
    $user->register = $_SESSION['email'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/assets/img/icon.ico">
    <title>Beyond Horizon: Stars | About</title>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/about_developers.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/icons_addon.css"> <!-- ICONS API -->
</head>

<?php
if ($_SESSION == null) {
    include("header.php");
} else {
    include("header_login.php");
}
?>

<body style="overflow: hidden;">
    <div class="main" > 
        <div class="background" style="overflow-y: scroll; height: 740px;">
            <div class="about-developers-group">
                <div class="about-group">
                    <h1 style="text-align: left;">ABOUT</h1>
                    <hr>
                    <p>Welcome to the Beyond Horizon: Star Patreon this website developed by our group</p>
                    <p>It's main focus to see all the participating member in our patreon ranging from name and ranks</p>
                    <p>Go Beyond into your adventure in Horizon</p>
                </div>
                <div class="about-group">
                    <h3 style="text-align: center;">Group:</h3>
                    <div class="about-developers-group">
                        <div class="about-developer">
                            <h2>Vincent John R. Ruales</h2>
                            <hr>
                            <p class="title">Lead Developer</p>
                        </div>
                        <div class="about-developer">
                            <h2>Rowmel P. Roque</h2>
                            <hr>
                            <p class="title">Database Management</p>
                        </div>
                    </div>
                    <div class="about-developers-group">
                        <div class="about-developer">
                            <h2>Joshua Jade D. Ramos</h2>
                            <hr>
                            <p class="title">Front-End, Designer</p>
                        </div>
                        <div class="about-developer">
                            <h2>Ralp Lauren L. Calayag</h2>
                            <hr>
                            <p class="title">Front-End, Debuggers</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main background">
                <div style="color: white;">
                    <h1>Trivia:</h1>
                    <h2><a href="history.php" target="_blank">History</a></h2>
                    <p><img src="assets/img/icon.ico" width="5%" height="5%">Logo of this website is one of my logo in Minecraft Mods called Beyond Horizon</p>
                    <p>The Profile Account, basically mixed of twitter and facebook</p>
                    <p>The Header Image is just minecraft title of one of the game branches</p>
                    <p>The first idea is of UI and everything is having a League of Legends: Project Skin Theme, More Futuristic Theme and things</p>
                    <p>The First background is scale of 4k which sometimes load slow and the image rendering is slow</p>
                    <p>In first make all buttons just made all images background, but later using css to make one</p>
                    <p>All theme are more likely have similar in minecraft theme buttons but it's move on the my <a href="https://kenhorizon.github.io/BeyondHorizonModWiki/" target="_blank">WIKI</a> Project for my Mods</p>
                    <p>All thought my knowledge in javascript and php, still my brain adopted, MAHORAGA!!!!!!</p>
                    <p>Why my UI and are more likely blue and dark gradient of something because that's my favorite colors</p>
                    <p>I tried making animated background but failed</p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <footer>
            <hr>
            Author: Ken Horizon (Vincent John R. Ruales) <br>
            &copy; Copyright Reserved <br>
        </footer>
    </div>
</body>

</html>