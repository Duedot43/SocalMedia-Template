<?php
$user = $_GET['user'];
$index = json_decode(file_get_contents("index.json"), true);
echo "<img src='" . $index['users'][$user]['pfp'] . "'/>" . $index['users'][$user]['user-name'] . "<br><button onclick='location=\"/Users/follow.php?user=" . $index['users'][$user]['user-id'] . "\"'>Follow</button><br>";
foreach ($index['posts'] as $post_array){
    if ($post_array['write'] == $user){
        echo "
        <img onclick='location=\"/Users/posts.php?user=" . $index['users'][$post_array['write']]['user-id'] . "\"' src='" . $index['users'][$post_array['write']]['pfp'] . "' width='50' class='profile' height=auto/>" . $index['users'][$post_array['write']]['user-name'] . "<br>
        " .$post_array['context'] . "<br>
        <img src='" . $post_array['img'] . "' class='big_post' /><br>
        ";
    }
}
?>