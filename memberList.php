<?php
include("assets/php/data.php");
$uuid = "SELECT * FROM account WHERE uuid";
$result = mysqli_query($database, $uuid);

$uuid1 = "SELECT * FROM account WHERE uuid";
$result1 = mysqli_query($database, $uuid1);
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
    <link rel="stylesheet" href="assets/css/membership_list.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/icons_addon.css"> <!-- ICONS API -->

</head>

<header>
    <div class="navigation" id="navigationMenu">
        <a class="button" href="account.php" id="memberList"><i class="material-icons">home</i>Home</a>
        <a class="button" href="logout.php" id="about"><i class="material-icons">logout</i>Logout</a>
    </div>
</header>

<body>
    <div class="background">
        <!-- FOR USER INTERFACE -->
        <div id="menu">
            <h1 style="text-align: center; align-items: center; justify-content: center;"><i class="material-icons" style="font-size: 32px;">list</i>Member List</h1>
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
        <!-- FOR ADMIN INTERFACE -->
        <div id="menu">
            <h1 style="text-align: center; align-items: center; justify-content: center;"><i class="material-icons" style="font-size: 32px;">list</i>Member List</h1>
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
                    <?php
                    if (mysqli_num_rows($result1) > 0) {

                        while ($row1 = mysqli_fetch_assoc($result1)) {
                            $joined_year = split($row1["created_at"], "-")[0];
                            $joined_month = convertMonthToNames(split($row1["created_at"], "-")[1]);
                            $joined_removeTimeStamp = split($row1["created_at"], "-")[2];
                            $joined_day = split($joined_removeTimeStamp, " ")[0];
                            $joined_showTimeStamp = split($joined_removeTimeStamp, " ")[1];
                            $joined = "{$joined_month} {$joined_day}, {$joined_year}";

                            echo
                            "<tr><div class='toSearch'>
                                    <th class='admin-interface'> " . $row1["name"] . " </th>
                                    <th> " . $row1["gender"] . " </th>
                                    <th> " . $joined . " </th>
                                    <th> " . $row1["created_at"] . " </th>
                                    <th> " . $row1["created_at"] . " </th>
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
    <script src="assets/javascript/search_bar.js"></script>
</body>

</html>