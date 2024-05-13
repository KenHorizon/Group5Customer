<?php

namespace classes;

spl_autoload_register(function ($class) {
    require str_replace('\\', '/', $class) . '.php';
});

use mysqli;
use mysqli_sql_exception;

class subscription
{
    public static function main($email)
    {
        $membership = $email;
        $result = database::query("SELECT * FROM membership WHERE email = '$membership'");
        if (mysqli_num_rows($result) > 0) {
            $validate_account = mysqli_fetch_assoc($result);
            $currentTime = time();
            $subscription_date = $validate_account['subscription_date'];
            $expiration_date = $validate_account['expiration'];
            // echo $currentTime . "<br>";
            // echo $expiration_date;
            if ($currentTime > $expiration_date && $validate_account['status'] == 1) {
                database::query("UPDATE membership SET status = 0 WHERE email = '$membership'");
                database::query("UPDATE membership SET subscription_date = 0 WHERE email = '$membership'");
                database::query("UPDATE membership SET expiration = 0 WHERE email = '$membership'");
                header("Refresh: 0");
            }
        }
    }
}


?>