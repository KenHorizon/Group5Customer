<?php

use classes\database, classes\subscription;

include("assets/php/include.php");

session_start();
?>
<?php
// Dev Talk:
// If any accidentally click previous arrow on tab while clicked on logout they will immediately go to homepage to login again
if ($_SESSION["email"] === null) {
    header("Location: index.php");
} else {
    subscription::main($_SESSION['email']);
    $session_account = $_SESSION["email"];
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
        if (!empty($_POST["profilePictureInput"])) {
            $check = getimagesize($_FILES["profilePictureInput"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
        }
        if (!empty($_POST["profileHeaderPictureInput"])) {
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

<?php
include("header_login.php");
?>
<!--
 ACCOUNT || HANDLING DETAILS ON THE ACCOUNT [NAME, PASSWORD, EMAIL, AGE, BIRTHDAY AND SO ON...]
-->

<body>

    <div class="profile-headers">
        <?php
        echo "<img class='profile-header-picture' src='" . $account_profile_header . "'>";
        ?>
        <?php
        include("digital_clock.php");
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
                            if ($subscription_status == 1) {
                                echo
                                "<div class='group-box-column-name'>
                                <h2 class='icon-texts'>" . $user->account()["username"] . "<img class='badge-icon' src='assets/img/subscription/badge.png'></h2>
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
                    <ul>
                        <li><button class="button-borderless" id="aboutButton">About</button></li>
                        <li><button class="button-borderless" id="subscriptionButton">Subscription</button></li>
                    </ul>



                </div>
                <br>
                <div class="group-box-row hide" id="aboutPage" name="informationPage">
                    <div class="background">
                        <div class="group-box-column">
                            <?php
                            if ($user->isEmpty()) {
                                echo "<p> <b>Email</b>: " . $user->account()["email"] . "</p>";
                                echo "<p> <b>Joined</b>: " . formatDate($user->account()["created_at"], true) . "</p>";
                                echo "<p> <b>Birthday</b>: " . $birthday . "</p>";
                                echo "<p> <b>Address</b>: " . checkIfEmpty($user->account()["address"]) . "</p>";
                                echo "<p> <b>Contact</b>: " . checkIfEmpty($user->account()["contact"]) . "</p>";
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
            </div>
        </div>
        <div id="editProfilePopup" class="popup">
            <div class="edit-profile-content">
                <form class="edit-profile-container" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" enctype="multipart/form-data">
                    <div class="edit-profile-header">
                        <ul>
                            <li>
                                <a class="button-icon" id="exitButton"><span class="material-icons">close</span></a>
                            </li>
                            <li>
                                <a>Edit Profile</a>
                            </li>
                            <li style="float: right;"><input type="submit" style="border-radius: 10px; width: 150px;" class="button-borderless" for="submit" id="editProfileSave" name="editProfileSave" value="Save">
                            </li>
                        </ul>

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
    </div>
    <script src="assets/javascript/account/profile_picture_and_header.js"></script>
    <script type="module" defer src="assets/javascript/account/account.js"></script>
    <script type="module" defer src="assets/javascript/account/edit_profile.js"></script>
</body>

</html>