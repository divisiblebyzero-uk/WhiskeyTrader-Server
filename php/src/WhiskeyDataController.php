<?php
namespace App;
use PDO;

class WhiskeyDataController {

    protected $conn;
    protected $app;
    
    public function __construct($app) {
        $db = new Database();
        $this->conn = $db->getConnection();
        $this->app = $app;
    }

    public function getList($table) {
        $userId = $this->app->getUserId();
        $sql = "SELECT jsondata FROM ${table} WHERE userid = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array($userId));
        $json = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        foreach ($json as &$item) {
            $item = json_decode($item);
        }
        HttpHelper::sendResponse("200 OK", $json);
    }

    public function getItem($table, $id) {
        $userId = $this->app->getUserId();

        if ($stmt = $this->conn->prepare("SELECT jsondata FROM ${table} WHERE userid = ? AND id = ? LIMIT 0,1")) {
            $stmt->execute(array($userId, $id));
            $json = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
            if (count($json) == 1) {
                HttpHelper::sendResponse("200 OK", json_decode($json[0]));
            } else if (count($json) == 0) {
                HttpHelper::sendResponse("404 Not Found", "Object not found");
            }
            HttpHelper::sendResponse("500 Internal Server Error", "Too many rows returned");
        }
        HttpHelper::sendResponse("404 Not Found", "Object not found");
    }

    public function saveItem($table) {
        $userId = $this->app->getUserId();
        $json = file_get_contents('php://input');
        $item = json_decode($json);
        $id = $item->id;
        if (json_last_error() == JSON_ERROR_NONE && isset($id)) {
            if ($stmt = $this->conn->prepare("REPLACE INTO ${table} (userid, id, jsondata) VALUES (?, ?, ?)")) {
                $stmt->execute(array($userId, $id, $json));
            }
            HttpHelper::sendResponse("200 OK", $item);
        } else {
            HttpHelper::sendResponse("500 Internal Server Error", "Invalid input data");
        }
    }
}

?>
