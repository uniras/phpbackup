<?
//test.php
$cmd = "c:/windows/system32/notepad.exe";
echo "<pre>";
echo $cmd;
echo "\n";
echo exec($cmd, $opt, $return_ver);
echo "\n";
print_r ($opt);
echo "\n";
echo $return_ver; //execステータスは0を出力
echo "</pre>";
