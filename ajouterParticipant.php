<?php
session_start();
if (!isset($_SESSION['loginAdmin'])) {
    header("Location: authentifier.php");
    exit;
} else {
    require('database.php');
    $statement = $pdo->prepare('SELECT idCat, intitule FROM categories');
    $statement->execute();
    $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Ajouter un nouveau stagiaire</title>
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
<body class="min-h-screen bg-gradient-to-br from-gray-200 via-gray-400 to-gray-600 flex items-center justify-center">
    <div class="fade-in w-full max-w-2xl p-8 bg-white rounded-lg shadow-2xl">
        <h2 class="text-3xl font-bold text-center text-amber-600 mb-5">Ajouter un nouveau stagiaire</h2>
        <p class="text-center text-gray-600 mb-8">Veuillez remplir tous les champs</p>
        <form action="traitement.php" method="POST">
            <div class="space-y-6">
                <div>
                    <label for="nom" class="block text-lg font-medium text-gray-700">Nom</label>
                    <input type="text" name="nom" id="nom" placeholder="Entrer votre nom" class="w-full p-3 rounded-md border border-gray-300 bg-gray-100 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-300">
                </div>
                <div>
                    <label for="prenom" class="block text-lg font-medium text-gray-700">Prénom</label>
                    <input type="text" name="prenom" id="prenom" placeholder="Entrer votre prénom" class="w-full p-3 rounded-md border border-gray-300 bg-gray-100 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-300">
                </div>
                <div>
                    <label for="dateNaissance" class="block text-lg font-medium text-gray-700">Date Naissance</label>
                    <input type="date" name="dateNaissance" id="dateNaissance" class="w-full p-3 rounded-md border border-gray-300 bg-gray-100 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-300">
                </div>
                <div>
                    <label for="categorie" class="block text-lg font-medium text-gray-700">Catégorie</label>
                    <select name="idCategorie" id="categories" class="w-full p-3 rounded-md border border-gray-300 bg-gray-100 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-300">
                        <?php foreach ($categories as $categorie): ?>
                            <option value="<?php echo $categorie['idCat']; ?>"><?php echo $categorie['intitule']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex justify-center">
                    <input type="submit" value="Ajouter" class="px-6 py-3 bg-amber-600 text-white font-semibold rounded-md hover:bg-amber-700 focus:bg-amber-700 focus:outline-none focus:ring focus:ring-amber-200 transition duration-300 cursor-pointer">
                </div>
            </div>
        </form>
    </div>
</body>
</html>
<?php } ?>
