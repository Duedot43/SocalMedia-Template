<?php
if (isset($_POST['uname']) and isset($_POST['passwd'])){
    $index = json_decode(file_get_contents("../index.json"), true);
    $token = uniqid() . uniqid() . uniqid();
    foreach ($index['users'] as $user_array){
        if(strtolower($user_array['user-name']) == strtolower($_POST['uname']) and strtolower($user_array['passwd']) == strtolower($_POST['passwd'])){
            $index[$user_array['user-id']]['token'] = $token;
            setcookie("token", $token, time() + (86400 * 360), "/");
            setcookie("user_id", $user_array['user-id'], time() + (86400 * 360), "/");
            file_put_contents("../index.json", json_encode($index));
            header("Location: /index.php");
            exit();
        }
    }
    echo"Your username or password is incorrect!";
}

?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
<tr>
    <form method="post" name="form" enctype="multipart/form-data" action="/Users/login.php">
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