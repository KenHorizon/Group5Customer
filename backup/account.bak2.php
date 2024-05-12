<?php
include("assets/php/data.php");
session_start();
?>
<?php
// Dev Talk:
// If any accidentally click previous arrow on tab while clicked on logout they will immediately go to homepage to login again
if ($_SESSION["uuid"] === null) {
    header("Location: index.php");
} else {
    $session_account = $_SESSION["uuid"];

    $account_uuid = "SELECT * FROM account WHERE uuid = $session_account";
    $user_uuid = "SELECT * FROM user WHERE uuid = $session_account";
    $membership_uuid = "SELECT * FROM membership WHERE uuid = $session_account";
    $account = mysqli_query($database, $account_uuid);
    $user = mysqli_query($database, $user_uuid);
    $membership = mysqli_query($database, $membership_uuid);
    if (mysqli_num_rows($account) > 0) {
        $validated_account = mysqli_fetch_assoc($account);
        $validated_account_user = mysqli_fetch_assoc($user);
        $validated_membership_user = mysqli_fetch_assoc($membership);
        // 
        $account_profile_picture = $validated_account_user['profile'];
        $account_email = $validated_account['email'];
        $account_bio = $validated_account_user['bio'];
        if (empty($account_profile_picture) || $account_profile_picture === null) {
            $account_profile_picture = "assets/img/default_pfp.jpeg";
        }
        if (empty($account_bio)) {
            $account_bio = "";
        }
    }
}

$joined_year = split($validated_account["created_at"], "-")[0];
$joined_month = convertMonthToNames(split($validated_account["created_at"], "-")[1]);
$joined_removeTimeStamp = split($validated_account["created_at"], "-")[2];
$joined_day = (int) split($joined_removeTimeStamp, " ")[0];
$joined = "{$joined_month} {$joined_day}, {$joined_year}";

$year = split($validated_account["birthday"], "-")[0];
$month = convertMonthToNames(split($validated_account["birthday"], "-")[1]);
$day = (int) split($validated_account["birthday"], "-")[2];
$birthday = "{$month} {$day}";

// // TODO: Allow user to make their own profile picture
// // METHODS: uploading profile will save with their name with "_profile_picture" to save in database
// // for now this features held back
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $fileName = "profile_picture";
//     $target_dir = "assets/upload/";
//     $target_file = $target_dir . $validated_account['email'] . "_profile_picture.png";
//     $uploadOk = 1;

//     // Check if image file is a actual image or fake image
//     if (isset($_POST["profilePictureSave"])) {
//         $check = getimagesize($_FILES["profilePictureInput"]["tmp_name"]);
//         if ($check !== false) {
//             $uploadOk = 1;
//         } else {
//             $uploadOk = 0;
//         }
//     }

//     // Check if file already exists 
//     if (file_exists("assets/" . $validated_account['email'] . "_profile_picture.png")) {
//         rename("assets/" . $validated_account['email'] . "_profile_picture.png", $target_file);
//         unlink($target_file);
//         $uploadOk = 0;
//     }

//     // Check if $uploadOk is set to 0 by an error
//     if ($uploadOk == 0) {
//         // if everything is ok, try to upload file
//     } else {
//         move_uploaded_file($_FILES["profilePictureInput"]["tmp_name"], $target_file);
//     }
// }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bio_data = filter_input(INPUT_POST, "bioInput", FILTER_SANITIZE_SPECIAL_CHARS);
    $display_name = filter_input(INPUT_POST, "displayName", FILTER_SANITIZE_SPECIAL_CHARS);
    $update_bio = "UPDATE account SET username = '$display_name' WHERE email = '$account_email'";
    $update_bio = "UPDATE user SET bio = '$bio_data' WHERE email = '$account_email'";
    mysqli_query($database, $update_bio);
    header("Location: account.php");
}
$database->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/assets/img/icon.png">
    <title>Beyond Horizon: Stars | Profile</title>
    <link rel="stylesheet" href="assets/css/input_box.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/style.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/icons_addon.css"> <!-- ICONS API -->
</head>
<header>
    <div class="navigation" id="navigationMenu">
        <a class="button" href="memberList.php" id="memberList"><i class="material-icons">list</i>Member List</a>
        <a class="button" href="about.html" id="about"><i class="material-icons">people</i>About</a>
        <a class="button" href="membership.php" id="subscription"><i class="material-icons">rocket</i>Subscription</a>
        <a class="button" href="logout.php" id="logout"><i class="material-icons">logout</i>Logout</a>
    </div>
</header>
<!--
 ACCOUNT || HANDLING DETAILS ON THE ACCOUNT [NAME, PASSWORD, EMAIL, AGE, BIRTHDAY AND SO ON...]
-->

<body>

    <div class="profile-headers">
        <div class="group-box-row">
            <?php
            echo "<img id='profilePicture' class='profile-picture' src='" . $account_profile_picture . "' style='align-items: unset;'>";
            ?>
            <div class="profile-text">

                <div class="edit-profile">
                    <div>
                        <?php
                        if (mysqli_num_rows($account) > 0) {
                            echo
                            "<div class='group-box-column-name'>
                                <h2>" . $validated_account["username"] . "</h2>
                                <div class='group-box-row'>
                                    <div class='profile-icons'><p>" . determineUserType($validated_account_user["type"]) . "</p></div>
                                </div>  
                            </div>";
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
            <p>" . $validated_account_user['bio'] . "</p>
        </div>";
        ?>
        <!--  -->
    </div>
    <div class="main">
        <div class="background">

            <div class="navigation">
                <button class="button-borderless" onclick="aboutButton()">About</button>
                <button class="button-borderless">Membership</button>
                <button class="button-borderless">Account</button>
            </div>
            <br>
            <div class="group-box-row">
                <div class="group-box-column">
                    <div class="background" style="text-align: center;">
                        <p class="title-box" style="text-align: center;">About</p>
                        <div class="group-box-column">
                            <div class="profile-background">
                                <?php
                                if (mysqli_num_rows($account) > 0) {
                                    echo "<p class='profile-description'> <b>Email</b>: " . $validated_account["email"] . "</p>";
                                    echo "<p class='profile-description'> <b>Joined</b>: " . $joined . "</p>";
                                    echo "<p class='profile-description'> <b>Birthday</b>: " . $birthday . "</p>";
                                } else {
                                    if ($validated_account_user['deleted'] === 1) {
                                        echo "<p class='profile-description'> <b>Email</b>: - N/A</p>";
                                        echo "<p class='profile-description'> <b>Joined</b>: - N/A</p>";
                                        echo "<p class='profile-description'> <b>Birthday</b>: - N/A</p>";
                                    }
                                    echo "<p class='profile-description'> <b>Email</b>: - N/A</p>";
                                    echo "<p class='profile-description'> <b>Joined</b>: - N/A</p>";
                                    echo "<p class='profile-description'> <b>Birthday</b>: - N/A</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="group-box-column">
                    <div class="background" style="text-align: center;">
                        <p class="title-box" style="text-align: center;">Membership</p>
                        <div class="group-box-column">
                            <div class="profile-background">
                                <?php
                                if (mysqli_num_rows($account) > 0) {
                                    $active = "Active";
                                    if ($validated_membership_user["category"] == null) {
                                        $active = "Inactive";

                                        $membership_type = "Basic";
                                        if ($validated_membership_user["type"] == null) {
                                            $membership_type = "Advance";
                                        }
                                        echo "<p class='profile-description'> <b>Status</b>: - Inactive</p>";
                                        echo "<p class='profile-description'> <b>Type</b>: - N/A</p>";
                                        echo "<p class='profile-description'> <b>Rank</b>: - N/A</p>";
                                        echo "<p class='profile-description'> <b>Level</b>: - N/A</p>";
                                    } else {
                                        echo "<p class='profile-description'> <b>Status</b>: " . $active . "</p>";
                                        echo "<p class='profile-description'> <b>Type</b>: " . $membership_type . "</p>";
                                        echo "<p class='profile-description'> <b>Rank</b>: " . $validated_membership_user["category"] . "</p>";
                                        echo "<p class='profile-description'> <b>Level</b>: " . $validated_membership_user["level"] . "</p>";
                                    }
                                } else {
                                    echo "<p class='profile-description'> <b>Status</b>: - N/A</p>";
                                    echo "<p class='profile-description'> <b>Type</b>: - N/A</p>";
                                    echo "<p class='profile-description'> <b>Rank</b>: - N/A</p>";
                                    echo "<p class='profile-description'> <b>Level</b>: - N/A</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="group">
                    <div class="background">
                        <p class="title-box">Apply as Admin</p>
                        <form class="group-box-column">
                            <textarea type="text" name="reason" class="reason-box" rows="10" cols="30" maxlength="90" spellcheck="false"></textarea>
                            <br>
                            <div class="group-box-row">
                                <input class="button-borderless" type="reset" value="Clear">
                                <input class="button-borderless" type="submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="group-box-column">
                    <button class="button-borderless icon-texts">Deactivate Account <i class="material-icons">warning</i></button>
                    <button class="button-borderless icon-texts">Contact Us <i class="material-icons">mail</i></button>
                </div>
            </div>
        </div>
        <div id="editProfilePopup" class="popup">
            <div class="edit-profile-content">
                <form class="edit-profile-body" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                    <div class="edit-profile-header">
                        <button style="float: left;" class="button-icon" id="exitButtonAlt">X</button>
                        <h2>Edit Profile</h2>
                        <button style="float: right; border-radius: 10px;" class="button-borderless" for="submit">Save</button>
                    </div>
                    <?php
                    echo "<input class='edit-profile-box' type='text' placeholder='Name' name='displayName' value='" . $validated_account['username'] . "'>";
                    ?>

                    <?php
                    echo "<input class='edit-profile-box' type='text' placeholder='Bio'  name='bioInput' value='" . $validated_account_user['bio'] . "'>";
                    ?>
                    <input class="hide" name="submit" type="submit">
                </form>
            </div>
        </div>
        <script src="assets/javascript/account.js"></script>
        <script type="module" defer src="assets/javascript/edit_profile.js"></script>
</body>

</html>