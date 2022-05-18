<?php
$post = $_GET['post'];
$index = json_decode(file_get_contents("../index.json"), true);
$like_id = uniqid();
foreach ($index['posts'][$post]['likes'] as $likes_array){
    if(in_array($_COOKIE['user-id'], $likes_array)){
        header("Location: /");
        exit();
    }
}
$index['posts'][$post]['likes'][$like_id] = array(
    $_COOKIE['user_id']
);
file_put_contents("../index.json", json_encode($index));
header("Location: /");
exit();
?>