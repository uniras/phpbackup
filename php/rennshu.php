<?php
//require('common/common.php');

//session_start();

if(!empty($_POST)) {
    //ログイン画面
    if($_POST['username'] != '' && $_POST['password'] != '') {
        $sql = sprintf('SELECT * FROM member WHERE name = "%s" AND pass_word = "%s"',
        $_POST['username'],//mysqli_real_escape_string($db,$_POST['username']),
        $_POST['password']    //mysqli_real_escape_string($db,$_POST['password'])
        );
        //$record = mysqli_query($db,$sql) or die(mysql_error($db));
        
        echo $sql;
        //$record = mysqli_query($db,$sql);
        //$record = 1;

        //if ($table = mysqli_fetch_assoc($record)) {
            // echo $table['id'];
            //ログイン成功
            //$_SESSION['id'] = $table['id'];
            //$_SESSION['time'] = time();
            //echo $_SESSION['id'];
            header('Location: top_page.php');
            exit();
        //} else {
        //    $error['login'] = 'failed';
        //}
    } else {
            $error['login'] = 'blank';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ログイン画面</title>
<head>
<body>
<h1>ログイン画面</h1>
<HR>
<form action="" method="post">
<label>ユーザーネーム<br />
<input type="text" name="username" size="30" maxlength="255" /></label><br>
<label>パスワード<br />
<input type="text" name="password" size="30" maxlength="255" /></label><br>
<input type="submit" value="ログイン"><input type="reset" value="リセット"><br>

</form>
<?php
if(!empty($error)){
echo "※入力が空・もしくは入力が間違っています";
}
?>
<p>登録されていない場合は<a href="entry.php">ここ</a>から登録できます</p>
</body>
</html>