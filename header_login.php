<header>
    <div class="navigation">
        <ul>
            <li class="icon-texts"><a class="button" href="member_list.php" id="memberList"><span class="material-icons">list</span>Member List</a></li>
            <li><a class="button" href="membership.php" id="subscription"><span class="material-icons">rocket</span>Subscription</a></li>
            <li class="dropdown" style="float: right;">
                <a class="account-header" id="account"><img class="avatar" src=<?php echo $user->user()['profile']; ?>><?php echo $user->account()['username']; ?></a>
                <div class="dropdown-content">
                    <a class="account-header-button" href="account.php" id="account">
                        <div class="group-box-rows">
                            <img class="avatar" src=<?php echo $user->user()['profile']; ?>>
                            <span class="account-header-text">
                                <?php echo $user->account()['username']; ?>
                            </span>
                        </div>
                    </a>
                    <a class="button" href="logout.php">
                        <div class="icon-navigation-pos icon-navigation">
                            <span class="material-icons">logout</span>
                        </div>
                        <span class="account-header-text">
                            Log Out
                        </span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</header>