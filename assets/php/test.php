<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "{$_POST['year']}-{$_POST['month']}-{$_POST['day']}";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/assets/img/icon.png">
    <title>Beyond Horizon: Stars | About</title>
    <link rel="stylesheet" href="/assets/css/style.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="/assets/css/about_developers.css">
    <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="/assets/css/icons_addon.css"> <!-- ICONS API -->
</head>

<body>
    <!--
 HEADER OF THE SITE THIS IT'S APPLY ON EVERY SITE OF THIS [CTRL + C AND V]
 -->
    <div class="page-section">
        <div class="navigation-background">
            <div class="navigation">
                <a class="button" href="index.html"><i class="material-icons">home</i>Home</a>
                <a class="button disabled"><i class="material-icons">people</i>About</a>
                <a class="button" href="createAccount.php"><i class="material-icons">create</i>Sign-Up</a>
            </div>
        </div>
    </div>
    </div>

    <div class="background">
        <div class="group-box-column-name">
            <div id="clock">
                00:00:00
            </div>
        </div>
    </div>
    <script src="/assets/javascript/digital_clock.js"></script>
</body>

</html>