<?php

use AjaxBridge\AjaxBridge;

$debug = true; // Getting response info

if ($debug && isset($_GET['ajaxBridgeRequestTest'])) {

    header('Content-Type: application/json');

    $res = $_SERVER;
    $res['HTTP_CONTENT'] = file_get_contents("php://input");

    echo json_encode($res);

} else {

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            require_once('example.php');
            break;
        case 'POST':

            require_once('src/AjaxBridge.php');
            $ab = new AjaxBridge();

            if ($debug) {

                header('Content-Type: application/json');
                $ab->execute(false);
                $resp = $ab->getResponse();
                $resp['request']['url'] = $ab->getUrl();

                $protocol = $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
                $testUrl = "$protocol://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?ajaxBridgeRequestTest=true";
                $resp['request'] = json_decode(file_get_contents($testUrl, false, $ab->getContext()), true);

                echo json_encode($resp);

            } else {
                $ab->execute();
            }

            break;
        case 'OPTIONS':
            break;
        default:
            http_response_code(400);
            break;
    }
}