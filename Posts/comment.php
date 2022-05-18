<?php
$post = $_GET['post'];
$index = json_decode(file_get_contents("../index.json"), true);
if (isset($_POST['comment_cont'])){
    $comment_id = uniqid();
    $index['posts'][$post]['comments'] = array(
        $comment_id=>array(
            "comment-id"=>$comment_id,
            "writer"=>$_COOKIE['user_id'],
            "content"=>$_POST['comment_cont']
        )
    );
    file_put_contents("../index.json", json_encode($index));
}
$index = json_decode(file_get_contents("../index.json"), true);
echo "
<link href='/style.css' rel='stylesheet' type='text/css'/>
<img onclick='location=\"/Users/posts.php?user=" . $index['users'][$index['posts'][$post]['write']]['user-id'] . "\"' src='" . $index['users'][$index['posts'][$post]['write']]['pfp'] . "' width='50' class='profile' height=auto/>" . $index['users'][$index['posts'][$post]['write']]['user-name'] . "<br>
" . $index['posts'][$post]['context'] . "<br>
<img src='" . $index['posts'][$post]['img'] . "' class='big_post' width='800' height=auto/><br>
";
foreach ($post['posts'][$post]['comments'] as $comment_array){
    echo "
    <img onclick='location=\"/Users/posts.php?user=" . $index['users'][$comment_array['writer']]['user-id'] . "\"' src='" . $index['users'][$comment_array['writer']]['pfp'] . "' width='50' class='profile' height=auto/>" . $index['users'][$comment_array['writer']]['user-name'] . "<br>
    " . $comment_array['content'] . "<br>";
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
<tr>
    <form method="post" name="form" enctype="multipart/form-data" action="/Posts/add.php">
        <td>
            <table width="100%" border="0" cellpadding="3" cellspacing="1">
                <tr>
                    <td colspan="3"><strong>Make a comment
                            <hr />
                        </strong></td>
                </tr>
                <tr>
                    <td class="text" width="78">Context
                        <td width="6">:</td>
                        <td width="294"><input class="box" name="comment_cont" type="text" id="comment_cont" autocomplete="off" required></td>
                    </td>
                </tr>
</tr>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input class="reg" type="submit" name="Submit" value="Login"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>