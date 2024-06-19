<?php
session_start();
require('database.php');

if (empty($_POST['email']) || empty($_POST['password'])) {
    
    $_SESSION['loginError'] = "Les données d'authentification sont obligatoires";
    header("Location: login.php");
    exit;
}


$statement = $pdo->prepare("SELECT * FROM admin WHERE email = :email AND password = :password");
$statement->execute([
    ':email' => $_POST['email'],
    ':password' => $_POST['password']
]);
$admin = $statement -> fetch(PDO::FETCH_ASSOC);
if ($admin) {
    $_SESSION['loginAdmin'] = $admin['email']; 
    unset($_SESSION["loginError"]);
    header("Location:home.php");
    exit;
} else{
    $_SESSION['loginError'] = "Les données d'authentification sont incorrects ";
    
    header('Location: login.php');
    exit;
}

?>
