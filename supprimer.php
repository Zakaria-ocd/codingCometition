<?php
session_start();
require('database.php');


$statement = $pdo->prepare("DELETE FROM participant WHERE idPar = :idPar");
$statement->execute([
    ':idPar' => $_POST['id']
]);


header("Location: home.php");



?>
