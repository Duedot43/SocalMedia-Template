<?php
header('Content-Type: application/json');
function err(){
    header('HTTP/1.0 406 Not Acceptable');
}
if (!isset(json_decode(file_get_contents('php://input'), true)['user'])){
    echo json_encode(array(
        "success"=>0,
        "reason"=>"no_user_var",
        "human_reason"=>"The user POST variable is not set"
    ));
    err();
    exit();
}
$user = json_decode(file_get_contents('php://input'), true)['user'];
$index = json_decode(file_get_contents("../index.json"), true);
if (!isset($index['users'][$user])){
    echo json_encode(array(
        "success"=>0,
        "reason"=>"no_user",
        "human_reason"=>"The user accosiated with this ID does not exiest"
    ));
    err();
    exit();
}
$followers = $index['users'][$user]['followers'];
if (empty($followers)){
    echo json_encode(array(
        "success"=>0,
        "reason"=>"no_followers",
        "human_reason"=>"The user accosiated with this id has no followers"
    ));
    err();
    exit();
}
$output = array();
foreach ($followers as $follow_id){
    foreach ($index['users'][$follow_id]['posts'] as $post_id){
        if ($index['posts'][$post_id]['write'] == $follow_id){
            $output[$post_id] = $index['posts'][$post_id];
        }
    }
}
if (empty($output)){
    echo json_encode(array(
        "success"=>0,
        "reason"=>"no_posts",
        "human_reason"=>"The followers accosiated with this id have no posts!"
    ));
    err();
    exit();
}
echo json_encode($output);
?>