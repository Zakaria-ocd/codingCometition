<?php
session_start();
$loginError = '';
if(isset($_SESSION['loginError'])){
    $loginError = $_SESSION['loginError'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Log in</title>
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
<body class="h-screen w-full bg-gradient-to-br from-slate-800 via-gray-900 to-gray-800">
    <script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>
    <div class="flex flex-col h-screen justify-center items-center">
        <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg fade-in">
            <div class="text-center mb-6">
                <h6 class="font-semibold text-3xl bg-gradient-to-tl from-amber-600 via-amber-700 to-black text-transparent bg-clip-text">Login</h6>
            </div>
            <form class="space-y-12" action="verification.php" method="POST">
                <div>
                    <input id="loginAdmin" type="text" name="email" class="block w-full py-3 px-4 text-gray-800 appearance-none border-2 border-gray-300 focus:outline-none focus:border-amber-600 rounded-md transition duration-300 ease-in-out" placeholder="Login" required />
                </div>

                <div class="relative">
                    <input :type="showPass ? 'password' : 'text'" id="password" name="password" class="block w-full py-3 px-4 text-gray-800 appearance-none border-2 border-gray-300 focus:outline-none focus:border-amber-600 rounded-md transition duration-300 ease-in-out" placeholder="Mot de passe" required x-bind:type="showPass ? 'password' : 'text'" />
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                        <button type="button" @click="showPass = !showPass" class="text-amber-600 font-semibold focus:outline-none" x-text="showPass ? 'Show Password' : 'Hide Password'"></button>
                    </div>
                </div>
                <span class="text-red-500"><?= $loginError ?></span>

                <button type="submit" class="w-full py-3 bg-gradient-to-tr from-amber-600 via-amber-700 to-black text-white rounded-md font-medium uppercase focus:outline-none hover:bg-amber-700 transition duration-300 ease-in-out transform hover:scale-105">S'authentifier</button>
            </form>
        </div>
    </div>

</body>
</html>
