<?php
$user = $_GET['user'];
$index = json_decode(file_get_contents("../index.json"), true);
if(!in_array($user, $index['users'][$_COOKIE['user_id']]['following'])){
    $foll = "Follow";
} else{
    $foll = "Unfollow";
}
if($foll == "Follow"){
    $index['users'][$user]['followers'][$_COOKIE['user_id']] = $_COOKIE['user_id'];
    $index['users'][$_COOKIE['user_id']]['following'][$user] = $user;
    file_put_contents("../index.json", json_encode($index));
    header("Location: /Users/posts.php?user=" . $user);
    exit();
} 
if($foll == "Unfollow"){
    unset($index['users'][$user]['followers'][$_COOKIE['user_id']]);
    unset($index['users'][$_COOKIE['user_id']]['following'][$user]);
    file_put_contents("../index.json", json_encode($index));
    print_r($index);
    header("Location: /Users/posts.php?user=" . $user);
    exit();
}
?>