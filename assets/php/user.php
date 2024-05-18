<?php

namespace classes;

include("database.php");

database::get();

spl_autoload_register(function ($class) {
    require str_replace('\\', '/', $class) . '.php';
});

class user
{
    public $register = '';
    public $account = 'account';
    public $user = 'user';
    public $membership = 'membership';
    public function account()
    {
        $email = $this->register;
        return mysqli_fetch_assoc(database::query("SELECT * FROM account WHERE email = '$email'"));
    }
    public function user()
    {
        $email = $this->register;
        return mysqli_fetch_assoc(database::query("SELECT * FROM user WHERE email = '$email'"));
    }
    public function membership()
    {
        $email = $this->register;
        return mysqli_fetch_assoc(database::query("SELECT * FROM membership WHERE email = '$email'"));
    }
    public function update($index, $target, $value)
    {
        $email = $this->register;
        return database::query("UPDATE $index SET $target = $value WHERE email = '$email'");
    }
    
    public function isEmpty()
    {
        $email = $this->register;
        return mysqli_num_rows(database::query("SELECT * FROM account WHERE email = '$email'")) > 0;
    }
}
$user = new user();
?>