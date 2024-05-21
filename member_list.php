<?php

use classes\database;

require 'assets/php/include.php';
session_start();
?>
<?php
if ($_SESSION["email"] === null) {
    header("Location: index.php");
} else {
    $session_email = $_SESSION['email'];
    $session_account_type = $_SESSION['type'];
    $user->register = $session_email;

    $account = database::query("SELECT * FROM account WHERE uuid");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // $configAccount = $_POST["configAccount"];
        // $configRanks = $_POST["configRanks"];
        // $approvalButton = $_POST["approvalButton"];
        // $vipButton = $_POST["vipButton"];
        // if (isset($_POST["configAccount"])) {
        //     database::query("UPDATE membership SET category = $configRanks WHERE email = '$configAccount'");
        //     if (isset($_POST['vip'])) {
        //     }
        //     database::query("UPDATE membership SET category = $configRanks WHERE email = '$configAccount'");
        // }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/assets/img/icon.ico">
    <title>Beyond Horizon: Stars | Member</title>
    <link rel="stylesheet" href="assets/css/table.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/style.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/input_box.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/membership_list.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/icons_addon.css"> <!-- ICONS API -->

</head>

<?php
include("header_login.php")
?>

<body>
    <br>
    <div class="background" style="margin: 0 10px;">
        <h1 class="icon-texts title-box" style="float: inline-start;"><span class="material-icons" style="font-size: 32px;">group</span>Customers</h1>
        <div id="menu">
            <div class="group-box-row">
                <input class='input-box' id='searchName' type='text' placeholder='Name...' style='width: 350px;' onkeyup='searchEmailFunctions()'>
            </div>
            <table class="tables" id="searchTables" style="text-align:center;  overflow-y: scroll;">
                <tr>
                    <?php
                    // Check if account is Admin or not
                    if ($session_account_type == 1) {
                        echo
                        "<th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Type</th>
                            <th>Joined</th>
                            <th>VIP Status</th>
                            <th>Rank</th>
                            <th>Action</th>";
                    } else {
                        echo
                        "<th>Name</th>
                            <th>Gender</th>
                            <th>Type</th>
                            <th>Joined</th>
                            <th>VIP Status</th>
                            <th>Rank</th>";
                    }
                    ?>
                </tr>

                <tr>
                <tr>
                    <?php
                    if (mysqli_num_rows($account) > 0) {
                        while ($row = mysqli_fetch_assoc($account)) {
                            $row_uuid = $row['uuid'];
                            $username = $row['username'];
                            $email = $row['email'];
                            $user = database::query("SELECT * FROM user WHERE uuid = $row_uuid");
                            $membership = database::query("SELECT * FROM membership WHERE uuid = $row_uuid");
                            while ($validate_user = mysqli_fetch_assoc($user)) {
                                $user_type = $validate_user['type'];
                                $user_account_type = determineUserType($user_type);
                            }
                            while ($validate_membership = mysqli_fetch_assoc($membership)) {
                                $determine_category = $validate_membership['category'];
                                $determine_status = $validate_membership['status'];
                                if ($determine_status == 0) {
                                    $category = "-";
                                } else {
                                    $category = $determine_category;
                                }
                            }
                            if ($session_account_type == 1) {
                                echo
                                "<tr>
                                <td> " . $row["name"] . "</></td>
                                <td> " . $row["email"] . " </td>
                                <td> " . $row["gender"] . " </td>
                                <td> " . $user_account_type . " </td>
                                <td> " . formatDate($row["created_at"], true) . " </td>
                                <td> " . checkSubscriptionStatus($determine_status) . " </td>
                                <td>
                                    <div class='membership-list' style='width: 100%;'>
                                    <select class='membership-list-select' id='rank_selection' name='configRanks' required>
                                        <option value='null'>Select Rank</option>
                                        <option value='Wood'>Wood</option>
                                        <option value='Iron'>Iron</option>
                                        <option value='Bronze'>Bronze</option>
                                        <option value='Silver'>Silver</option>
                                        <option value='Gold'>Gold</option>
                                        <option value='Platinum'>Platinum</option>
                                        <option value='Emerald'>Emerald</option>
                                        <option value='Diamond'>Diamond</option>
                                        <option value='Master'>Master</option>
                                    </select>
                                    </div>
                                </td>
                                <td>
                                <div class='group-box-row' style='justify-content:center;'>
                                     <form action='config.php' method='POST'>
                                        <input type='text' class='hide' name='getSelectedAccounts' value=" . '"' . $email . '"' . " readonly>
                                        <input type='submit' class='hide' id='getSelectedAccounts'>
                                        <label class='button-icon-1' for='getSelectedAccounts' name='configAccountButton'><span class='material-icons'>manage_accounts</span></label>
                                     </form>
                                    <button class='button-icon-1''><span class='material-icons'>warning</span></button>
                                    <label class='button-icon-1 icon-texts' for='configSaveButton'><span class='material-icons'>save</span></label>
                                    <input type='submit' class='hide' name='configSaveButton' id='configSaveButton'>
                                </div>
                                </td>
                                    </tr>";
                            } else {
                                echo
                                "<tr>
                                <td>" . $row["name"] . "</td>
                                <td> " . $row["gender"] . " </td>
                                <td> " . $user_account_type . " </td>
                                <td> " . formatDate($row["created_at"], true) . " </td>
                                <td> " . checkSubscriptionStatus($determine_status) . " </td>
                                <td> " . $category . " </td>
                                </tr>";
                            }
                        }
                    }
                    ?>
                </tr>
            </table>
        </div>
        <br>
        <script src="assets/javascript/search_bar.js"></script>
        <script type="module" defer src="assets/javascript/customer_list/membership_list.js"></script>
        <script src="assets/javascript/customer_list/membership_list_config.js"></script>

    </div>
</body>

</html>
<?php

database::get()->close();
?>