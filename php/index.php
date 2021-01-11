<?php
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required(['AUTH0_DOMAIN', 'AUTH0_AUDIENCE', 'DB_HOSTNAME', 'DB_USERNAME', 'DB_PASSWORD', 'DB_DATABASE'])->notEmpty();

$app = new \App\Main([
    'issuer' => 'https://' . $_ENV['AUTH0_DOMAIN'] . '/',
    'audience' => $_ENV['AUTH0_AUDIENCE'] ?? null,
    'algorithm' => $_ENV['AUTH0_SIGNING_ALGORITHM'] ?? 'RS256',
    'secret' => $_ENV['AUTH0_SIGNING_SECRET'] ?? null,
]);



// Create Router instance
$router = new \Bramus\Router\Router();

// Activate CORS
function sendCorsHeaders()
{
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Authorization");
    header("Access-Control-Allow-Methods: GET,HEAD,PUT,PATCH,POST,DELETE");
}

$router->options('/.*', function () {
    sendCorsHeaders();
    exit();
});

sendCorsHeaders();

// Check JWT on private routes
$router->before('GET|POST|PUT', '/api/data.*', function () use ($app) {
    $requestHeaders = apache_request_headers();

    if (isset($_GET['token'])) {
        $requestHeaders['authorization'] = $_GET['token'];
    } else if (isset($_ENV['REDIRECT_HTTP_AUTHORIZATION'])) {
        $requestHeaders['authorization'] = $_ENV['REDIRECT_HTTP_AUTHORIZATION'];
    }

    if (!isset($requestHeaders['authorization']) && !isset($requestHeaders['Authorization'])) {
        App\HttpHelper::sendMessage('401 Unauthorized', 'No token provided.');
    }

    $authorizationHeader = isset($requestHeaders['authorization'])
        ? $requestHeaders['authorization']
        : $requestHeaders['Authorization'];

    if ($authorizationHeader == null) {
        App\HttpHelper::sendMessage('401 Unauthorized', 'No authorization header sent.');
    }

    $authorizationHeader = str_replace('Bearer ', '', $authorizationHeader);
    $token = str_replace('Bearer ', '', $authorizationHeader);

    try {
        $app->setCurrentToken($token);
    } catch (\Exception $e) {
        App\HttpHelper::sendMessage('401 Unauthorized', $e->getMessage(), true);
    }

});

$router->mount('/api/data', function() use ($app, $router) {
    $router->setNamespace('\App');
    
    $wdc = new \App\WhiskeyDataController($app);
    $router->get('/(.*)/(.*)', function($table, $id) use ($wdc) {$wdc->getItem($table, $id, null);});
    $router->get('/(.*)', function($table) use ($wdc) {$wdc->getList($table);});

    $router->put('/(.*)', function($table) use ($wdc) {$wdc->saveItem($table);});
});

$router->get('/api/public', function () use ($app) {
    App\HttpHelper::sendMessage('200 OK', $app->publicEndpoint());
});

$router->set404(function () {
    App\HttpHelper::sendMessage('404 Not Found', 'Page not found.', true);
});

// Run the Router
$router->run();
