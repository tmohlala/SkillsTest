<?php
require_once 'init.php';

$user = DB::getInstance();
echo $user->get('tumelotest',['id', '=', '1'] );

