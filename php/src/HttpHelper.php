<?php
namespace App;

class HttpHelper {
    public static function sendMessage($httpStatus, $message, $error = false)
    {
        header("HTTP/1.0 $httpStatus");
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['status' => $error ? 'error' : 'ok', 'message' => $message], JSON_PRETTY_PRINT);
        exit();
    }

    public static function sendResponse($httpStatus, $data)
    {
        header("HTTP/1.0 $httpStatus");
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit();
    }


}

?>