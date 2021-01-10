<?php
namespace App;
use PDO;

class WhiskeyDataController {

    protected $dummyWhiskey = '{ "id": "2db1-df61-be7f-4659", "name": "Whiskey 1", "active": true, "distiller": "RuBrew", "description": "The first whiskey I ever tasted", "created": "2020-12-28T12:20:35.314Z", "updated": "2020-12-28T12:20:35.314Z" }';

    protected $dummyWhiskeys;
    protected $conn;
    protected $app;
    
    public function __construct($app) {
        
        $this->dummyWhiskeys = array(
            $this->dummyWhiskey,
            $this->dummyWhiskey
        );

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
            HttpHelper::sendResponse("500 Error", "Too many rows returned");
        }
        HttpHelper::sendResponse("404 Not Found", "Object not found");
    }

}

?>
