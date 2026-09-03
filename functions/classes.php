<?php

function getClasses($pdo)
{
    $sql = "SELECT * FROM classes ORDER BY nom";
    $stmt = $pdo->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getClasseById($pdo, $id)
{
    $sql = "SELECT * FROM classes WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function addClasse($pdo, $nom, $annee_scolaire)
{
    $sql = "INSERT INTO classes (nom, annee_scolaire)
            VALUES (:nom, :annee_scolaire)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindParam(':annee_scolaire', $annee_scolaire, PDO::PARAM_STR);
    
    return $stmt->execute();
}


function deleteClasse($pdo, $id)
{
    $sql = "DELETE FROM classes WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    return $stmt->execute();
}