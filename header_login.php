<?php
$account_name = $user->account() == null ? "Login" : $user->account()['name'];
$redirect = $user->account() == null ? "index.php" : "";
$account_profile = $user->user() == null ? "assets/img/default_pfp.jpeg" : $user->user()['profile'];
?>
<header>
    <div class="navigation">
        <ul>
            <li>
                <a class="icon-navigation-logo-button" href="account.php">
                    <div>
                        <img class="icon-navigation-logo" src="/assets/img/icon.ico">
                    </div>
                </a>
            </li>
            <li><a class="button" href="about.php"><span class="material-icons">help</span>About</a></li>
            <li class="icon-texts"><a class="button" href="member_list.php"><span class="material-icons">list</span>Member List</a></li>
            <li><a class="button" href="membership.php"><span class="material-icons">rocket</span>Subscription</a></li>
            <li class="dropdown" style="float: right;">
                <a class="account-header" href=<?php echo $redirect ?>>
                    <div class='group-box-rows'>
                        <img class='avatar' src=<?php echo $account_profile ?>>
                        <span class='account-header-text'>
                            <?php echo $account_name ?>
                        </span>
                    </div>
                </a>
                <?php
                if ($user->account() != null) {
                    echo "
                <div class='dropdown-content'>
                    <a class='account-header-button' href='account.php'>
                        <div class='group-box-rows'>
                            <img class='avatar' src='$account_profile'>
                            <span class='account-header-text'>
                                $account_name
                            </span>
                        </div>
                    </a>
                    <a class='button' href='logout.php'>
                        <div class='icon-navigation-pos icon-navigation'>
                            <span class='material-icons'>logout</span>
                        </div>
                        <span class='account-header-text'>
                            Log Out
                        </span>
                    </a>
                </div>";
                }
                ?>

            </li>
        </ul>
    </div>
</header>