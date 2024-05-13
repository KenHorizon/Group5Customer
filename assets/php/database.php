<?php

namespace classes;

use mysqli;
use mysqli_sql_exception;

class database
{
    public static function get()
    {
        $database_server = "localhost";
        $database_user = "root";
        $database_password = "reiyuu123";
        $database_name = "beyondhorizon_membership";
        $database_name_debug = "beyondhorizon_membership_test";
        try {
            return mysqli_connect($database_server, $database_user, $database_password, $database_name_debug);
        } catch (mysqli_sql_exception) {
            function_alert("Error during connecting database!");
        }
    }
    public static function query($databaseData)
    {
        try {
            return mysqli_query(database::get(), $databaseData);
        } catch (mysqli_sql_exception) {
        }
    }
}

?>
<?php
include("assets/php/main.php");
?>