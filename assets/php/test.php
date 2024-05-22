<?php
use classes\database;

include("database.php");
database::query("INSERT INTO config (uuid, email) VALUES ('1', 'kenhorizon7@gmail.com')");
database::query("INSERT INTO config (uuid, email) VALUES ('2', 'vincentruales845@gmail.com')");
?>