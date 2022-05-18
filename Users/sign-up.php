<?php
if (isset($_POST['uname']) and isset($_POST['passwd'])){    
    $index = json_decode(file_get_contents("../index.json"), true);
    $uid = uniqid();
    $file = $_FILES["fileToUpload"]["tmp_name"];
    move_uploaded_file($file, "./" . $uid . ".png");
    $token = uniqid() . uniqid() . uniqid();
    $index['users'][$uid] = array(
        "user-name"=>$_POST['uname'],
        "user-id"=>$uid,
        "posts"=>array(),
        "pfp"=>"/User/" . $uid . ".png",
        "following"=>array(),
        "followers"=>array(),
        "token"=>$token,
        "passwd"=>$_POST['passwd']
    );
    file_put_contents("../index.json", json_encode($index));
    setcookie("token", $token, time() + (86400 * 360), "/");
    setcookie("user_id", $uid, time() + (86400 * 360), "/");
    header("Location: /index.php");
    exit();
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
<tr>
    <form method="post" name="form" enctype="multipart/form-data" action="/Users/sign-up.php">
        <td>
            <table width="100%" border="0" cellpadding="3" cellspacing="1">
                <tr>
                    <td colspan="3"><strong>Login
                            <hr />
                        </strong></td>
                </tr>
                <tr>
                    <td class="text" width="78">User name
                        <td width="6">:</td>
                        <td width="294"><input class="box" name="uname" type="text" id="uname" autocomplete="off" required></td>
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td><input class="box" name="passwd" type="password" id="passwd" autocomplete="off" required></td>
                </tr>
                <tr>
                    <td><input type="file" name="fileToUpload" id="fileToUpload">Upload a profile picture</td>
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