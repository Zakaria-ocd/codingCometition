<?php
session_start();
require('database.php');

if (!isset($_SESSION['loginAdmin'])) {
    header("Location: authentifier.php");
    exit;
} else {

    // remplir la liste deroulante (categories)
    $statement = $pdo->prepare('SELECT idCat, intitule FROM categories');
    $statement->execute();
    $categories = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_GET["id"])) {
        $statement = $pdo->prepare('SELECT * FROM participant WHERE idPar = :idPar');
        $statement->execute([
            ':idPar' => $_GET["id"]
        ]);
        $participant = $statement->fetch(PDO::FETCH_ASSOC);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Modifier un participant</title>
    <style>
        body {
            background: linear-gradient(to right, #ece9e6, #ffffff);
        }
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-200">
    <div class="w-full max-w-2xl mx-auto p-5 bg-white rounded-lg shadow-lg fade-in">
        <h2 class="text-3xl font-bold text-center text-amber-600 mb-5">Modifier un participant</h2>
        <form action="traitement_modifier.php" method="POST">
            <input type="hidden" name="idParticipant" value="<?php echo $participant['idPar']; ?>">

            <div class="mb-4">
                <label for="nom" class="block text-lg font-medium text-gray-700 mb-2">Nom</label>
                <input type="text" name="nom" id="nom" value="<?php echo $participant['nom']; ?>" class="w-full p-3 bg-gray-100 rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-300" />
            </div>
            <div class="mb-4">
                <label for="prenom" class="block text-lg font-medium text-gray-700 mb-2">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="<?php echo $participant['prenom']; ?>" class="w-full p-3 bg-gray-100 rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-300" />
            </div>
            <div class="mb-4">
                <label for="dateNaissance" class="block text-lg font-medium text-gray-700 mb-2">Date Naissance</label>
                <input type="date" name="dateNaissance" id="dateNaissance" value="<?php echo $participant['dateNaissance']; ?>" class="w-full p-3 bg-gray-100 rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-300" />
            </div>
            <div class="mb-4">
                <label for="categories" class="block text-lg font-medium text-gray-700 mb-2">Filière</label>
                <select name="idCategorie" id="categories" class="w-full p-3 bg-gray-100 rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-300">
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?php echo $categorie['idCat']; ?>" <?php echo $participant['idCat'] == $categorie['idCat'] ? 'selected' : ''; ?>>
                            <?php echo $categorie['intitule']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="flex justify-center">
                <input type="submit" value="Save" class="px-6 py-3 bg-amber-600 text-white font-semibold rounded-md hover:bg-amber-700 focus:bg-amber-700 focus:outline-none focus:ring focus:ring-amber-200 transition duration-300 cursor-pointer">
            </div>
        </form>
    </div>
</body>
</html>
<?php } ?>
