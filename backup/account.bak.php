<?php
include("assets/php/data.php");
session_start();
?>

<?php
$session_account = $_SESSION["uuid"];
$account_uuid = "SELECT * FROM account WHERE uuid = $session_account";
$user_uuid = "SELECT * FROM user WHERE uuid = $session_account";
$membership_uuid = "SELECT * FROM membership WHERE uuid = $session_account";

$account = mysqli_query($database, $account_uuid);
$user = mysqli_query($database, $user_uuid);
$membership = mysqli_query($database, $membership_uuid);

$database->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/assets/img/icon.png">
    <title>Beyond Horizon: Stars | Profile</title>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/icons_addon.css"> <!-- ICONS API -->
</head>

<!--
 ACCOUNT || HANDLING DETAILS ON THE ACCOUNT [NAME, PASSWORD, EMAIL, AGE, BIRTHDAY AND SO ON...]
-->

<body>
    <!--
 HEADER OF THE SITE THIS IT'S APPLY ON EVERY SITE OF THIS [CTRL + C AND V]
 -->
    <div class="page-section">
        <a href="Logo.html" style="text-decoration: none; cursor: default;">
            <img class="header" src="assets/img/title.png" alt="Beyond Horizon: Stars - Patreon">
        </a>
        <div class="navigation-background">
            <div class="navigation">
                <a class="button" href="memberList.php"><i class="material-icons">list</i>Member List</a>
                <a class="button" href="membership.php"><i class="material-icons">rocket</i>Membership</a>
                <a class="button" href="about.php"><i class="material-icons">people</i>About</a>
                <a class="button" href="assets/php/logout.php"><i class="material-icons">logout</i>Logout</a>
            </div>
        </div>
    </div>
    <br>
    <div class="main">
        <div class="background">
            <div class="group-box-column">
                <div class="group-box-row">
                    <div class="profile-headers">
                        <div class="group-box-row">
                            <img id="profilePicture" class="profile-picture" src="assets/img/default_transparent.png" style="align-items: unset;">
                            <div class="profile-text">
                                <?php
                                if (mysqli_num_rows($account) > 0) {
                                    if (mysqli_num_rows($account) > 0) {
                                        $validated_account = mysqli_fetch_assoc($account);
                                        $validated_account_user = mysqli_fetch_assoc($user);
                                        $validated_membership_user = mysqli_fetch_assoc($membership);
                                        $userType = "";
                                        if ($validated_account_user["type"] == 0) {
                                            $userType = "User";
                                        } else {
                                            $userType = "Admin";
                                        }
                                        // TODO : SIMPLER PROFILE LAYOUT

                                        // TODO :
                                        // echo
                                        // "<span>
                                        // <div class='group'>
                                        //     <img class='centered-text' src='assets/img/membership.png'>
                                        //     <div>
                                        //         <h1>" . $row["name"] . " | " . $row["email"] . "</h1> <br>
                                        //     </div>
                                        // </div>
                                        // </span>";
                                        echo "<div class='group-box-column-name'>
                                        <h2>" . $validated_account["name"] . " | " . $validated_account["email"] . "</h2>
                                        <div class='background' style='padding: 0 10px; width: 50px;'>
                                        <p>" . $userType . "</p>
                                        </div>
                                        </div>";
                                    } else {
                                        echo "<div class='group-box-column-name'>
                                        <h1> Unknown Account</h1>
                                        <p> Unknown Data</p>
                                        </div>";
                                    }
                                } else {
                                    echo "<h1> Unknown Account <br> </h1>";
                                    echo "<p> Unknown Data <br> </p>";
                                }
                                ?>
                                <div class="group-box-column" style="width: 150px;">
                                    <form id="profilePictureForm1">
                                        <div>
                                            <label class="button-borderless" style="padding: 15px; margin-left: 0px; justify-content: center;" for="profilePictureInput" id="profilePictureEdit">Edit Profile</label>
                                            <input class="hide-text" type="file" id="profilePictureInput" accept=".jpg, .jpeg, .png">
                                        </div>
                                    </form>
                                    <form id="profilePictureForm2">
                                        <div>
                                            <button class="button-borderless hide-text" style="padding: 15px; margin-left: 0px; justify-content: center; width: 100%;" for="" id="profilePictureSave">Save</button>
                                            <button class="button-borderless" style="padding: 15px; margin-left: 0px; justify-content: center; width: 100%;" for="" id="profilePictureRemove">Remove</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="group-box-row">
                            <div class="profile-layout">
                                <br>
                                <hr>
                                <br>
                                <div class="background">
                                    <div class="group-box-row">
                                        <textarea class="profile-bio-box" rows="10" cols="30" maxlength="90" id="profileBioDataText" spellcheck="false" disabled></textarea>
                                        <div class="group-box-column">
                                            <button class="button-borderless" style="padding: 15px; margin-left: 10px; width: 120px; justify-content: center;" id="bioEditButton">Edit</button>
                                            <button class="button-borderless hide-text" style="padding: 15px; margin-left: 10px; width: 120px; justify-content: center;" id="bioSaveButton">Save</button>
                                            <button class="button-borderless" style="padding: 15px; margin-left: 10px; margin-top: 10px; width: 120px; justify-content: center;" id="bioRemoveButton">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="background">
                        <div class="background" style="text-align: center; width: 100px;">
                            <p style="text-align: center;">ABOUT</p>
                        </div>
                        <hr>
                        <div class="group-box-column">
                            <?php

                            if (mysqli_num_rows($account) > 0) {
                                echo "<p> Rank: - " . $validated_membership_user["category"] . "</p>";
                                echo "<p> Type: - " . $validated_account_user["type"] . "</p>";
                                echo "<p> Joined: - " . $validated_account["created_at"] . "</p>";
                                echo "<p> Birthday: - " . $validated_account["birthday"] . "</p>";
                            } else {
                                echo "<p> Rank: - N/A</p>";
                                echo "<p> Type: - N/A</p>";
                                echo "<p> Joined: - N/A</p>";
                                echo "<p> Birthday: - N/A</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                
            </div>
            <div>
            </div>
        </div>
        <script src="assets/javascript/profile.js"></script>
        <script src="assets/javascript/message_box.js"></script>
</body>

</html>