<?php 
require 'database.php';
if($_SERVER['REQUEST_METHOD'] ==  'POST'){
    $statement = $pdo -> prepare('UPDATE Participant SET nom = :nom , prenom = :prenom , dateNaissance = :dateNaissance , idCat = :idCat WHERE idPar = :idPar');
    $statement -> execute([
        ':idPar' => $_POST['idParticipant'],
        ':idCat' => $_POST['idCategorie'],
        ":nom" => $_POST['nom'],
        ':prenom' => $_POST['prenom'],
        ':dateNaissance' => $_POST['dateNaissance'],
    ]);
    header('Location:home.php');
}






?>