<?php
namespace App;

class HttpHelper {
    public static function sendMessage($httpStatus, $message, $error = false)
    {
        header("HTTP/1.1 $httpStatus");
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['status' => $error ? 'error' : 'ok', 'message' => $message], JSON_PRETTY_PRINT);
        exit();
    }

    public static function sendResponse($httpStatus, $data)
    {
        header("HTTP/1.1 $httpStatus");
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit();
    }

    public static function sendLocation($new_location, $data) {
        header("HTTP/1.1 201");
        header('Location', $new_location);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit();
    }


}

?>