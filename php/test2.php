<? 
    if($_SERVER['REQUEST_METHOD'] == "GET" && $_SERVER['QUERY_STRING'] == "") {
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>RPCのテスト</title>
    </head>
    <body>
        <button id="button">送信</button>
        <div><br></div>
        <script src="https://polyfill.io/v3/polyfill.min.js"></script>
        <script src="<?=$_SERVER['REQUEST_URI']?>?library=base"></script>
        <script>
            var button = document.getElementById("button");
            button.addEventListener("click", function() {
                var ary_names = ['太郎', '次郎', '三郎'];

                RPC.test(ary_names,
                    function (data) {
                        alert(data);
                        //$("#data").html(data);
                    },
                    function(XMLHttpRequest, textStatus, errorThrown) {
                        alert('NG');
                    }
                );
            });
        </script>
        <pre id="data">
        </pre>
    </body>
</html>
<?
        exit;
    }

    include("rpc.php");

    class RPC
    {
        public function test($data)
        {
            return $data;
        }
    }
?>