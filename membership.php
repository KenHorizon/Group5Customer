<?php
// session_start();
include("assets/php/data.php");
include("assets/php/membership_category.php");
?>
<?php
// Membership: Joining VIP

// $membership_register = filter_input(INPUT_POST, "get_vip_membership", FILTER_SANITIZE_SPECIAL_CHARS);

// $session_account = $_SESSION["uuid"];
// $account_uuid = "SELECT * FROM account WHERE uuid = $session_account";
// $user_uuid = "SELECT * FROM user WHERE uuid = $session_account";
// $membership_uuid = "SELECT * FROM membership WHERE uuid = $session_account";

// $account = mysqli_query($database, $account_uuid);
// $user = mysqli_query($database, $user_uuid);
// $membership = mysqli_query($database, $membership_uuid);

// $payment = 0;

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if (mysqli_num_rows($account) > 0) {
//         $validated_account = mysqli_fetch_assoc($account);
//         $validated_account_email = $validated_account['email'];
//         $validated_account_user = mysqli_fetch_assoc($user);
//         $validated_membership_user = mysqli_fetch_assoc($membership);

//         if ($membership_register == 'advanceSubscription') {
//             $value_money = $_POST['advanceVip'];
//             if ($value_money = 'yearly') {
//                 $payment = 2509.9;
//             } else {
//                 $payment = 250.99;
//             }

//             $body =
//                 "
//                 <h1> Thanks for your payment </h1> <br>
//                 If you have any question, contact us anytime <br>
//                 <b>beyondhorizon.noreply@gmail.com</b> or simply <br>
//                 reply to this email.
//                 <br>
//                 Type of Payment: " . $_POST['payment'] . " <br>
//                 Total : " . $payment . "
//                 ";
//             $update_membership = "UPDATE membership (level, category) SET = (1, $membership_default) WHERE email = $validated_account_email";
//             $update_membership_database = mysqli_query($database, $update_membership);
//             sendEmail("Beyond Horizon | Membership", $body, $_SESSION['email']);
//             function_alert("You joined successfully on VIP, Have Fun!");
//             header("Location: account.php");
//         } else {
//             $value_money = $_POST['basicVip'];
//             if ($value_money = 'yearly') {
//                 $payment = 999.99;
//             } else {
//                 $payment = 99.99;
//             }

//             $body =
//                 "
//                 <h1> Thanks for your payment </h1> <br>
//                 If you have any question, contact us anytime <br>
//                 <b>beyondhorizon.noreply@gmail.com</b> or simply <br>
//                 reply to this email.
//                 <br>
//                 Type of Payment: " . $_POST['payment'] . " <br>
//                 Total : " . $payment . "
//                 ";
//             $update_membership = "UPDATE membership (level, category) SET = (1, $membership_default) WHERE email = $validated_account_email";
//             $update_membership_database = mysqli_query($database, $update_membership);
//             sendEmail("Beyond Horizon | Membership", $body, $_SESSION['email']);
//             function_alert("You joined successfully on VIP, Have Fun!");
//             header("Location: account.php");
//         }
//     }
// }
// $database->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/assets/img/icon.png">
    <title>Beyond Horizon: Stars | Membership</title>
    <link rel="stylesheet" href="assets/css/input_box.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/style.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/icons_addon.css"> <!-- ICONS API -->

</head>
<header>
    <div class="navigation" id="navigationMenu">
        <a class="button" href="account.php"><i class="material-icons">home</i>Home</a>
        <a class="button" href="index.php"><i class="material-icons">logout</i>Logout</a>
    </div>
</header>

<body>
    <div class="main" style="margin: 20px;">
        <div class="membership-background membership-font">
            <span>
                <div class="group">
                    <img class="centered-text" src="assets/img/membership.png">
                    <div class="font-0" style="font-weight: bold;">
                        <h2>Membership</h2>
                    </div>
                </div>
            </span>
            <div style="text-align: center;">
                <div class="text-with-shadow term-condition-box" style="font-size: 20px; margin: 0 auto;">
                    <input type="checkbox" id="checkbox">
                    <label for="checkbox">I agree to these <button class="button-term-conditions membership-font" id="termConditions" style="font-size: 20px;">Term and Conditions</button></label>
                </div>
                <div class="text-with-shadow term-condition-box hide" style="font-size: 20px; margin: 0 auto;">
                    <button id="requireTermAndConditions">I agree to these Require Read Term And Conditions</button>
                </div>
                <h3 class="membership-headers">Unleash more fun with <b>VIP Membership</b></h3>
                <h3>Plans start at only &#8369;99.99/month. Cancel anytime</h3>
            </div>
            <div class="membership-group">
                <div class="membership-offer">
                    <h3>VIP Membership Basic</h3>
                    <p style="font-size: 14px;">&#8369;99.99/month</p>
                    <p>- Remove Ads</p>
                    <p>- Special badge on your profile</p>
                    <p>- Disable waiting time</p>
                    <p>- Exclusive Items</p>
                    <br>
                    <div class="membership-btn">
                        <a class="button" id="basicSubscriptionButton">Subscribe</a>
                    </div>
                </div>
                <div class="membership-offer">
                    <h3>VIP Membership</h3>
                    <p style="font-size: 14px;">&#8369;250.99/month</p>
                    <p>- Remove Ads</p>
                    <p>- Special badge on your profile</p>
                    <p>- Custom emoji anywhere</p>
                    <p>- Custom video background</p>
                    <p>- Exclusive Items</p>
                    <p>- Custom profile and more!</p>
                    <p>- Customized profile background</p>
                    <p>- Magic: Wallet begone</p>
                    <br>
                    <div class="membership-btn">
                        <a class="button" id="advanceSubscriptionButton">Subscribe</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="membership-font">
        <div id="subscriptionBasic" class="popup">
            <div class="popup-content">
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                    <h1> VIP Membership Basic</h1>
                    <p>Plans & Payment</p>
                    <hr>
                    <div style="font-size: 20px;">
                        <div>
                            <input type="radio" name="basicVip" id="basicSubscriptionYearCheck" value="yearly" checked>
                            <label>Yearly</label>
                            <label>&#8369;999.99</label>
                        </div>
                        <div>
                            <input type="radio" name="basicVip" id="basicSubscriptionMonthCheck" value="monthly">
                            <label>Monthly</label>
                            <label>&#8369;99.99</label>
                        </div>
                    </div>
                    <hr>
                    <div class="custom-select" style="width:200px;">
                        <select name="payment" required>
                            <option value="null">Select Payment:</option>
                            <option value="gcash">G-Cash</option>
                            <option value="paypal">Paypal</option>
                            <option value="card">Card</option>
                        </select>
                    </div>
                    <hr>
                    <p id="basicSubscriptionYear" class="hide"><b>By clicking "Get VIP Membership Basic Yearly", you are purchasing a recurring subscription.</b>, You'll be charged &#8369;999.99 / Year plus applicable taxes starting today, less any applicable credits or discount, until you cancel. Cancel anytime from your Settings page.</p>
                    <p id="basicSubscriptionMonth" class="hide"><b>By clicking "Get VIP Membership Basic Monthly", you are purchasing a recurring subscription.</b>, You'll be charged &#8369;99.99 / Month plus applicable taxes starting today, less any applicable credits or discount, until you cancel. Cancel anytime from your Settings page.</p>
                    <div class="group-box-row">
                        <button class="button-borderless" style="width: 100%;" id="basicSubscriptionExitButton">Close</button>
                        <button class="button-borderless" style="width: 100%;" type="submit" name="get_vip_membership" value="basicSubscription">Get VIP Membership Basic</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="membership-font">
        <div id="subscriptionAdvance" class="popup">
            <div class="popup-content">
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                    <h1> VIP Membership</h1>
                    <p>Plans & Payment</p>
                    <hr>
                    <div style="font-size: 20px;">
                        <div>
                            <input type="radio" name="advanceVip" id="advanceSubscriptionYearCheck" value="yearly" checked>
                            <label>Yearly</label>
                            <label>&#8369;2509.9</label>
                        </div>
                        <div>
                            <input type="radio" name="advanceVip" id="advanceSubscriptionMonthCheck" value="monthly">
                            <label>Monthly</label>
                            <label>&#8369;250.99</label>
                        </div>
                    </div>
                    <hr>
                    <div class="custom-select" style="width:200px;">
                        <select name="payment" required>
                            <option value="null">Select Payment:</option>
                            <option value="gcash">G-Cash</option>
                            <option value="paypal">Paypal</option>
                            <option value="card">Card</option>
                        </select>
                    </div>
                    <hr>
                    <p id="advanceSubscriptionYear" class="hide"><b>By clicking "Get VIP Membership Yearly", you are purchasing a recurring subscription.</b>, You'll be charged &#8369;2509.9 / Year plus applicable taxes starting today, less any applicable credits or discount, until you cancel. Cancel anytime from your Settings page.</p>
                    <p id="advanceSubscriptionMonth" class="hide"><b>By clicking "Get VIP Membership Monthly", you are purchasing a recurring subscription.</b>, You'll be charged &#8369;250.99 / Month plus applicable taxes starting today, less any applicable credits or discount, until you cancel. Cancel anytime from your Settings page.</p>
                    <div class="group-box-row">
                        <button class="button-borderless" style="width: 100%;" id="advanceSubscriptionExitButton">Close</button>
                        <button class="button-borderless" style="width: 100%;" type="submit" name="get_vip_membership" value="advanceSubscription">Get VIP Membership</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="membership-font">
        <div id="termConditionsPopup" class="popup">
            <div class="popup-content">
                <h1 style="text-align: center;">Term And Conditions</h1>
                <p>Welcome to our Beyond Horizon | Stars, our online source code patreon, KenHorizon and it's associates provide their services to your subject to the following conditions, If you visit this patreon within this website, you accept these conditions, Please read them carefully</p>
                <hr>
                <h3>PRIVACY</h3>
                <p>Please review our Privacy Policy Note, which also governs your visit to our website, to understand our practices</p>
                <button class="button-borderless" id="termConditionsClose">Close</button>
            </div>
        </div>
    </div>
    <script type="module" defer src="assets/javascript/message_box.js"></script>
    <script src="assets/javascript/option_bar.js"></script>
</body>

</html>