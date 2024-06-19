<?php 
session_start();
require('database.php');


if($_SERVER['REQUEST_METHOD'] == 'POST'){


    $statement = $pdo->prepare("INSERT INTO participant (nom, prenom, dateNaissance, idCat) 
    VALUES (:nom, :prenom, :dateNaissance, :idCat)");
    
    $statement->execute([
        ':nom' => $_POST['nom'],
        ':prenom' => $_POST['prenom'],
        ':dateNaissance' => $_POST['dateNaissance'],
        ':idCat' => $_POST['idCategorie']
    
    ]);
    header('Location: home.php');
    

}