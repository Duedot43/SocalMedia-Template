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
echo "<link href='/style.css' rel='stylesheet' type='text/css'/> <img src='" . $index['users'][$_COOKIE['user_id']]['pfp'] . "' width='50' class='profile' height=auto\><br>Welcome, " . $index['users'][$_COOKIE['user_id']]['user-name'] . "<br>";
foreach ($index['posts'] as $post_array){
    echo "
    <link href='/style.css' rel='stylesheet' type='text/css'/>
    " . $index['users'][$post_array['write']]['user-name'] . "<br>
    <img src='" . $index['users'][$post_array['write']]['pfp'] . "' width='50' class='profile' height=auto/>
    " .$post_array['context'] . "<br>
    <img src='" . $post_array['img'] . "' class='big_post' />
    ";
}
?>