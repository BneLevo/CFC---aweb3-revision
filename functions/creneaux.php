<?php

function getCreneaux($pdo)
{
    $sql = "SELECT creneaux.*, classes.nom AS classe_nom,
                   cours.code AS cours_code, cours.nom AS cours_nom
            FROM creneaux
            INNER JOIN classes ON classes.id = creneaux.classe_id
            INNER JOIN cours ON cours.id = creneaux.cours_id
            ORDER BY FIELD(jour, 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi'), heure_debut";
    $stmt = $pdo->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCreneauById($pdo, $id)
{
    $sql = "SELECT * FROM creneaux WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addCreneau($pdo, $classeId, $coursId, $jour, $heureDebut, $heureFin, $salle)
{
    $sql = "INSERT INTO creneaux
                (classe_id, cours_id, jour, heure_debut, heure_fin, salle)
            VALUES (:classe_id, :cours_id, :jour, :heure_debut, :heure_fin, :salle)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':classe_id', $classeId, PDO::PARAM_INT);
    $stmt->bindParam(':cours_id', $coursId, PDO::PARAM_INT);
    $stmt->bindParam(':jour', $jour, PDO::PARAM_STR);
    $stmt->bindParam(':heure_debut', $heureDebut, PDO::PARAM_STR);
    $stmt->bindParam(':heure_fin', $heureFin, PDO::PARAM_STR);
    $stmt->bindParam(':salle', $salle, PDO::PARAM_STR);

    return $stmt->execute();
}

function updateCreneau($pdo, $id, $classeId, $coursId, $jour, $heureDebut, $heureFin, $salle)
{
    $sql = "UPDATE creneaux
            SET classe_id = :classe_id, cours_id = :cours_id,
                jour = :jour, heure_debut = :heure_debut,
                heure_fin = :heure_fin, salle = :salle
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':classe_id', $classeId, PDO::PARAM_INT);
    $stmt->bindParam(':cours_id', $coursId, PDO::PARAM_INT);
    $stmt->bindParam(':jour', $jour, PDO::PARAM_STR);
    $stmt->bindParam(':heure_debut', $heureDebut, PDO::PARAM_STR);
    $stmt->bindParam(':heure_fin', $heureFin, PDO::PARAM_STR);
    $stmt->bindParam(':salle', $salle, PDO::PARAM_STR);

    return $stmt->execute();
}

function deleteCreneau($pdo, $id)
{
    $sql = "DELETE FROM creneaux WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}

