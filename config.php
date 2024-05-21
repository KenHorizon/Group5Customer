<?php

use classes\database;

require 'assets/php/include.php';
session_start();
?>
<?php
if ($_SESSION["email"] === null) {
    header("Location: index.php");
} else {
    $get_selected_account = $_POST['getSelectedAccounts'];
    //echo $get_selected_account;
    $query_selected_account = database::query("SELECT * FROM account WHERE email = '$get_selected_account'");
    if (mysqli_num_rows($query_selected_account) > 0) {
        $selected_account = mysqli_fetch_assoc($query_selected_account);
        $selected_account_email = $selected_account['email'];
        $query_selected_account_user = database::query("SELECT * FROM user WHERE email = '$get_selected_account'");
        $query_selected_account_membership = database::query("SELECT * FROM membership WHERE email = '$get_selected_account'");
        $selected_account_user = mysqli_fetch_assoc($query_selected_account_user);
        $selected_account_membership = mysqli_fetch_assoc($query_selected_account_membership);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (array_key_exists("closeConfigBox", $_POST)) {
            header("Location: member_list.php");
        }
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
    <div id="configOptionBox" style="color: white;">
        <div class="popup-content">
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <div style="float: right;">
                    <label class="button-icon" for="closeConfigBox"><span class="material-icons">close</span></label>
                    <input type="submit" class="hide" id="closeConfigBox" name="closeConfigBox">
                </div>
                <h2 class="icon-texts"><span class="material-icons">settings</span>Options</h2>
                <div class="group-box-rows" style="justify-content: start; flex-wrap: nowrap;">
                    <span class="material-icons" style="font-size: 45px;">account_circle</span>
                    <?php
                    echo "<p style='font-family: knight-vision;'>" . $selected_account_email . "</p>";
                    ?>
                </div>
                <?php

                //$get_selected_account = database::query("SELECT * FROM account WHERE email = ");
                ?>
                <div class="group-box-column-name">
                    <?php
                    echo "<p class='icon-texts'><b>Address</b>: " . "-" . "</p>";
                    echo "<p class='icon-texts'><b>Contact</b>: " . "-" . "</p>";
                    echo "<p class='icon-texts'><b>Birthday</b>: " . formatDate($selected_account['birthday'], true) . "</p>";
                    echo "<p class='icon-texts'><b>Joined</b>: " . formatDate($selected_account['created_at'], true) . "</p>";
                    echo "<hr>";
                    echo "<p class='icon-texts'><b>Subscription Status</b>: " . checkSubscriptionStatus($selected_account_membership['status']) . "</p>";
                    echo "<p class='icon-texts'><b>Subscription Category</b>: " . $selected_account_membership['category'] . "</p>";
                    echo "<p class='icon-texts'><b>Subscription Expiration</b>: " . formatDate($selected_account_membership['expiration'], true) . "</p>";
                    ?>
                </div>
                <div class="membership-list" style="width: 100%;">
                    <select class='membership-list-select' id="rank_selection" name="configRanks" required>
                        <option value="null">Select Rank</option>
                        <option value="Wood">Wood</option>
                        <option value="Iron">Iron</option>
                        <option value="Bronze">Bronze</option>
                        <option value="Silver">Silver</option>
                        <option value="Gold">Gold</option>
                        <option value="Platinum">Platinum</option>
                        <option value="Emerald">Emerald</option>
                        <option value="Diamond">Diamond</option>
                        <option value="Master">Master</option>
                    </select>
                </div>
                <div class="slider-button">
                    <label class="switch">
                        <input type="checkbox" name="approvalButton">
                        <span class="slider round"></span>
                    </label>
                    <label style="margin-left: 0.55em;">Approval</label>
                </div>
                <div class="slider-button">
                    <label class="switch">
                        <input type="checkbox" name="vipButton">
                        <span class="slider round"></span>
                    </label>
                    <label style="margin-left: 0.55em;">VIP</label>
                </div>
                <hr style="width: 100%;">
                <br>
                <div class="group-box-row">
                    <input type="reset" class="button-borderless">
                    <div id="confirmationMessageBox" class="popup">
                        <div class="popup-content">
                            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                                <p>Account has been saved!</p>
                                <input type="submit" class="button-borderless" id="closeConfirmation" value="Confirm">
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="reasonMessageBox" class="popup">
        <div class="popup-content">
            <button style="float: right;" class="button-icon" onclick="exitButtons(reasonMessageBox)"><span class=material-icons>close</span></button>
            <br>
            <br>
            <form class="group-box-column" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <input type="text" placeholder="Email" class="input-box">
                <label for="reason">Reason</label>
                <textarea type="text" name="reason" class="reason-box" rows="10" cols="30" maxlength="90" spellcheck="false"></textarea>
                <br>
                <div class="group-box-row">
                    <input type="reset" class="button-borderless">
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
    <script type="module" defer src="assets/javascript/customer_list/membership_list.js"></script>
    <script src="assets/javascript/customer_list/membership_list_config.js"></script>
</body>

</html>
<?php

database::get()->close();
?>