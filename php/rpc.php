<?
if (!isset($CLASSNAME)) {
    $CLASSNAME = "RPC";
}

if (!isset($REQMETHOD)) {
    $REQMETHOD = "GET";
}

if (isset($_REQUEST["rpc"])) {
    $rpcdata = json_decode($_REQUEST["data"]);
    $output = array();
    $output["jsonrpc"] = "2.0";
    $output["id"] = null;
    $errcode = 0;
    $errmsg = '';

    if($rpcdata == null){
        $errocde = -32700;
        $errmsg = "Parse error";
    }

    if(!method_exists($CLASSNAME, $rpcdata["method"])) {
        $errcode = -32601;
        $errmsg = "Method not found";
    }

    if($errcode == 0) {
        $callfunc = array($CLASSNAME, $rpcdata["method"]);
        $result = $callfunc(json_decode($rpcdata["params"]));
        if(isset($rpcdata["id"])){
            $output["id"] = $rpcdata["id"];
            $output["result"] = $result;
            print(json_encode($output));
        }
    }
    
    if($errcode < 0) {
        $output["jsonrpc"] = "2.0";
        if($rpcdata != null && isset($rpcdata["id"])) {
            $output["id"] = $rpcdata["id"];
        }
        $output["error"] = array();
        $output["error"]["code"] = $errcode;
        $output["error"]["message"] = $errmsg;
    }
    exit;
} else if ($_SERVER['REQUEST_METHOD'] == "GET" && $_REQUEST["library"] == "base") {
?>
function _invokeajax(funcname, data, successfunc, errorfunc) {
    if(typeof window.__jsonrpcid === "undefined") window.__jsonrpcid = 0;
    window.__jsonrpcid++;
    $.ajax({
        url: location.href,
        type: '<?= $REQMETHOD ?>',
        data: {
            rpc: "",
            data: {
                method: funcname,
                params: data,
                id: window.__jsonrpcid
            },
        },
        success: function(data) {
            resultdata = JSON.parse(data);
            successfunc(resultdata.result);
        },
        error: errorfunc
    });
}
function invoke(funcname, data, successfunc, errorfunc) {
    if(typeof $ === "undefined") {
        var script = document.createElement("script");
        script.setAttribute("src","http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js");
        script.setAttribute("type","text/javascript");
        script.addEventListener('load', () => {
            _invokeajax(funcname, data, successfunc, errorfunc);
        });
        document.head.appendChild(script);
    } else {
        _invokeajax(funcname, data, successfunc, errorfunc);
    }
}
<? 
    $methods = get_class_methods($CLASSNAME);
    $vars = get_class_vars($CLASSNAME);
    print("var " . $CLASSNAME . " = {\n");
    foreach ($methods as $method) {
        print("    " . $method . ": function(data, successfunc, errorfunc) { invoke('" . $method . "', data, successfunc, errorfunc); },\n");
    }
    print("}");
    exit;
} else {
    header("HTTP/1.1 404 Not Found");
    print("404 Not Found");
    exit;
}
?>