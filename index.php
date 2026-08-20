<?php

require 'config/constant.php';
require CONFIG_PATH . 'database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

$method = $_SERVER['REQUEST_METHOD'];

$fullPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = '/aweb3/horaire-eleve';
$path = str_replace($basePath, '', $fullPath);

  
switch ($method) {
    case 'GET':
        // $controller->handleGet($path);
        break;
    case 'POST':
        
        break;
    case 'PUT':
        
        break;
    case 'DELETE':
        
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}