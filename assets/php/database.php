<?php

namespace classes;

use mysqli_sql_exception;

class database
{
    protected static $server = "localhost";
    protected static $user = "root";
    protected static $password = "reiyuu123";
    protected static $server_name = "beyondhorizon_membership";
    protected static function server_name($debug = null)
    {
        if ($debug === true) {
            return database::$server_name = "beyondhorizon_membership_test";
        } else {
            return database::$server_name = "beyondhorizon_membership";
        }
    }
    public static function get()
    {
        try {
            return mysqli_connect(database::$server, database::$user, database::$password, database::server_name(true));
        } catch (mysqli_sql_exception) {
            function_alert("Error during connecting database!");
        }
    }
    public static function query($databaseData)
    {
        try {
            return mysqli_query(database::get(), $databaseData);
        } catch (mysqli_sql_exception) {
            function_alert("Error during connecting database query!");
        }
    }
}
