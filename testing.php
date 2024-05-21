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

<?php
$check = "<input id='test' class='hide' style='color: white; text-align: center;' readonly>";
echo $check;
$test = $_GET['get'];
echo $test;
?>

<body>
    <form method="GET">
        <input type="text" style="margin: 0 25%;" id="get" name="get">
        <input type="submit" style="margin: 0 25%;" value="Save">
        
    </form>
<script>
    let testing = document.getElementById("test");
    testing.value = "HI";
    let testingGet = document.getElementById("get");
    testingGet.value = testing.value;
</script>
</body>

</html>