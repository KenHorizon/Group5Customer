<?php

require url('user');
require url('subscription');
require url('main');
require url('mail');

function url($class) {
    return str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
}

?>