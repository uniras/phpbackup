<?
    if (isset($_POST['selectval'])) {
        $result = '変数有り';
        if ($_POST['selectval'] == 'val1') {
            //val1の処理
        } elseif ($_POST['selectval'] == 'val2') {
            //val2の処理
        } elseif ($_POST['selectval'] == 'val3') {
            //val3の処理
        }
        echo $_POST['selectval'];
        exit();
    } else {
        $result = '変数無し';
    }
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>PHPテスト</title>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js"></script>
    <script>
        $('document').ready(function () {
            $('input[type="checkbox"]').on('click', function () {
                if ($(this).prop('checked')) {
                    $('input[type="checkbox"]').prop('checked', false);
                    $(this).prop('checked', true);
                    var getval = $(this).val();
                    $.ajax({
                        type: 'POST',
                        url: 'checked.php',
                        dataType: 'text',
                        data: {
                            'selectval': getval,
                        }
                    }).done(function (data) {
                        console.log(getval);
                        $('#result').html(data);
                    }).fail(function (XMLHttpRequest, status, e) {
                        console.log(e);
                    });
                }
            });
        });
    </script>
</head>

<body>
    <input type="checkbox" name="val[]" value="val1" id="ckpoint1"><label for="ckpoint1">選択肢1</label>
    <input type="checkbox" name="val[]" value="val2" id="ckpoint2"><label for="ckpoint2">選択肢2</label>
    <input type="checkbox" name="val[]" value="val3" id="ckpoint3"><label for="ckpoint3">選択肢3</label>
    <div id="result">
        <?= $result ?>
    </div>
</body>

</html>