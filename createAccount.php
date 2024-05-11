<?php
include("assets/php/data.php");
?>
<?php
//----- DATABASE CONNECTION -----//
// Registration Account
$notice = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_SPECIAL_CHARS);
    $last_name = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_SPECIAL_CHARS);
    $month = filter_input(INPUT_POST, "month", FILTER_SANITIZE_NUMBER_INT);
    $day = filter_input(INPUT_POST, "day", FILTER_SANITIZE_NUMBER_INT);
    $year = filter_input(INPUT_POST, "year", FILTER_SANITIZE_NUMBER_INT);
    $birthday = "{$year}-{$month}-{$day}";
    $name = "{$first_name} {$last_name}";
    // echo $name;
    // echo $username;
    // echo $email;
    // echo $birthday;
    // echo $password;
    if ($month == '0') {
        $notice = "Please select a month";
    }
    if ($gender == 'invalid') {
        $notice = "Please select a gender";
    } else {
        $registration_account = "INSERT INTO account (name, username, email, password, gender, birthday) VALUES ('$name', '$username', '$email', '$password', '$gender', '$birthday')";
        try {
            mysqli_query($database, $registration_account);
            $syncData = "SELECT * FROM account WHERE email = '$email'";
            $result = mysqli_query($database, $syncData);
            if (mysqli_num_rows($result) > 0) {
                // TODO: HOLY COW OF MOTHER OF WHAT????????
                // I DON'T KNOW WHAT IM DOING?
                $validated_account = mysqli_fetch_assoc($result);
                $validated_account_uuid = $validated_account['uuid'];
                // This will prevent other registering if one of them is having error
                try {
                    $registration_user = "INSERT INTO user (uuid, email) VALUES ('$validated_account_uuid', '$email')";
                    mysqli_query($database, $registration_user);
                    try {
                        $registration_timer = "INSERT INTO timer (uuid, email) VALUES ('$validated_account_uuid', '$email')";
                        mysqli_query($database, $registration_timer);
                        try {
                            $registration_membership = "INSERT INTO membership (uuid, email) VALUES ('$validated_account_uuid', '$email')";
                            mysqli_query($database, $registration_membership);
                        } catch (mysqli_sql_exception) {
                            $notice = "Couldn't create Account";
                        }
                    } catch (mysqli_sql_exception) {
                        $notice = "Couldn't create Account";
                    }
                } catch (mysqli_sql_exception) {
                    $notice = "Couldn't create Account";
                }
                $update_account = "UPDATE account SET activated = 1 WHERE email = '$email'";
                mysqli_query($database, $update_account);

                $update_user = "UPDATE user SET type = 0 WHERE email = '$email'";
                mysqli_query($database, $update_user);

                $update_membership = "UPDATE membership SET type = 0 WHERE email = '$email'";
                mysqli_query($database, $update_membership);

                $notice = "Your Account has been successfully registered";
                header("Location: index.php");
            }
        } catch (mysqli_sql_exception) {
            $notice = "The email is already taken!";
        }
    }
}
$database->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/assets/img/icon.png">
    <title>Beyond Horizon: Stars | Sign Up</title>
    <link rel="stylesheet" href="assets/css/input_box.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/style.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/icons_addon.css"> <!-- ICONS API -->

</head>

<header>
    <div class="navigation" id="navigationMenu">
        <a class="button" href="index.php" id="home"><i class="material-icons">home</i>Home</a>
        <a class="button" href="about.html" id="about"><i class="material-icons">people</i>About</a>
        <a class="button" id="sign_up"><i class="material-icons">create</i>Sign-Up</a>
    </div>
</header>

<body class="sign-up-background">
    <br>
    <br>
    <div class="sign-up">
        <div class="background">
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <p style="text-align: center;">Sign Up</p>
                <div class="group-box-row-no-warp">
                    <input type="text" class="input-box-name" name="first_name" placeholder="First Name" required>
                    <input type="text" class="input-box-name" name="last_name" placeholder="Last Name" required>
                </div>
                <div class="group-box-column">
                    <input type="text" class="input-box" name="username" placeholder="Username" required>
                    <input type="email" class="input-box" name="email" placeholder="Email" required>
                    <input type="password" class="input-box" name="password" placeholder="Password" required>
                </div>
                <br>
                <div class="group-box-row-no-warp">
                    <label class="input-box-selection-label" for="birthdayForm">Birthday:</label>
                    <!-- <input type="date" name="birthday" placeholder="Birthday" id="birthdayForm"> -->
                    <div class="custom-select-0" style="width: 100%;">
                        <select id="month_selection" name="month" required>
                            <option value="0">Month</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <input type="number" inputmode="numeric" min="1" max="31" class="input-box-name" name="day" id="checkNumberOnDay" placeholder="Day" required>
                    <input type="number" inputmode="numeric" min="1800" max="2060" class="input-box-name" name="year" id="checkNumberOnYear" placeholder="Year" required>
                </div>
                <div class="custom-select-1" style="width: 35%;">
                    <select name="gender" required>
                        <option value="invalid">Select A Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="undefined">Undefined</option>
                    </select>
                </div>
                <br>
                <br>
                <div>
                    <input type="reset" class="input-button" name="reset" value="Clear">
                    <input type="submit" class="input-button" name="submit" value="Create">
                </div>
                <?php
                echo "<label style='margin: 0 auto; color: red;'><b>" . $notice . "</b></label>";
                ?>
            </form>
        </div>
    </div>
    <script src="assets/javascript/create_account.js"></script>
</body>

</html>