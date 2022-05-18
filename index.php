<?php
$index = json_decode(file_get_contents("index.php"), true);
if (!isset($_COOKIE['user_id']) or !isset($_COOKIE['token'])){
    echo ('<button onclick="location=\'/Users/login.php\'">Login</button><button onclick="location=\'/Users/sign-up.php\'">Sign up</button>');
    exit();
}
if(!isset($index['users'][$_COOKIE['user_id']]) or $index['users'][$_COOKIE['user_id']]['token'] != $_COOKIE['token']){
    echo ('<button onclick="location=\'/Users/login.php\'">Login</button><button onclick="location=\'/Users/sign-up.php\'">Sign up</button>');
    exit();
}
?>