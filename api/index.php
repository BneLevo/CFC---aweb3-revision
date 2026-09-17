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



$pdo = Database::connexion();


$parts = explode('/', trim($path, '/'));
$resource = $parts[0] ?? '';
$id = $parts[1] ?? null;


// Récupérer les données JSON envoyées
$data = json_decode(file_get_contents('php://input'), true);



if ($method === 'GET') {

    switch ($resource) {

        case 'classes':

            if ($id !== null) {

                $classe = getClasseById($pdo, $id);

                if ($classe) {
                    echo json_encode($classe);
                } else {
                    http_response_code(404);
                    echo json_encode([
                        'error' => 'Classe not found'
                    ]);
                }

            } else {

                echo json_encode(getClasses($pdo));

            }

            break;


        case 'cours':

            if ($id !== null) {

                $cours = getCoursById($pdo, $id);

                if ($cours) {
                    echo json_encode($cours);
                } else {
                    http_response_code(404);
                    echo json_encode([
                        'error' => 'Cours not found'
                    ]);
                }

            } else {

                echo json_encode(getCours($pdo));

            }

            break;


        case 'creneaux':

            if ($id !== null) {

                $creneau = getCreneauById($pdo, $id);

                if ($creneau) {
                    echo json_encode($creneau);
                } else {
                    http_response_code(404);
                    echo json_encode([
                        'error' => 'Creneau not found'
                    ]);
                }

            } else {

                echo json_encode(getCreneaux($pdo));

            }

            break;


        default:
            http_response_code(404);
            echo json_encode([
                'error' => 'Endpoint not found'
            ]);

    }

}
else if ($method === 'POST') {

    switch ($resource) {

        case 'classes':

            if (
                !isset($data['nom']) ||
                !isset($data['annee_scolaire'])
            ) {
                http_response_code(400);
                echo json_encode([
                    'error' => 'Missing data'
                ]);
                break;
            }

            $result = addClasse(
                $pdo,
                $data['nom'],
                $data['annee_scolaire']
            );

            if ($result) {
                http_response_code(201);
                echo json_encode([
                    'message' => 'Classe created'
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'error' => 'Unable to create classe'
                ]);
            }

            break;


        case 'cours':

            if (
                !isset($data['code']) ||
                !isset($data['nom'])
            ) {
                http_response_code(400);
                echo json_encode([
                    'error' => 'Missing data'
                ]);
                break;
            }

            $result = addCours(
                $pdo,
                $data['code'],
                $data['nom']
            );

            if ($result) {
                http_response_code(201);
                echo json_encode([
                    'message' => 'Cours created'
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'error' => 'Unable to create cours'
                ]);
            }

            break;


        case 'creneaux':

            if (
                !isset($data['classe_id']) ||
                !isset($data['cours_id']) ||
                !isset($data['jour']) ||
                !isset($data['heure_debut']) ||
                !isset($data['heure_fin']) ||
                !isset($data['salle'])
            ) {
                http_response_code(400);
                echo json_encode([
                    'error' => 'Missing data'
                ]);
                break;
            }

            $result = addCreneau(
                $pdo,
                $data['classe_id'],
                $data['cours_id'],
                $data['jour'],
                $data['heure_debut'],
                $data['heure_fin'],
                $data['salle']
            );

            if ($result) {
                http_response_code(201);
                echo json_encode([
                    'message' => 'Creneau created'
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'error' => 'Unable to create creneau'
                ]);
            }

            break;


        default:

            http_response_code(404);
            echo json_encode([
                'error' => 'Endpoint not found'
            ]);

    }

}
else if ($method === 'PUT') {

    if ($id === null) {
        http_response_code(400);
        echo json_encode([
            'error' => 'ID required'
        ]);
        exit;
    }

    switch ($resource) {

        case 'cours':

            if (
                !isset($data['code']) ||
                !isset($data['nom'])
            ) {
                http_response_code(400);
                echo json_encode([
                    'error' => 'Missing data'
                ]);
                break;
            }

            $result = updateCours(
                $pdo,
                $id,
                $data['code'],
                $data['nom']
            );

            if ($result) {
                echo json_encode([
                    'message' => 'Cours updated'
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'error' => 'Unable to update cours'
                ]);
            }

            break;


        case 'creneaux':

            if (
                !isset($data['classe_id']) ||
                !isset($data['cours_id']) ||
                !isset($data['jour']) ||
                !isset($data['heure_debut']) ||
                !isset($data['heure_fin']) ||
                !isset($data['salle'])
            ) {
                http_response_code(400);
                echo json_encode([
                    'error' => 'Missing data'
                ]);
                break;
            }

            $result = updateCreneau(
                $pdo,
                $id,
                $data['classe_id'],
                $data['cours_id'],
                $data['jour'],
                $data['heure_debut'],
                $data['heure_fin'],
                $data['salle']
            );

            if ($result) {
                echo json_encode([
                    'message' => 'Creneau updated'
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'error' => 'Unable to update creneau'
                ]);
            }

            break;

        default:
            http_response_code(404);
            echo json_encode([
                'error' => 'Endpoint not found'
            ]);

    }

}
else if ($method === 'DELETE') {

    if ($id === null) {
        http_response_code(400);
        echo json_encode([
            'error' => 'ID required'
        ]);
        exit;
    }

    switch ($resource) {

        case 'classes':

            $result = deleteClasse($pdo, $id);

            if ($result) {
                echo json_encode([
                    'message' => 'Classe deleted'
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'error' => 'Unable to delete classe'
                ]);
            }

            break;


        case 'cours':

            $result = deleteCours($pdo, $id);

            if ($result) {
                echo json_encode([
                    'message' => 'Cours deleted'
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'error' => 'Unable to delete cours'
                ]);
            }

            break;


        case 'creneaux':

            $result = deleteCreneau($pdo, $id);

            if ($result) {
                echo json_encode([
                    'message' => 'Creneau deleted'
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'error' => 'Unable to delete creneau'
                ]);
            }

            break;


        default:

            http_response_code(404);
            echo json_encode([
                'error' => 'Endpoint not found'
            ]);

    }

}
else {

    http_response_code(405);

    echo json_encode([
        'error' => 'Method not allowed'
    ]);
}