<?php

use classes\database;

require 'assets/php/include.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/assets/img/icon.ico">
    <title>Beyond Horizon: Stars | Forgot Password</title>
    <link rel="stylesheet" href="assets/css/input_box.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/style.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/icons_addon.css"> <!-- ICONS API -->

</head>

<body>
    <?php
    echo "Hello world! <br>";
    $testing = "";

    echo $testing;
    $accounts = $_GET["getAccount"];
    echo $accounts;
    $user->register = $accounts;
    echo $user->account()['gender'];
    ?>
    <form method="GET">

        <input type="text" id="get" name="getAccount" readonly value="<?php
                                                                        echo $testing;
                                                                        ?>">
        <input type="submit">
    </form>
    <input type="text" readonly value="<?php
                                        echo $testing
                                        ?>">
    <script>
        const testing = "vincentruales845@gmail.com";
        document.getElementById("get").value = testing;
    </script>
</body>

</html>