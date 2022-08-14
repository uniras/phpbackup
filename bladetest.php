<?php

$data = ['name' => 'World'];

include __DIR__.'/lib/BladeOne.php';
use eftec\bladeone\BladeOne;
class CustomBladeOne extends BladeOne
{
    //getFileを継承してテンプレートファイルを加工する
    public function getFile($fullFileName): string
    {
        $source = parent::getFile($fullFileName);
        $source = preg_replace('/\<\?(.*?)[?]>/s', '', $source); //PHPコード部分を削除
        return $source;
    }
}
$blade = new CustomBladeOne(__DIR__, __DIR__.'/compiles');
$blade->setFileExtension('.php');
$contents = $blade->run(basename(__FILE__, '.php'), $data);
echo $contents;
exit;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bladeテンプレートのテスト</title>
</head>
<body>
<h1>Bladeテンプレートのテスト。</h1>
<p>Hello, {{$name}}.</p>
</body>
</html>
