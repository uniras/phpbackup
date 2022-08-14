<?php
function kuku()
{
    $str = '<table>'."\n";
    for ($i = 1; $i <= 9; $i++) {
        $str .= '<tr>'."\n";
        for ($j = 1; $j <= 9; $j++) {
            $str .= '<td>'.($i*$j).'</td>'."\n";
        }
        $str .= '</tr>'."\n";
    }
    $str .= '</table>'."\n";
    return $str;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
        }

        td {
            border: 2px #808080 solid;
            width: 20px;
            height: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<!-- 関数を出力 -->
<?php echo kuku(); ?>
</body>
</html>
