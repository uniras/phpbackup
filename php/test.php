<? if($_SERVER['REQUEST_METHOD'] == "GET") { ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Ajax Test1</title>
    </head>
    <body>
        <button id="button">送信</button>
        <div><br></div>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script>
            $(function() {
                $("#button").on("click", function(evt) {
                    var ary_names = ['太郎', '次郎', '三郎'];

                    $.ajax({
                        url: location.href,
                        type: 'POST',
                        data: {
                            func: "test",
                            data: "あああああ",
                        },
                        success: function (data) {
                            //alert('OK');
                            $("#data").html(data);
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert('NG');
                        }
                    });
                });
            });
        </script>
        <pre id="data">
        </pre>
    </body>
</html>
<?
    } else if($_SERVER['REQUEST_METHOD'] == "POST") {
        $_REQUEST["func"]($_REQUEST["data"]);
    }


    public static function test($data)
    {
        print_r($data);
    }
  
?>