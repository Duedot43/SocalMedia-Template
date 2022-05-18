<?php
echo "<link href='/style.css' rel='stylesheet' type='text/css'/><img src='https://static.vecteezy.com/system/resources/previews/000/421/945/original/house-icon-vector-illustration.jpg' onclick='location=\"/\"' class='profile' width='50' height=auto/><br>";
$user = $_GET['user'];
$index = json_decode(file_get_contents("../index.json"), true);
if(!in_array($user, $index['users'][$_COOKIE['user_id']]['following'])){
    $foll = "Follow";
} else{
    $foll = "Unfollow";
}
echo "<link href='/style.css' rel='stylesheet' type='text/css'/><img src='" . $index['users'][$user]['pfp'] . "' width='100' class='profile' height=auto/>" . $index['users'][$user]['user-name'] . "<br><button onclick='location=\"/Users/follow.php?user=" . $index['users'][$user]['user-id'] . "\"'>" . $foll . "</button><br>";
foreach ($index['posts'] as $post_array){
    if(file_exists("../" . $post_array['img'])){
        $img = "<img src='" . $post_array['img'] . "' class='big_post' width='800' height=auto/>";
    } else{
        $img = "";
    }
    echo "
    <img onclick='location=\"/Users/posts.php?user=" . $index['users'][$post_array['write']]['user-id'] . "\"' src='" . $index['users'][$post_array['write']]['pfp'] . "' width='50' class='profile' height=auto/>" . $index['users'][$post_array['write']]['user-name'] . "<br>
    " .$post_array['context'] . "<br>
    " . $img . "<br>
    <img src='https://www.freeiconspng.com/uploads/comment-png-3.png' width='30' height='auto' onclick='location=\"/Posts/comment.php?post=" . $post_array['post-id'] . "\"'/>" . count($post_array['comments']) . "
    <img src='https://image.similarpng.com/very-thumbnail/2020/06/Icon-like-button-transparent-PNG.png' width='30' height='auto' onclick='location=\"/Posts/like.php?post=" . $post_array['post-id'] . "\"'/>" . count($post_array['likes']) . "<br><br>
    ";
}
?>