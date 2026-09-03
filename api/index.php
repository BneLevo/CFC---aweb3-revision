<?php

require '../config/constant.php';
require_once CONNEXION_PATH . 'db.php';
require_once FUNCTIONS_PATH . 'classes.php';
require_once FUNCTIONS_PATH . 'cours.php';
require_once FUNCTIONS_PATH . 'creneaux.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

$method = $_SERVER['REQUEST_METHOD'];

$fullPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = '/aweb3/horaire-eleve/api';
$path = str_replace($basePath, '', $fullPath);



$pdo = new Database();
$pdo->connexion();





if ($method === 'GET') {

    switch ($path) {
        case '/classes':
            break;

        case '/cours':
            break;


        case '/creneaux':
            break;


        default:
            http_response_code(404);
            echo json_encode(['error' => 'Endpoint not found']);
    }

}
else if ($method === 'POST') {

    switch ($path) {
        case '/classes':
            break;

        case '/cours':
            break;


        case '/creneaux':
            break;

        default:
            http_response_code(404);
            echo json_encode(['error' => 'Endpoint not found']);
    }

}
else if ($method === 'PUT') {

    switch ($path) {
        case '/classes':
            break;

        case '/cours':
            break;


        case '/creneaux':
            break;

        default:
            http_response_code(404);
            echo json_encode(['error' => 'Endpoint not found']);
    }

}
else if ($method === 'DELETE') {

    switch ($path) {
        case '/classes':
            break;

        case '/cours':
            break;


        case '/creneaux':
            break;


        default:
            http_response_code(404);
            echo json_encode(['error' => 'Endpoint not found']);
    }

}
else {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}