<?php
include("assets/php/data.php");
session_start();
?>
<?php
//echo $_SESSION['email'];
if ($_SESSION["uuid"] === null) {
    header("Location: index.php");
} else {
    $session_account_type = $_SESSION['type'];
    $get_account = "SELECT * FROM account WHERE uuid";
    $account = mysqli_query($database, $get_account);
}
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $report_debug = $_POST['reason'];
//     echo $report_debug;
// }
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
    <br>
    <div class="background" style="margin: 0 10px;">
        <div id="menu">
            <h2 class="icon-texts" style="float: inline-start;"><i class="material-icons" style="font-size: 32px;">people</i>Customers</h2>

            <div class="group-box-row">
                <input class="input-box" id="searchName" type="text" placeholder="Search..." style="width: 350px;" onkeyup="searchFunctions()">
                <input class="input-box" id="searchEmail" type="text" placeholder="Email..." style="width: 350px;">
            </div>
            <!-- TODO: SEARCH BAR -->
            <!-- <input type="text" placeholder="Search..." class="input-box" id="search" onkeyup="searchFunctions()" title="Type in a category"> -->
            <table class="tables" id="searchTables" style="text-align:center">
                <?php
                if ($session_account_type == 1) {
                    echo
                    "<tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Joined</th>
                    <th>Type</th>
                    <th>Rank</th>
                    </tr>";
                } else {
                    echo
                    "<tr>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Joined</th>
                    <th>Type</th>
                    <th>Rank</th>
                    </tr>";
                }
                ?>
                <tr>
                    <?php
                    if (mysqli_num_rows($account) > 0) {
                        while ($row = mysqli_fetch_assoc($account)) {
                            $row_uuid = $row['uuid'];
                            $get_account_user = "SELECT * FROM user WHERE uuid = $row_uuid";
                            $get_account_membership = "SELECT * FROM membership WHERE uuid = $row_uuid";

                            $user = mysqli_query($database, $get_account_user);
                            $membership = mysqli_query($database, $get_account_membership);
                            while ($validate_user = mysqli_fetch_assoc($user)) {
                                $user_type = $validate_user['type'];
                                $user_account_type = determineUserType($user_type);
                            }
                            while ($validate_membership = mysqli_fetch_assoc($membership)) {
                                $determine_category = $validate_membership['category'];
                                if ($determine_category == null) {
                                    $category = "-";
                                } else {
                                    $category = $determine_category;
                                }
                            }
                            $joined_year = split($row["created_at"], "-")[0];
                            $joined_month = convertMonthToNames(split($row["created_at"], "-")[1]);
                            $joined_removeTimeStamp = split($row["created_at"], "-")[2];
                            $joined_day = split($joined_removeTimeStamp, " ")[0];
                            $joined_showTimeStamp = split($joined_removeTimeStamp, " ")[1];
                            $joined = "{$joined_month} {$joined_day}, {$joined_year}";

                            if ($session_account_type == 1) {
                                echo
                                "<tr>
                                    <td>" . $row["name"] . "</td>
                                    <td> " . $row["email"] . " </td>
                                    <td> " . $row["gender"] . " </td>
                                    <td> " . $joined . " </td>
                                    <td> " . $user_account_type . " </td>
                                    <td> " . $category . " </td>
                                </tr>";
                            } else {
                                echo
                                "<tr>
                                    <td>" . $row["name"] . "</td>
                                    <td> " . $row["gender"] . " </td>
                                    <td> " . $joined . " </td>
                                    <td> " . $user_account_type . " </td>
                                    <td> " . $category . " </td>
                                </tr>";
                            }
                        }
                    } else {
                        echo
                        "<tr>
                        <td> - </td>
                        <td> - </td>
                        <td> - </td>
                        <td> - </td>
                        <td> - </td>
                        </tr>";
                    }
                    ?>
                </tr>
            </table>
            <br>
            <?php
            if ($session_account_type == 1) {
                echo "<div class='group-box-row'>
                        <button class='button-borderless' name='remove' style='width: 150px; justify-content:center;' id='banButton'>Ban</button>
                        <button class='button-borderless' name='remove' style='width: 150px; justify-content:center;' id='kickButton'>Kick</button>
                    </div>";
            }
            ?>
        </div>
        <br>
        <div id="reasonMessageBox" class="popup">
            <div class="popup-content">
                <button style="float: right;" class="button-icon" id="exitButton">X</button>
                <br>
                <br>
                <form class="group-box-column" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                    <input type="text" placeholder="Email" class="input-box">
                    <label for="reason">Reason</label>
                    <textarea type="text" name="reason" class="reason-box" rows="10" cols="30" maxlength="90" spellcheck="false"></textarea>
                    <br>
                    <div class="group-box-row">
                        <input type="reset" class="button-borderless">
                        <a class="button-borderless" id="confirmButton">Confirm</a>
                        <div id="confirmationMessageBox" class="popup">
                            <div class="popup-content">
                                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                                    <p>Your report has been sent!</p>
                                    <input type="submit" class="button-borderless" id="closeConfirmation" value="Confirm">
                                </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="assets/javascript/search_bar.js"></script>
        <script type="module" defer src="assets/javascript/membership_list.js"></script>
    </div>
</body>

</html>
<?php

$database->close();
?>