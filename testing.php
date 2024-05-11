<?php
include("assets/php/data.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="/assets/img/icon.png" />
    <title>Beyond Horizon: Stars | Sign Up</title>
    <link rel="stylesheet" href="/assets/css/input_box.css" />
    <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="/assets/css/style.css" />
    <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="/assets/css/icons_addon.css" />
    <!-- ICONS API -->
</head>

<body>

<?php
    echo getVerificationCode(6);
?>
</body>
</html>