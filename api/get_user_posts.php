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
$user = json_decode(file_get_contents('php://input'), true)['user'];$index = json_decode(file_get_contents("../index.json"), true);
if (!isset($index['users'][$user])){
    echo json_encode(array(
        "success"=>0,
        "reason"=>"no_user",
        "human_reason"=>"The user accosiated with this ID does not exiest"
    ));
    err();
    exit();
}
$output = array();
foreach ($index['users'][$user]['posts'] as $post_id){
    if ($index['posts'][$post_id]['write'] == $user){
        $output[$post_id] = $index['posts'][$post_id];
    }
}
echo json_encode($output);

?>