<?php
if (isset($_POST['context'])){
    $index = json_decode(file_get_contents("../index.json"), true);
    $post_id = uniqid();
    $index['posts'][$post_id] = array(
        "post-id"=>$post_id,
        "img"=>"/Posts/" . $post_id . ".png",
        "context"=>$_POST['context'],
        "write"=>$_COOKIE['user_id'],
        "comments"=>array(),
        "likes"=>array()
    );
    array_push($index['users'][$_COOKIE['user_id']]['posts'], $post_id);
    file_put_contents("../index.json", json_encode($index));
    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "./" . $post_id . ".png");
    header("Location: /");
    exit();
}

?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
<tr>
    <form method="post" name="form" enctype="multipart/form-data" action="/Posts/add.php">
        <td>
            <table width="100%" border="0" cellpadding="3" cellspacing="1">
                <tr>
                    <td colspan="3"><strong>Make a post
                            <hr />
                        </strong></td>
                </tr>
                <tr>
                    <td class="text" width="78">Context
                        <td width="6">:</td>
                        <td width="294"><input class="box" name="context" type="text" id="context" autocomplete="off" required></td>
                    </td>
                </tr>
                <tr>
                    <td><input type="file" name="fileToUpload" id="fileToUpload">Upload a image</td>
                </tr>
</tr>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input class="reg" type="submit" name="Submit" value="Submit"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>