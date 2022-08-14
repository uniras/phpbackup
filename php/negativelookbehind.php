<?php

//mbでmatch_allやりたいなら
function mb_ereg_match_all($pattern, $subject, array &$subpatterns)
{
    if(!mb_ereg_search_init($subject, $pattern))    // 初期化処理
        return false;
    $subpatterns = array();
    while($r = mb_ereg_search_regs()) {    // 初期化処理で設定したパターンと文字列から検索
        $subpatterns[] = $r;
    }
    return true;
}


$text = <<<EOT
https://github.com
[teratail](https://teratail.com)
なんだかなぁhttps://github2.com
erghttps://github3.com
[teratail](https://teratail.com)
EOT;

//(?<!]\()部分は否定後読みというらしい(negative lookbehind)
$pattern = '(?<!]\()https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+';

$hits = [];


$result = preg_match_all('/'.$pattern.'/', $text, $hits);
//$result = mb_ereg_match_all($pattern, $text, $hits);

var_dump($result);
echo "<br>\n";
var_dump($hits);
echo "<br>\n";

?>