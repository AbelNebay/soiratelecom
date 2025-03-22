<?php
require 'vendor/autoload.php';
use Plivo\RestClient;

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$auth_id = 'YOUR_PLIVO_AUTH_ID';
$auth_token = 'YOUR_PLIVO_AUTH_TOKEN';

try {
    $client = new RestClient($auth_id, $auth_token);
    $username = 'user_' . time();
    $password = bin2hex(random_bytes(8));
    
    // Create Endpoint user
    $response = $client->endpoints->create(
        $username,
        $password,
        'YourAppName'
    );
    
    echo json_encode([
        'username' => $username,
        'password' => $password,
        'token' => $response->message
    ]);
} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

?>