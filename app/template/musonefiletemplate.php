<?php

$data = ['test' => 'テスト'];

//Mustacheエンジンのロード
require_once('/var/www/html/php/Mustache/Autoloader.php');
Mustache_Autoloader::register();
$engine = new Mustache_Engine(array(
    'loader' => new Mustache_Loader_StringLoader(),
    'partials_loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__)),
), array('entity_flags' => ENT_QUOTES));

$source = file_get_contents(__FILE__);    //自分自身のファイルを取得
$source = preg_replace('/\<\?(.*?)[?]>/s', '', $source); //PHPコード部分を削除
$contents = $engine->render($source, $data); //PHPコードを削除した文字列をテンプレートにレンダリング
echo $contents;
exit();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>{{test}}</title>
</head>

<body>
    {{test}}
</body>

</html>