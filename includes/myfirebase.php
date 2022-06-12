<?php
// include 'includes/user_token.php';
date_default_timezone_set('Asia/Jakarta');
require __DIR__.'/../vendor/autoload.php';


use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// This assumes that you have placed the Firebase credentials in the same directory
// as this PHP file.

$factory = (new Factory)
->withServiceAccount(__DIR__.'/zenbodygym-15495-firebase-adminsdk-pjvaa-6925db4369.json')
->withDatabaseUri('https://zenbodygym-15495-default-rtdb.firebaseio.com/');

$database = $factory->createDatabase();
