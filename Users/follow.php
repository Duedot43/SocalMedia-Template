<?php
$user = $_GET['user'];
$index = json_decode(file_get_contents("../index.json"), true);
if(!in_array($user, $index['user'][$_COOKIE['user_id']]['following'])){
    $foll = "Follow";
} else{
    $foll = "Unfollow";
}
if($foll == "Follow"){
    array_push($index['users'][$user]['followers'], $_COOKIE['user_id']);
    array_push($index['users'][$_COOKIE['user_id']]['following'], $user);
    file_put_contents("../index.json", json_encode($index));
    header("Location: /Users/posts.php?user=" . $user);
    exit();
} else{
    unset($index['users'][$user]['followers'][$_COOKIE['user_id']]);
    unset($index['users'][$_COOKIE['user_id']]['following'][$user]);
    file_put_contents("../index.json", json_encode($index));
    header("Location: /Users/posts.php?user=" . $user);
    exit();
}
?>