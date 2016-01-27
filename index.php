<?php



require_once __DIR__.'/autoload.php';

//$users = \App\Models\User::findAll();
$user = \App\Models\User::findById(1);

var_dump($user);

