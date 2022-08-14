<?php

$data = ['test' => 'テスト'];

//サーバーレンダー
class contents_render
{
    public static function render($contents_file, $base_file, $contents_data, $mustachedir = '')
    {
        //GET以外またはgetcontents=trueでない場合
        if (empty($_GET['getcontents']) || $_GET['getcontents'] != 'true') {
            //GETかつgatdata=trueでない場合
            if ($_SERVER['REQUEST_METHOD'] == 'GET' && (empty($_GET['getdata']) || $_GET['getdata'] != 'true')) {
                //Mustacheクラスのロード
                if ($mustachedir != '') {
                    //composerやautoloadの設定をしている場合は不要
                    require_once($mustachedir.'/Autoloader.php');
                    Mustache_Autoloader::register();
                }
                $template_engine = new Mustache_Loader_FilesystemLoader(dirname($contents_file), array('entity_flags' => ENT_QUOTES));

                //コンテンツ部分のコンパイル
                $contents_source = file_get_contents($contents_file);
                $contents_source = preg_replace('/\<\?(.*?)[?]>/s', '', $contents_source); //PHPコード部分を削除
                $contents_render = $template_engine->render($contents_source, $contents_data);
                $contents_data['contents_data'] = $contents_render;

                //ベース部分のコンパイル
                if ($base_file != '') {
                    $base_source = file_get_contents($base_file);
                    $base_source = preg_replace('/\<\?(.*?)[?]>/s', '', $contents_data); //PHPコード部分を削除
                    $contents_render = $template_engine->render($base_source, $contents_data);
                }

                //最終結果の変換
                $contents_render = preg_replace('/__FILE__/', basename($contents_file), $contents_render); //__FILE__をテンプレートPHPのファイル名に

                //出力
                echo $contents_render;
            } else {
                //JSONを出力
                header('Content-Type: application/json');
                echo json_encode($contents_data);
            }
            exit();
        }
    }
}
contents_render::render(__FILE__, __FILE__, $data, dirname(__FILE__).'/Mustache');
?>
<?php if (false):  //コンテンツファイル開始?>
{{^contents_data}}
<?php endif ?>

<div>{{test}}</div>

<?php if (false): ?>
{{/contents_data}}
<?php endif //コンテンツファイル終了?>

<?php if (false): //ベースファイル開始?>
{{#contents-data}}
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/mustache@4/mustache.min.js"></script>
    <script>
        //クライアントレンダー
        class contents_render {
            static contents_source = {};
            static async get_contents(contents_url) {
                let data;
                await (async () => {
                    const response = await fetch(`${contents_url}?getcontents=true`);
                    data = await response.text();
                })();
                return data;
            }
            static async get_data(contents_url) {
                let data;
                await (async () => {
                    const response = await fetch(`${contents_url}?getdata=true`);
                    data = await response.json();
                })();
                return data;
            }
            static async render(contents_url, id = 'contents') {
                if (typeof (contents_render.contents_source[contents_url]) !== 'string') {
                    contents_render.contents_source[contents_url] = await contents_render.get_contents(contents_url);
                }
                const data = await contents_render.get_data(contents_url);
                const element = document.getElementById(id);
                if (element !== null) {
                    const output = Mustache.render(contents_render.contents_source[contents_url], data);
                    element.innerHTML = output;
                }
            }
        }

        class content_router {
            static init() {
                window.addEventListener("popstate", () => {
                    content_router.onBack(location.href);
                });

                document.querySelectorAll("a").forEach(a => {
                    a.onclick = event => {
                        event.preventDefault();
                        window.history.pushState(null, "", a.href);
                        content_router.onClick(a.href);
                    };
                });
            }

            static onBack(href) {

            }

            static onClick(href) {

            }
        }
    </script>

    <title>Mustachのテスト</title>
    <style>

    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            contents_render.render('./__FILE__');
        });
    </script>
</head>

<body>
    <div id="contents">
        {{{contents-data}}}
    </div>
</body>

</html>
{{/contents-data}}
<?php endif //ベースファイル終了?>