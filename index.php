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
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center">
                            Sign in to your account
                        </h1>
                        
                        <!-- Tabs pour sélectionner le type d'utilisateur -->
                        <div class="flex justify-center space-x-4 mb-6">
                            <button onclick="showForm('student')" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" id="studentTab">Student</button>
                            <button onclick="showForm('professor')" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2" id="professorTab">Professor</button>
                            <button onclick="showForm('admin')" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2" id="adminTab">Admin</button>
                        </div>

                        <!-- Formulaire Étudiant -->
                        <form id="studentForm" class="space-y-4 md:space-y-6" method="POST" action="connexion.php">
                            <input type="hidden" name="user_type" value="student">
                            <div>
                                <label for="student_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student Email</label>
                                <input type="email" name="email" id="student_email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="student@iai.com" required>
                            </div>
                            <div>
                                <label for="student_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" name="password" id="student_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>
                            <button type="submit" name="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in as Student</button>
                        </form>

                        <!-- Formulaire Professeur -->
                        <form id="professorForm" class="space-y-4 md:space-y-6 hidden" method="POST" action="connexion.php">
                            <input type="hidden" name="user_type" value="professor">
                            <div>
                                <label for="professor_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Professor Email</label>
                                <input type="email" name="email" id="professor_email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="professor@iai.com" required>
                            </div>
                            <div>
                                <label for="professor_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" name="password" id="professor_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>
                            <button type="submit" name="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in as Professor</button>
                        </form>

                        <!-- Formulaire Admin -->
                        <form id="adminForm" class="space-y-4 md:space-y-6 hidden" method="POST" action="connexion.php">
                            <input type="hidden" name="user_type" value="admin">
                            <div>
                                <label for="admin_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Admin Email</label>
                                <input type="email" name="email" id="admin_email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="admin@iai.com" required>
                            </div>
                            <div>
                                <label for="admin_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" name="password" id="admin_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>
                            <button type="submit" name="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in as Admin</button>
                        </form>

                        <?php 
                        if (isset($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?>
                            <div class="bg-red-100 rounded p-3 text-center text-red-700">
                                <?php 
                                echo $_SESSION['LOGIN_ERROR_MESSAGE'];
                                unset($_SESSION['LOGIN_ERROR_MESSAGE']); 
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        function showForm(type) {
            // Cacher tous les formulaires
            document.getElementById('studentForm').classList.add('hidden');
            document.getElementById('professorForm').classList.add('hidden');
            document.getElementById('adminForm').classList.add('hidden');

            // Réinitialiser les styles des boutons
            document.getElementById('studentTab').classList.remove('bg-blue-600', 'text-white');
            document.getElementById('professorTab').classList.remove('bg-blue-600', 'text-white');
            document.getElementById('adminTab').classList.remove('bg-blue-600', 'text-white');

            document.getElementById('studentTab').classList.add('bg-gray-200', 'text-gray-700');
            document.getElementById('professorTab').classList.add('bg-gray-200', 'text-gray-700');
            document.getElementById('adminTab').classList.add('bg-gray-200', 'text-gray-700');

            // Afficher le formulaire sélectionné
            document.getElementById(type + 'Form').classList.remove('hidden');
            
            // Mettre à jour le style du bouton actif
            document.getElementById(type + 'Tab').classList.remove('bg-gray-200', 'text-gray-700');
            document.getElementById(type + 'Tab').classList.add('bg-blue-600', 'text-white');
        }
    </script>
</body>
</html>