<?php 
session_start();

require_once(__DIR__ . '/assets/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/function.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/LOGO_IAI.jpg" />
    <title>Page de connexion PGE-IAI</title>
    <script src="assets/config/tailwindcss.js"></script>
    <link rel="stylesheet" href="assets/css/Styles.css">
</head>
<body>
    <div class="min-h-screen flex items-center justify-center gap-[12rem]">
        <section class="text-white ml-[2rem]">
            <a href="#" class="flex items-center mb-6 text-2xl font-bold">
                <img class="w-12 h-12 mr-2" src="assets/images/LOGO_IAI.jpg" alt="logo">
                IAI Student Management Platform    
            </a>
            <h1 class="text-5xl mb-4">
            Congratulations 🎉
            </h1>
            <p class="font-bold">
            Welcome to IAI Management System ! <br>
            </p>
            <p class="text-2xl">
            
            To finish your enrolment, please complete<br> your registration with your personal, academic<br> details and fee payment. <br>
            This will help us to create your student profile<br>, please enter accurate and complete<br> information, as this will be used for official<br> purposes.<br><br>

            Thank you for choosing our university and see you soon! <br>
            </p>
        </section>
        <section class="w-full max-w-md">
            <div class="flex flex-col items-center justify-center px-6 py-8">
                
                <div class="w-full bg-white/90 backdrop-blur-sm rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800/90 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Sign in to your account
                        </h1>
                        <form class="space-y-4 md:space-y-6" method="POST" action="connexion.php">
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                      <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                                    </div>
                                    <div class="ml-3 text-sm">
                                      <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                                    </div>
                                </div>
                                <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-primary-500">Forgot password?</a>
                            </div>
                            <button type="submit" name="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in</button>
                            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                Are you a student ? <a href="#" class="font-medium text-blue-600 hover:underline dark:text-primary-500">Login as a student</a>
                            </p>

                            <?php 
                            // Affiche un message d'erreur de connexion s'il existe
                            if (isset($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?>
                                <div class="bg-red-100 rounded p-3 text-center">
                                        <?php 
                                        echo $_SESSION['LOGIN_ERROR_MESSAGE'];
                                        // Supprime le message d'erreur après l'avoir affiché
                                        unset($_SESSION['LOGIN_ERROR_MESSAGE']); 
                                        ?>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>