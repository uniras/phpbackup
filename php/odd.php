<?php
$navlist = [
    'hoge' => [
      '<a href="hoge.html">hoge</a>',
      '<a href="hoge.html">hoge2</a>',
    ],
    'hoge2' => [
     '<a href="hoge.html">hoge</a>',
      '<a href="hoge.html">hoge2</a>',
    ],
];

$count = 1;

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
            <h3>hoge</h3>
            <ul>
              <?php foreach ($navlist['hoge'] as $key=>$vals):
                  $odd = $count % 2 == 1 ? ' odd' : '';
                  $count++;
              ?>
              <li class="lh1 own<?=$odd?>"><?php echo $vals ?></li>
              <?php endforeach; ?>
            </ul>
</body>
</html>