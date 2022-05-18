<?php
$index = json_decode(file_get_contents("index.json"), true);
if (!isset($_COOKIE['user_id']) or !isset($_COOKIE['token'])){
    echo ('<button onclick="location=\'/Users/login.php\'">Login</button><button onclick="location=\'/Users/sign-up.php\'">Sign up</button>');
    exit();
}
if(!isset($index['users'][$_COOKIE['user_id']]) or $index['users'][$_COOKIE['user_id']]['token'] != $_COOKIE['token']){
    echo ('<button onclick="location=\'/Users/login.php\'">Login</button><button onclick="location=\'/Users/sign-up.php\'">Sign up</button>');
    exit();
}
echo "<link href='/style.css' rel='stylesheet' type='text/css'/> <img src='" . $index['users'][$_COOKIE['user_id']]['pfp'] . "' width='50' class='profile' height=auto\><br>Welcome, " . $index['users'][$_COOKIE['user_id']]['user-name'] . "<br><img src='https://cdn.onlinewebfonts.com/svg/img_28497.png' width='50'  height=auto onclick='location=\"/Posts/add.php\"'/><br>";
foreach ($index['posts'] as $post_array){
    if(file_exists("./" . $post_array['img'])){
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
