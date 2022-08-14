<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $array = [
        ['number'=>'10', 'name'=> array('name-JP'=>'佐藤', 'name-EN'=>'Satou'), 'physical'=> array('height'=>'165.5','weight'=> '55.5')],
        ['number'=>'48', 'name'=> array('name-JP'=>'渡辺', 'name-EN'=>'Watanabe'), 'physical'=> array('height'=>'156.8','weight'=> '48.3')],
        ['number'=>'12', 'name'=> array('name-JP'=>'鈴木', 'name-EN'=>'Suzuki'), 'physical'=> array('height'=>'160.2','weight'=> '50.6')],
        ['number'=>'2', 'name'=> array('name-JP'=>'伊藤', 'name-EN'=>'Itou'), 'physical'=> array('height'=>'155.2','weight'=> '50.9')],
        ['number'=>'28', 'name'=> array('name-JP'=>'高橋', 'name-EN'=>'Takahashi'), 'physical'=> array('height'=>'165.5','weight'=> '55.5')]
    ];
    $value = $_POST['value'];
    $return = array("value" => $value);
    header("Content-type: application/json; charset=UTF-8");
    echo json_encode($return);

    if (strcmp($return, "sort1") == 0) {
        array_multisort(array_column($array, 'number'), SORT_ASC, SORT_NUMERIC, $array);
        foreach ($array as $key => $value) {
            echo $value['number'] . '番　' . $value['name']['name-JP'] . '：' . $value['physical']['height'] . 'cm　' . $value['physical']['weight'] . 'kg<br>';
        }
    } elseif (strcmp($return, "sort2") == 0) {
        array_multisort(array_column($array, 'name-EN'), SORT_ASC, SORT_NUMERIC, $array);
        foreach ($array as $key => $value) {
            echo $value['number'] . '番　' . $value['name']['name-JP'] . '：' . $value['physical']['height'] . 'cm　' . $value['physical']['weight'] . 'kg<br>';
        }
    } elseif (strcmp($return, "sort3") == 0) {
        array_multisort(array_column($array, 'height'), SORT_ASC, SORT_NUMERIC, $array);
        foreach ($array as $key => $value) {
            echo $value['number'] . '番　' . $value['name']['name-JP'] . '：' . $value['physical']['height'] . 'cm　' . $value['physical']['weight'] . 'kg<br>';
        }
    }

    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ソートのテスト</title>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $(function () {
                $("#example").change(function () {
                    const str1 = $("#example").val();
                    console.log(str1);
                    $.ajax({
                        type: "POST",
                        url: "ajax.php",
                        data: { "value": str1 },
                        dataType: "json"
                    }).done(function (data) {
                        $("#return").append('<p>' + data.value + '</p>');
                    }).fail(function (XMLHttpRequest, status, e) {
                        alert(e);
                    });
                });
            });
        });
    </script>
</head>

<body>
    <select name="example" id="example">
        <option value="sort1">出席番号</option>
        <option value="sort2">名前</option>
        <option value="sort3">身長</option>
    </select>
    <div id="return"></div>
</body>

</html>