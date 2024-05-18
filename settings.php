<?php

use classes\database, classes\subscription;

include("assets/php/include.php");

session_start();
?>
<?php
// Dev Talk:
// If any accidentally click previous arrow on tab while clicked on logout they will immediately go to homepage to login again
if ($_SESSION === null) {
    header("Location: index.php");
} else {
    $notice = "";
    $user->register = $_SESSION["email"];
    $account_email = $user->account()['email'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (array_key_exists('editProfileSave', $_POST)) {
            $account_name = filter_input(INPUT_POST, "displayName", FILTER_SANITIZE_SPECIAL_CHARS);
            $account_username = filter_input(INPUT_POST, "displayUsername", FILTER_SANITIZE_SPECIAL_CHARS);
            database::query("UPDATE account SET name = '$account_name' WHERE email = '$account_email'");
            database::query("UPDATE account SET username = '$account_username' WHERE email = '$account_email'");
        }
        if (array_key_exists('changePasswordSave', $_POST)) {
            $current_password = filter_input(INPUT_POST, "current_password", FILTER_SANITIZE_SPECIAL_CHARS);
            $new_password = filter_input(INPUT_POST, "new_password", FILTER_SANITIZE_SPECIAL_CHARS);
            $confirm_password = filter_input(INPUT_POST, "confirm_new_password", FILTER_SANITIZE_SPECIAL_CHARS);
            $verified_email = database::query("SELECT * FROM account WHERE email = '$account_email' AND password = '$current_password'");
            if (mysqli_num_rows($verified_email) > 0) {
                if ($new_password === $confirm_password) {
                    $notice = "Password changed";
                    try {
                        database::query("UPDATE account SET password = '$new_password' WHERE email = '$account_email'");
                    } catch (mysqli_sql_exception) {
                        $notice = "Error!";
                    }
                    header("Refresh: 0");
                } else {
                    $notice = "Incorrect Password!, Please Try Again!";
                }
            } else {
                $notice = "????";
            }
        }
    }
}
database::get()->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/assets/img/icon.ico">
    <title>Beyond Horizon: Stars | Profile</title>
    <link rel="stylesheet" href="assets/css/input_box.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/style.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/icons_addon.css"> <!-- ICONS API -->
</head>

<?php
include("header_login.php")
?>
<!--
 ACCOUNT || HANDLING DETAILS ON THE ACCOUNT [NAME, PASSWORD, EMAIL, AGE, BIRTHDAY AND SO ON...]
-->

<body>
    <div class="main">
        <div class="group-box-row">
            <div class="group-box-row-no-warp">
                <div class="side-bar-navigation-account">
                    <h3 class="side-bar-navigation-header icon-texts" style="margin-left: 5px;">Account</h3>
                    <button class="side-bar-navigation-button icon-texts" style="justify-content:left;" id="accountButton"><span class="material-icons">manage_accounts</span>Account</button>
                    <button class="side-bar-navigation-button icon-texts" style="justify-content:left;" id="securityButton"><span class="material-icons">settings</span>Password & Security</button>
                    <button class="side-bar-navigation-button icon-texts" style="justify-content:left;" id="applyAdminButton"><span class="material-icons">mail</span>Apply us Admin</button>
                    <button class="side-bar-navigation-button icon-texts" style="justify-content:left;" id="contactUsButton"><span class="material-icons">mail</span>Contact Us</button>

                    <h3 class="side-bar-navigation-header icon-texts" style="margin-left: 5px;">Community Standards and Legal Policies</h3>
                    <button class="side-bar-navigation-button icon-texts" style="justify-content:left;" id="termServiceButton"><span class="material-icons">list</span>Terms of Service</button>
                    <button class="side-bar-navigation-button icon-texts" style="justify-content:left;" id="privacyPolicyButton"><span class="material-icons">policy</span>Privacy Policy</button>
                    <button class="side-bar-navigation-button icon-texts" style="justify-content:left;" id="cookiePolicyButton"><span class="material-icons">cookie</span>Cookie Policy</button>
                </div>
                <div class="settings-container">
                    <div class="settings">
                        <div class="background" id="introduction">
                            <div class="group-box-column">
                                <h3 class="icon-texts"><i class="material-icons">settings</i> Settings</h3>
                                <div class="slider-button">
                                    <label class="switch">
                                        <input type="checkbox" id="digitalClock" value="digitalClockConfig">
                                        <span class="slider round"></span>
                                    </label>
                                    <label style="margin-left: 0.55em;">Digital Clock</label>
                                </div>
                            </div>
                        </div>
                        <div class="background hide" id="accountBox">
                            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" enctype="multipart/form-data">
                                <div class="group-box-column">
                                    <h3>Profile</h3>
                                    <?php
                                    echo "<input class='edit-profile-box' type='text' placeholder='Name' name='displayName' value='" . $user->account()['name'] . "'>";
                                    ?>
                                    <?php
                                    echo "<input class='edit-profile-box' type='text' placeholder='Name' name='displayUsername' value='" . $user->account()['username'] . "'>";
                                    ?>
                                    <input type="submit" class="button-borderless" name="submit" value="Save" style="width: 160px; border-radius: 5px;">
                                    <h3>Personal Details</h3>
                                    <?php
                                    echo "<input class='edit-profile-box' type='text' placeholder='Name' name='displayBirthday' value='" . formatDate($user->account()["birthday"], true) . "' readonly>";
                                    ?>
                                    <?php
                                    echo "<input class='edit-profile-box' type='text' placeholder='Name' name='displayName' value='" . formatDate($user->account()["created_at"], true) . "' readonly>";
                                    ?>
                                </div>
                            </form>
                        </div>
                        <div class="background hide" id="applyAdmin">
                            <h3>Apply as Admin</h3>
                            <p>You willing to be pass the test!</p>
                            <form class="group-box-column">
                                <textarea type="text" name="reason" class="reason-box" rows="10" cols="30" maxlength="90" spellcheck="false"></textarea>
                                <br>
                                <div class="group-box-row">
                                    <input type="reset" class="button-borderless" value="Clear" name="remove" style="width: 160px; border-radius: 5px; margin-left: 2px;">
                                    <input type="submit" class="button-borderless" value="Submit" style="width: 160px; border-radius: 5px; margin-left: 2px;">
                                </div>
                            </form>
                        </div>
                        <div class="background hide" id="contactUs">
                            <h3>Contact Us</h3>
                            <form class="group-box-column">
                                <textarea type="text" name="reason" class="reason-box" rows="10" cols="30" maxlength="90" spellcheck="false"></textarea>
                                <br>
                                <div class="group-box-row">
                                    <input type="reset" class="button-borderless" value="Clear" name="remove" style="width: 160px; border-radius: 5px; margin-left: 2px;">
                                    <input type="submit" class="button-borderless" value="Submit" style="width: 160px; border-radius: 5px; margin-left: 2px;">
                                </div>
                            </form>
                        </div>
                        <div>
                            <div class="background hide" id="termService">
                                <div class="group-box-column">
                                    <h3>Term of Service</h3>
                                    <p>
                                        Beyond Horizon builds technologies and services that enable people to connect with each other, build communities, and grow businesses. These Terms govern your use of this website, and the other products, features, apps, services, technologies, and software we offer, except where we expressly state that separate terms (and not these) apply. These Products are provided to you by our Company.
                                        <br>
                                        <br>
                                        We don’t charge you to use Facebook or the other products and services covered by these Terms, unless we state otherwise. Instead, businesses and organizations, and other persons pay us to show you ads for their products and services. By using our Products, you agree that we can show you ads that we think may be relevant to you and your interests. We use your personal data to help determine which personalized ads to show you.
                                    </p>
                                </div>
                            </div>
                            <div class="background hide" id="privacyPolicy">
                                <div class="group-box-column">
                                    <h3>Privacy Policy</h3>
                                    <h3>What is the Privacy Policy and what does it cover?</h3>
                                    <p>
                                        We at Beyond Horizon want you to understand what information we collect, and how we use and share it. That’s why we encourage you to read our Privacy Policy. This helps you use in the way that’s right for you.
                                        <br><br>
                                        In the Privacy Policy, we explain how we collect, use, share, retain and transfer information. We also let you know your rights. Each section of the Policy includes helpful examples and simpler language to make our practices easier to understand. We’ve also added links to resources where you can learn more about the privacy topics that interest you.
                                    </p>
                                </div>
                            </div>
                            <div class="background hide" id="cookiePolicy">
                                <div class="group-box-column">
                                    <h3>Cookie Policy</h3>
                                    <h3>What are cookies, and what does this policy cover?</h3>
                                    <p>
                                        Cookies are small pieces of text used to store information on web browsers. Cookies are used to store and receive identifiers and other information on computers, phones and other devices. Other technologies, including data that we store on your web browser or device, identifiers associated with your device and other software, are used for similar purposes. In this policy, we refer to all of these technologies as “cookies”.
                                        <br><br>
                                        We use cookies if you have a Github account, use the , including our website and apps, or visit other websites and apps that use the Meta Products (including the Like button). Cookies enable Meta to offer the Meta Products to you and to understand the information that we receive about you, including information about your use of other websites and apps, whether or not you are registered or logged in.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="background hide" id="securityPage">
                            <h3>Password and Security</h3>
                            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                                <div class="group-box-row">
                                    <p>Change Password</p>
                                    <?php
                                    // ONLY DEVELOPERS
                                    echo "<p style='margin: 0 auto;'>" . $notice . "</p>";
                                    // echo "<p style='margin: 0 auto;'>" . $codes . "</p>";
                                    // echo "<p style='margin: 0 auto;'>" . $emails . "</p>";
                                    ?>
                                </div>
                                <div>
                                    <div class="group-box-column">
                                        <input type="text" class="input-box" name="verification" maxlength="12" placeholder="Current Password" required>
                                        <input type="password" class="input-box" name="new_password" maxlength="12" placeholder="New Password" required>
                                        <input type="password" class="input-box" name="confirm_new_password" maxlength="12" placeholder="Confirm Password" required>
                                    </div>
                                </div>
                                <div>
                                    <input style="font-weight: bold;" type="submit" class="input-button" name="changePasswordSave" value="Confirm">
                                </div>
                            </form>
                            <hr>
                            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" enctype="multipart/form-data">
                                <div>
                                    <p class="headers icon-texts" style="text-align: center;">deactivate account</p>
                                </div>
                                <p class="tooltip">Deactivating your account means, you can recover it at any time after taking this action.</p>
                                <input type="password" class="input-box" placeholder="Enter your password...">
                                <div>
                                    <input type="submit" class="button-borderless" name="deactivateAccountSubmit" value="Continue" style="width: 160px; border-radius: 5px;">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="module" defer src="assets/javascript/settings/settings.js"></script>
</body>

</html>