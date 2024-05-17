<?php

use classes\database;

require 'assets/php/include.php';
session_start();
?>
<?php
//echo $_SESSION['email'];
if ($_SESSION["email"] === null) {
    header("Location: index.php");
} else {
    $session_email = $_SESSION['email'];
    $session_account_type = $_SESSION['type'];
    $account = database::query("SELECT * FROM account WHERE uuid");
    $user->register = $session_email;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $configAccount = $_POST["configAccount"];
    $configRanks = $_POST["configRanks"];
    $approvalButton = $_POST["approvalButton"];
    $vipButton = $_POST["vipButton"];
    if (isset($_POST["configAccount"])) {
        database::query("UPDATE membership SET category = $configRanks WHERE email = '$configAccount'");
        if (isset($_POST['vip'])) {
        }
        database::query("UPDATE membership SET category = $configRanks WHERE email = '$configAccount'");
    }
    // echo $configAccount ."<br>";
    // echo $configRanks ."<br>";
    // echo $approvalButton ."<br>";
    // echo $vipButton ."<br>";
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
                <?php
                if ($session_account_type == 1) {
                    echo "  <input class='input-box' id='searchName' type='text' placeholder='Name...' style='width: 350px;' onkeyup='searchNameFunctions()'>
                            <input class='input-box' id='searchEmail' type='text' placeholder='Email...' style='width: 350px;' onkeyup='searchEmailFunctions()'>";
                } else {
                    echo "  <input class='input-box' id='searchName' type='text' placeholder='Email...' style='width: 350px;' onkeyup='searchNameFunctions()'>";
                }
                ?>
            </div>
            <table class="tables" id="searchTables" style="text-align:center;  overflow-y: scroll;">
                <?php
                if ($session_account_type == 1) {
                    echo
                    "<tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Type</th>
                    <th>Joined</th>
                    <th>Status</th>
                    <th>Rank</th>
                    <th>Action</th>
                    </tr>";
                } else {
                    echo
                    "<tr>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Joined</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Rank</th>
                    </tr>";
                }
                ?>
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
                                if ($determine_status == 0) {
                                    $status = "Offline";
                                } else {
                                    $status = "Online";
                                }
                            }
                            if ($session_account_type == 1) {
                                echo
                                "<tr>
                                <td> <p class='icon-texts' style='margin:0;'>" . $row["name"] . "</p></td>
                                <td> " . $row["email"] . " </td>
                                <td> " . $row["gender"] . " </td>
                                <td> " . $user_account_type . " </td>
                                <td> " . getBirthday($row["created_at"], true) . " </td>
                                <td> " . $status . " </td>
                                <td> " . $category . " </td>
                                <td>
                                <div class='group-box-row' style='justify-content:center;'>
                                    <button class='button-icon-1' onclick='openConfigBox(" . '"' . $email . '"' . ")'><span class='material-icons'>manage_accounts</span></button>
                                    <button class='button-icon-1' onclick='openNoticeBox()'><span class='material-icons'>warning</span></button>
                                </div>
                                </td>
                                    </tr>";
                            } else {
                                echo
                                "<tr>
                                <td>" . $row["name"] . "</td>
                                <td> " . $row["gender"] . " </td>
                                <td> " . $user_account_type . " </td>
                                <td> " . $joined . " </td>
                                <td> " . $joined . " </td>
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
        </div>
        <br>
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
        <div id="configOptionBox" class="popup">
            <div class="popup-content">
                <button style="float: right;" class="button-icon" onclick="exitButtons(configOptionBox)"><span class="material-icons">close</span></button>
                <h2 class="icon-texts"><span class="material-icons">settings</span>Options</h2>
                <form class="group-box-column" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                    <div class="group-box-rows" style="justify-content: start; flex-wrap: nowrap;">
                        <span class="material-icons" style="font-size: 45px;">account_circle</span>
                        <?php
                        echo "<input class='input-box' id='getSelectedAccount' type='text' name='configAccount' style='width: 95%;'readonly></input>";
                        ?>
                    </div>
                    <?php

                    //$get_selected_account = database::query("SELECT * FROM account WHERE email = ");
                    ?>
                    <div class="custom-select-0" style="width: 100%;">
                        <select id="rank_selection" name="configRanks" required>
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
        <script src="assets/javascript/search_bar.js"></script>
        <script type="module" defer src="assets/javascript/customer_list/membership_list.js"></script>
        <script src="assets/javascript/customer_list/membership_list_config.js"></script>

    </div>
</body>

</html>
<?php

database::get()->close();
?>