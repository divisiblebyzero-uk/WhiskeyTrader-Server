<?php
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required(['DB_HOSTNAME', 'DB_USERNAME', 'DB_PASSWORD', 'DB_DATABASE'])->notEmpty();


$mysqli = new mysqli($_ENV['DB_HOSTNAME'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE']);


$whiskeyJson = '{ "id": "2db1-df61-be7f-4659", "name": "Whiskey 1", "active": true, "distiller": "RuBrew", "description": "The first whiskey I ever tasted", "created": "2020-12-28T12:20:35.314Z", "updated": "2020-12-28T12:20:35.314Z" }';
$whiskey = json_decode($whiskeyJson);

echo $whiskey->id;

$sql = "INSERT INTO whiskeys (userid, id, jsondata) VALUES ('root', '2db1-df61-be7f-4659', '${whiskeyJson}');";
$result = $mysqli->query($sql);

echo "<br/>";

echo $sql;
echo "Added whiskey";


$sql = 'SELECT * FROM whiskeys';

if ($result = $mysqli->query($sql)) {
    while ($data = $result->fetch_object()) {
        $whiskeys[] = $data;
    }
}

echo "<br/>";
echo json_encode($whiskeys);

foreach ($whiskeys as $w) {
    echo "<br>";
    echo $w->userid . " " . $w->id . " " . $w->jsondata;
    echo "<br>";
}

?>