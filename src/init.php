<?php
session_start();

$GLOBALS['config'] = [
    'mysql' => [
        'host' => 'test-db:3306',
        'username' => 'root',
        'password' => 'hilariouslyinsecure',
        'db' => 'tumelotest'
    ]];

spl_autoload_register(function($class) {
    require_once $class . '.php';
});
//require_once 'functions/sanitize.php';