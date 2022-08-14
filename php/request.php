<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $list = array("id" => $id, "hoge" => "hogehoge");
    header("Content-type: application/json; charset=UTF-8");
    echo json_encode($list);
    exit;
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>入力フォーム</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script>
        $(document).ready(function () {
            $(function () {
                $('#sendBtn').on('click', function (event) {
                    let id = $('#twid').val();
                    $.ajax({
                        type: "POST",
                        url: "./request.php",
                        data: { "id": id },
                        dataType: "json"
                    }).done(function (data) {
                        console.log('success');
                        console.log(data);
                    }).fail(function () {
                        console.log('fail');
                    });
                });
            });
        });
    </script>
</head>

<body>
    <form id="bitobopass_table" name="bitobopass_table" onkeypress="return event.keyCode != 13;">
        <table id="passtable">
            <tr>
                <td><input id="twid" name="twid" type="text" placeholder="ID"></td>
            </tr>
        </table>
        <button type="button" id="sendBtn" name="sendBtn">送信</button>
    </form>
    <table id="export01">
        <tr>
            <td>id</td>
            <td>pass</td>
        </tr>
    </table>
</body>

</html>