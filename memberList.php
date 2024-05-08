<?php
include("assets/php/data.php");
$uuid = "SELECT * FROM account WHERE uuid";
$result = mysqli_query($database, $uuid);
$database->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/assets/img/icon.png">
    <title>Beyond Horizon: Stars | Member</title>
    <link rel="stylesheet" href="assets/css/table.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/style.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/input_box.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/icons_addon.css"> <!-- ICONS API -->

</head>

<body>
    <!--
HEADER OF THE SITE THIS IT'S APPLY ON EVERY SITE OF THIS [CTRL + C AND V]
-->
    <div class="page-section">
        <img class="header" src="assets/img/title.png" alt="Beyond Horizon: Stars - Patreon">
        <div class="navigation-background">
            <div class="navigation">
                <a class="button" href="account.php"><i class="material-icons">home</i>Home</a>
                <a class="button" href="index.php"><i class="material-icons">logout</i>Logout</a>
            </div>
        </div>
    </div>
    <div class="background">
        <div class="border">
            <div id="menu">
                <!-- TODO: SEARCH BAR -->
                <!-- <input type="text" placeholder="Search..." class="input-box" id="search" onkeyup="searchFunctions()" title="Type in a category"> -->
                <table class="tables" style="text-align:center">
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Joined</th>
                        <th>Type</th>
                        <th>Rank</th>
                    </tr>
                    <tr>
                        <!--
                Display any present accounts in the database, it's order in from lowest to highest form of numbers
            -->
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                $joined_year = split($row["created_at"], "-")[0];
                                $joined_month = convertMonthToNames(split($row["created_at"], "-")[1]);
                                $joined_removeTimeStamp = split($row["created_at"], "-")[2];
                                $joined_day = split($joined_removeTimeStamp, " ")[0];
                                $joined_showTimeStamp = split($joined_removeTimeStamp, " ")[1];
                                $joined = "{$joined_month} {$joined_day}, {$joined_year}";

                                echo
                                "<tr><div class='toSearch'>
                                    <th> " . $row["name"] . " </th>
                                    <th> " . $row["gender"] . " </th>
                                    <th> " . $joined . " </th>
                                    <th> " . $row["created_at"] . " </th>
                                    <th> " . $row["created_at"] . " </th>
                                </div></tr>";
                            };
                        } else {
                            echo
                            "<tr><div class='toSearch'>
                                <th class='toSearch'> - </th>
                                <th> - </th>
                                <th> - </th>
                                <th> - </th>
                                <th> - </th>
                            </div></tr>";
                        }
                        ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script src="assets/javascript/search_bar.js"></script>
</body>

</html>