<?php

use AjaxBridge\AjaxBridge;

$debug = false; // Getting response info
$testUrl = "http://$_SERVER[HTTP_HOST]:$_SERVER[SERVER_PORT]?ajaxBridgeRequestTest=true";

if ($debug && isset($_GET['ajaxBridgeRequestTest'])) {

    header('Content-Type: application/json');

    $res['content'] = file_get_contents("php://input");
    $pp = $_SERVER['REQUEST_METHOD'] . ' ' . $_SERVER['REQUEST_URI'] . ' ' . $_SERVER['SERVER_PROTOCOL'];
    $res = array_merge(array(0 => $pp), $res);

    echo json_encode($res);

} else {

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            require_once('example.php');
            break;
        case 'POST':

            require_once('src/AjaxBridge.php');
            $ab = new AjaxBridge();

            if ($debug) {
                $ab->execute(false);
                $resp = $ab->getResponse();
                $resp['request'] = json_decode(file_get_contents($testUrl, false, $ab->getContext()), true);
                $resp['request']['headers'] = getallheaders();
                echo json_encode($resp);
            } else {
                $ab->execute();
            }

            break;
        default:
            http_response_code(400);
            break;
    }
}