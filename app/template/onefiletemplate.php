<?php
$result = ['test' => 'テスト'];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    function phpfilter($source)
    {
        return preg_replace('/\<\?(.*?)[?]>/s', '', $source);
    }
    define('SMARTY_DIR', '/var/www/html/php/Smarty/libs/');
    require_once(SMARTY_DIR . 'Smarty.class.php');
    $smarty = new Smarty();
    $smarty->template_dir = './';
    $smarty->compile_dir = './output';
    $smarty->registerFilter('pre', 'phpfilter');
    $smarty->assign('result', $result);
    $smarty->display(__FILE__);
} else {
    echo json_encode($result);
}
exit;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>{$result.test}</title>
</head>

<body>
    {$result.test}
</body>

</html>