<?php

use classes\{database, subscription, user};

include("assets/php/user.php");
include("assets/php/subscription.php");

session_start();
?>
<?php
// Dev Talk:
// If any accidentally click previous arrow on tab while clicked on logout they will immediately go to homepage to login again
if ($_SESSION["email"] === null) {
    header("Location: index.php");
} else {

    $session_account = $_SESSION["email"];
    subscription::main($session_account);
    $user->register = $session_account;
    $account = $user->account();
    $account_user = $user->user();
    $membership = $user->membership();

    // 
    if ($user->isEmpty()) {
        $account_profile_picture = $user->user()['profile'];
        $account_profile_header = $user->user()['header'];
        $account_email = $user->account()['email'];
        $account_bio = $user->user()['bio'];
        if (empty($account_profile_picture) || $account_profile_picture === null) {
            $account_profile_picture = "assets/img/default_pfp.jpeg";
        }
        if (empty($account_profile_header) || $account_profile_header === null) {
            $account_profile_header = "assets/img/default_header.jpg";
        }
        if (empty($account_bio)) {
            $account_bio = "";
        }
    }


    $determine_membership_status = "";
    if ($user->membership()['status'] == 0) {
        $determine_membership_status = "Offline";
    } else {
        $determine_membership_status = "Online";
    }
}
$todayTime = time();
if ($todayTime > $user->membership()['expiration'] && $user->membership()['status'] == 1) {
    header("Refresh: 0");
}

$joined_year = split($user->account()["created_at"], "-")[0];
$joined_month = convertMonthToNames(split($user->account()["created_at"], "-")[1]);
$joined_removeTimeStamp = split($user->account()["created_at"], "-")[2];
$joined_day = (int) split($joined_removeTimeStamp, " ")[0];
$joined = "{$joined_month} {$joined_day}, {$joined_year}";

$year = split($user->account()["birthday"], "-")[0];
$month = convertMonthToNames(split($user->account()["birthday"], "-")[1]);
$day = (int) split($user->account()["birthday"], "-")[2];
$birthday = "{$month} {$day}";
$subscription_status = $user->membership()['status'];
$determine_membership_type = "";
switch ($user->membership()['type']) {
    case 0:
        $determine_membership_type = "Basic";
        break;
    case 1:
        $determine_membership_type = "Advance";
        break;
    default:
        "Basic";
}


// TODO: Allow user to make their own profile picture
// METHODS: uploading profile will save with their name with "_profile_picture" to save in database
// for now this features held back

$target_dir = "assets/upload/";
$target_header_filename = $user->account()['uuid'] . "_profile_header.png";
$target_header_file = $target_dir . $target_header_filename;

$target_profile_filename = $user->account()['uuid'] . "_profile_picture.png";
$target_profile_file = $target_dir . $target_profile_filename;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (array_key_exists('editProfileSave', $_POST)) {
        $bio_data = filter_input(INPUT_POST, "bioInput", FILTER_SANITIZE_SPECIAL_CHARS);
        $display_name = filter_input(INPUT_POST, "displayName", FILTER_SANITIZE_SPECIAL_CHARS);
        database::query("UPDATE account SET username = '$display_name' WHERE email = '$account_email'");
        database::query("UPDATE user SET bio = '$bio_data' WHERE email = '$account_email'");

        $uploadOk = 1;
        if (!empty($_POST["editProfileSave"])) {
            $check = getimagesize($_FILES["profilePictureInput"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
        }
        if (!empty($_POST["editProfileSave"])) {
            $check = getimagesize($_FILES["profileHeaderPictureInput"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
        }
        // Check if file already exists 
        if (file_exists("assets/" . $target_profile_filename)) {
            rename("assets/" . $target_profile_filename, $target_profile_file);
            unlink($target_profile_file);
            $uploadOk = 0;
        }
        if (file_exists("assets/" . $target_header_filename)) {
            rename("assets/" . $target_header_filename, $target_header_file);
            unlink($target_header_file);
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["profilePictureInput"]["tmp_name"], $target_profile_file)) {
                // if everything is ok, try to upload file
                database::query("UPDATE user SET profile = '$target_profile_file' WHERE email = '$account_email'");
                header("Refresh: 0");
            }
            if (move_uploaded_file($_FILES["profileHeaderPictureInput"]["tmp_name"], $target_header_file)) {
                // if everything is ok, try to upload file
                database::query("UPDATE user SET header = '$target_header_file' WHERE email = '$account_email'");
                header("Refresh: 0");
            }
        }
        header("Refresh: 0");
    }

    if (array_key_exists('profilePictureRemove', $_POST)) {
        database::query("UPDATE user SET profile = '' WHERE email = '$account_email'");
        unlink($target_profile_file);
        header("Refresh: 0");
    }
    if (array_key_exists('profileHeaderPictureRemove', $_POST)) {
        database::query("UPDATE user SET header = '' WHERE email = '$account_email'");
        unlink($target_header_file);
        header("Refresh: 0");
    }
    if (array_key_exists('deactivateAccountSubmit', $_POST)) {
        database::query("UPDATE account SET activated = 0 WHERE email = '$account_email'");
        header("Location: logout.php");
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
<header>
    <div class="navigation" id="navigationMenu">
        <a class="button" href="member_list.php" id="memberList"><i class="material-icons">list</i>Member List</a>
        <a class="button" href="membership.php" id="subscription"><i class="material-icons">rocket</i>Subscription</a>
        <a class="button" href="logout.php" id="logout"><i class="material-icons">logout</i>Logout</a>
    </div>
</header>
<!--
 ACCOUNT || HANDLING DETAILS ON THE ACCOUNT [NAME, PASSWORD, EMAIL, AGE, BIRTHDAY AND SO ON...]
-->

<body>
    <div class="clock-container" id="digitalClockDisplay" style="display: none;">
        <p class="icon-texts" style="font-size: 10px;"><i class="material-icons">alarm</i>
        <div class="clock-container-body">
            <div id="clock">00:00:00 </div>
        </div>
        </p>
    </div>
    <div class="profile-headers">
        <?php
        echo "<img class='profile-header-picture' src='" . $account_profile_header . "'>";
        ?>
        <div class="group-box-row">
            <?php
            echo "<img class='profile-picture' src='" . $account_profile_picture . "' style='align-items: unset;'>";
            ?>
            <div class="profile-text">
                <div class="edit-profile">
                    <div>
                        <?php
                        if ($user->isEmpty()) {
                            if ($user->membership()['status'] == 1) {
                                echo
                                "<div class='group-box-column-name'>
                                <h2 class='icon-texts'>" . $user->account()["username"] . "<img class='badge-icon' id='updateDatabase$subscription_status'></h2>
                                <div class='group-box-row'>
                                    <div class='profile-icons'><p>" . determineUserType($user->user()["type"]) . "</p></div>
                                    <div class='profile-icons'><p>VIP</p></div>
                                </div>  
                                </div>";
                            } else {

                                echo
                                "<div class='group-box-column-name'>
                                <h2>" . $user->account()["username"] . "</h2>
                                <div class='group-box-row'>
                                    <div class='profile-icons'><p>" . determineUserType($user->user()["type"]) . "</p></div>
                                </div>  
                                </div>";
                            }
                        } else {
                            echo "<h1> Unknown Account <br> </h1>";
                            echo "<p> Unknown Data <br> </p>";
                        }
                        ?>
                    </div>
                    <div>
                        <button class="button-borderless" style="border-radius: 10px;" for="profilePictureInput" id="profilePictureEdit" name="profilePictureEdit">Edit Profile</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        echo
        "<div class='group-box-column-name'>
            <p>" . $user->user()['bio'] . "</p>
        </div>";
        ?>
        <!--  -->
    </div>
    <div class="main">
        <div class="background">
            <div class="profile-account" id="aboutLayout">
                <div class="navigation" name="options">
                    <button class="button-borderless" id="aboutButton">About</button>
                    <button class="button-borderless" id="subscriptionButton">Subscription</button>
                    <button class="button-borderless" id="accountButton">Account</button>
                </div>
                <br>
                <div class="group-box-row show" id="aboutPage" name="informationPage">
                    <div class="background">
                        <div class="group-box-column">
                            <?php
                            if ($user->isEmpty()) {
                                echo "<p> <b>Email</b>: " . $user->account()["email"] . "</p>";
                                echo "<p> <b>Joined</b>: " . $joined . "</p>";
                                echo "<p> <b>Birthday</b>: " . $birthday . "</p>";
                            } else {
                                if ($user->user()['activated'] == 1) {
                                    echo "<p> <b>Email</b>: - N/A</p>";
                                    echo "<p> <b>Joined</b>: - N/A</p>";
                                    echo "<p> <b>Birthday</b>: - N/A</p>";
                                }
                                echo "<p> <b>Email</b>: - N/A</p>";
                                echo "<p> <b>Joined</b>: - N/A</p>";
                                echo "<p> <b>Birthday</b>: - N/A</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="group-box-row hide" id="subscriptionPage">
                    <div class="background">
                        <div class="group-box-column">
                            <?php
                            if ($user->isEmpty()) {
                                if ($user->membership()['status'] == 1) {
                                    echo "<p> <b>Status</b>: " . $determine_membership_status . "</p>";
                                    echo "<p> <b>Type</b>: " . $determine_membership_type . "</p>";
                                    echo "<p> <b>Level</b>: " . $user->membership()["level"] . "</p>";
                                    echo "<p> <b>Category</b>: " . $user->membership()["category"] . "</p>";
                                } else {
                                    echo "<p> <b>Status</b>: - " . $determine_membership_status . "</p>";
                                    echo "<p> <b>Type</b>: - N/A</p>";
                                    echo "<p> <b>Level</b>: - N/A</p>";
                                    echo "<p> <b>Category</b>: - N/A</p>";
                                }
                            } else {
                                if ($user->account()['activated'] === 1) {
                                    echo "<p> <b>Status</b>: - " . $determine_membership_status . "</p>";
                                    echo "<p> <b>Type</b>: - N/A</p>";
                                    echo "<p> <b>Level</b>: - N/A</p>";
                                    echo "<p> <b>Category</b>: - N/A</p>";
                                }
                                echo "<p> <b>Status</b>: - " . $determine_membership_status . "</p>";
                                echo "<p> <b>Type</b>: - N/A</p>";
                                echo "<p> <b>Level</b>: - N/A</p>";
                                echo "<p> <b>Category</b>: - N/A</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="group-box-row hide" id="accountPage">
                    <div class="group-box-row-no-warp">
                        <div class="background" name="configOptions" style="width: 20%;">
                            <div class="group-box-column">
                                <button class="button-borderless icon-texts" style="justify-content:left;" id="deactivatedAccount" name="remove"><i class="material-icons">delete</i>Deactivate Account</button>
                                <button class="button-borderless icon-texts" style="justify-content:left;" id="applyAdminButton"><i class="material-icons">mail</i>Apply us Admin</button>
                                <button class="button-borderless icon-texts" style="justify-content:left;" id="contactUsButton"><i class="material-icons">mail</i>Contact Us</button>
                                <button class="button-borderless icon-texts" style="justify-content:left;" id="termServiceButton"><i class="material-icons">list</i>Terms of Service</button>
                                <button class="button-borderless icon-texts" style="justify-content:left;" id="privacyPolicyButton"><i class="material-icons">policy</i>Privacy Policy</button>
                                <button class="button-borderless icon-texts" style="justify-content:left;" id="cookiePolicyButton"><i class="material-icons">cookie</i>Cookie Policy</button>
                            </div>
                        </div>
                        <div class="group-box-column stretch" style="margin: 0 auto; margin-left: 0.65em;">
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
                            <div class="background hide" id="applyAdmin">
                                <form class="group-box-column">
                                    <textarea type="text" name="reason" class="reason-box" rows="10" cols="30" maxlength="90" spellcheck="false"></textarea>
                                    <br>
                                    <div class="group-box-row">
                                        <input class="button-borderless" type="reset" value="Clear">
                                        <input class="button-borderless" type="submit" value="Submit">
                                    </div>
                                </form>
                            </div>
                            <div class="background hide" id="contactUs">
                                <form class="group-box-column">
                                    <textarea type="text" name="reason" class="reason-box" rows="10" cols="30" maxlength="90" spellcheck="false"></textarea>
                                    <br>
                                    <div class="group-box-row">
                                        <input class="button-borderless" type="reset" value="Clear">
                                        <input class="button-borderless" type="submit" value="Submit">
                                    </div>
                                </form>
                            </div>
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
                    </div>

                </div>
            </div>
        </div>
        <div id="editProfilePopup" class="popup">
            <div class="edit-profile-content">
                <form class="edit-profile-container" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" enctype="multipart/form-data">
                    <div class="edit-profile-header">
                        <button style="float: left;" class="button-icon" id="exitButton">X</button>
                        <h2>Edit Profile</h2>
                        <button style="float: right; border-radius: 10px;" class="button-borderless" for="submit" id="editProfileSave" name="editProfileSave">Save</button>
                    </div>
                    <div class="edit-profile-body">
                        <div class="profile-picture-container">
                            <?php
                            echo "<img id='profilePictureReview' for='profilePictureInput' class='profile-picture-edit' src='" . $account_profile_picture . "' style='align-items: unset; width:128px;height:128px;'>";
                            ?>
                            <div class="profile-avatar">
                                <label class="button-icon-3" for="profilePictureInput" id="profilePicture"><i class="material-icons">edit</i></label>
                                <input class="hide" type="file" id="profilePictureInput" name="profilePictureInput" accept=".jpg, .jpeg, .png">
                                <button class="button-icon-3" for="submit" id="profilePictureRemove" name="profilePictureRemove" style="margin-left: 10px; width:29%;"><i class="material-icons">remove</i></button>
                            </div>
                        </div>
                        <div class="profile-header-picture-container">
                            <?php
                            echo "<img id='profileHeaderPictureReview' for='profileHeaderPictureInput' class='profile-header-picture-edit' src='" . $account_profile_header . "' style='align-items: unset; width:100%;height:300px;'>";
                            ?>
                            <div class="profile-header-avatar">
                                <label class="button-icon-3" for="profileHeaderPictureInput" id="profilePicture"><i class="material-icons">edit</i></label>
                                <input class="hide" type="file" id="profileHeaderPictureInput" name="profileHeaderPictureInput" accept=".jpg, .jpeg, .png">
                                <button class="button-icon-3" for="submit" id="profileHeaderPictureRemove" name="profileHeaderPictureRemove" style="margin-left: 10px; width:29%;"><i class="material-icons">remove</i></button>
                            </div>
                        </div>
                        <div class="group-box-column">

                            <?php
                            echo "<input class='edit-profile-box' type='text' placeholder='Name' name='displayName' value='" . $user->account()['username'] . "'>";
                            ?>

                            <?php
                            echo "<input class='edit-profile-box' type='text' placeholder='Bio'  name='bioInput' value='" . $user->user()['bio'] . "'>";
                            ?>
                        </div>
                    </div>
                    <input class="hide" name="submit" type="submit">
                </form>
            </div>
        </div>
        <div id="deactivatedAccountBox" class="popup">
            <div class="deactivated-confirmation-content">
                <form class="deactivated-confirmation-container" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" enctype="multipart/form-data">
                    <div>
                        <p class="headers icon-texts" style="text-align: center;">deactivate account</p>
                    </div>
                    <p class="tooltip">Deactivating your account means, you can recover it at any time after taking this action.</p>
                    <input type="password" class="input-box" placeholder="Enter your password...">
                    <div>
                        <input class="button-borderless" name="deactivateAccountSubmit" type="submit" value="Continue">
                    </div>
                </form>
            </div>
        </div>

    </div>
    <script src="assets/javascript/account/profile_picture_and_header.js"></script>
    <script src="assets/javascript/digital_clock.js"></script>
    <!-- <script src="assets/javascript/update_page.js"></script> -->
    <script type="module" defer src="assets/javascript/account/account.js"></script>
    <script type="module" defer src="assets/javascript/account/settings.js"></script>
    <script type="module" defer src="assets/javascript/account/edit_profile.js"></script>
</body>

</html>