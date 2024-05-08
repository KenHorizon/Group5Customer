<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/assets/img/icon.png">
    <title>Beyond Horizon: Stars | Sign Up</title>
    <link rel="stylesheet" href="assets/css/input_box.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/style.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/icons_addon.css"> <!-- ICONS API -->

</head>
<body>
<!--
 HEADER OF THE SITE THIS IT'S APPLY ON EVERY SITE OF THIS [CTRL + C AND V]
 -->
 <div class="page-section">
    <img class="header" src="images/title.png" alt="Beyond Horizon: Stars - Patreon">
    <div class="page-button-body page-button-left">
        <a class="font-white button-0" href="Index.html">
            <i class="material-icons">home</i>Home</a>
        <a class="font-white button-0" href="About.html">
            <i class="material-icons">people</i>About</a>
            
        <a class="font-white button-0-selected">
            <i class="material-icons">create</i>Sign-Up</a>
    </div>
</div> 
<br>
<br>
<div class="sign-up">
    <div class="background">
        <div class="border">    
            <form action="assets/php/register.php" method="POST">
                <div class="center-text">
                <hr>
                <div class="page-button-body page-button-left">
                    <?php
                        echo "";
                    ?>
                    <a class="font-white button-0" href="AccountUser.php">
                    <i class="material-icons">create</i>Continue</a>
                 </div>
            </form>
        </div>
    </div>
</div>
<br>
<br>
<br>
</body>
</html>