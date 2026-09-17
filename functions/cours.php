<?php

function getCours($pdo)
{
    $sql = "SELECT * FROM cours ORDER BY nom";
    $stmt = $pdo->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getCoursById($pdo, $id)
{
    $sql = "SELECT * FROM cours WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function addCours($pdo, $code, $nom)
{
    $sql = "INSERT INTO cours (code, nom)
            VALUES (:code, :nom)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':code', $code, PDO::PARAM_STR);
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);

    return $stmt->execute();
}


function updateCours($pdo, $id, $code, $nom)
{
    $sql = "UPDATE cours
            SET code = :code, nom = :nom
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':code', $code, PDO::PARAM_STR);
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);

    return $stmt->execute();
}


function deleteCours($pdo, $id)
{
    $sql = "DELETE FROM cours WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}