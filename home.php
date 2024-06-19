<?php
session_start();
require('database.php');

// ! verification de l'authentification d'admin
if (!isset($_SESSION['loginAdmin'])) {
    header("Location: home.php");
    exit;
}

$statement = $pdo->prepare("SELECT participant.idPar, nom, prenom, dateNaissance, intitule FROM participant JOIN categories ON participant.idCat = categories.idCat");
$statement->execute();
$participants = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
    <style>
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-800 via-gray-900 to-gray-800 min-h-screen flex flex-col">
    <header class="bg-gray-200 container mx-auto flex items-center justify-between h-24 p-5 shadow-lg">
        <h1 class="font-bold text-4xl text-amber-600">Espace privé</h1> 
        <form action="deconnecter.php" method="post">
            <button class="bg-red-500 text-white font-bold px-8 py-2 rounded-full hover:bg-red-700 transition duration-300 ease-in-out" type="submit">Se Déconnecter</button>
        </form>
    </header>
    <div class="container mx-auto p-5">
        <div class="heading text-center text-3xl text-white mb-5 fade-in">Liste des participants</div>
        <div class="flex justify-end mb-5">
            <a href="ajouterParticipant.php" class="bg-green-500 text-white font-bold py-2 px-4 rounded-full hover:bg-green-700 transition duration-300 ease-in-out">Ajouter</a>
        </div>
        <table class="min-w-full border-collapse block md:table bg-white rounded-lg overflow-hidden shadow-lg fade-in">
            <thead class="block md:table-header-group">
                <tr class="block md:table-row">
                    <th class="bg-gray-700 p-3 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Nom</th>
                    <th class="bg-gray-700 p-3 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Prénom</th>
                    <th class="bg-gray-700 p-3 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Date de naissance</th>
                    <th class="bg-gray-700 p-3 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Categorie</th>
                    <th class="bg-gray-700 p-3 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Actions</th>
                </tr>
            </thead>
            <tbody class="block md:table-row-group">
                <?php foreach ($participants as $participant) : ?>
                    <tr class="bg-gray-200 border border-grey-500 md:border-none block md:table-row">
                        <td class="p-3 md:border md:border-grey-500 text-left block md:table-cell"><?php echo $participant['nom']; ?></td>
                        <td class="p-3 md:border md:border-grey-500 text-left block md:table-cell"><?php echo $participant['prenom']; ?></td>
                        <td class="p-3 md:border md:border-grey-500 text-left block md:table-cell"><?php echo $participant['dateNaissance']; ?></td>
                        <td class="p-3 md:border md:border-grey-500 text-left block md:table-cell"><?php echo $participant['intitule']; ?></td>
                        <td class="p-3 md:border md:border-grey-500 text-left block md:table-cell flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
                            <a href="modifier.php?id=<?= $participant['idPar'] ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out">Modifier</a>
                            <form action="supprimer.php" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce participant ?');">
                                <input type="hidden" name="id" value="<?php echo $participant['idPar']; ?>">
                                <input type="hidden" name="_method" value="delete">
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out">Supprimer</button>
                            </form>
                        </td>
                    </tr>	
                <?php endforeach; ?>	
            </tbody>
        </table>
    </div>
</body>
</html>
