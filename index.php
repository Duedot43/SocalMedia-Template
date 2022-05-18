<?php
$index = json_decode(file_get_contents("index.json"), true);
if (!isset($_COOKIE['user_id']) or !isset($_COOKIE['token'])){
    echo ('11<button onclick="location=\'/Users/login.php\'">Login</button><button onclick="location=\'/Users/sign-up.php\'">Sign up</button>');
    exit();
}
if(!isset($index['users'][$_COOKIE['user_id']]) or $index['users'][$_COOKIE['user_id']]['token'] != $_COOKIE['token']){
    echo ('22<button onclick="location=\'/Users/login.php\'">Login</button><button onclick="location=\'/Users/sign-up.php\'">Sign up</button>');
    exit();
}
echo "<link href='/style.css' rel='stylesheet' type='text/css'/> <img src='" . $index['users'][$_COOKIE['user_id']]['pfp'] . "' width='50' class='profile' height=auto\><br>Welcome, " . $index['users'][$_COOKIE['user_id']]['user-name'];

?>