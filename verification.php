<?php
session_start();

require_once(__DIR__ . '/assets/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/function.php');

// Vérifier si l'utilisateur a bien passé la première étape
if (!isset($_SESSION['PENDING_USER'])) {
    redirectToUrl('index.php');
}

$postData = $_POST;

if (isset($postData['submit'])) {
    if (empty($postData['code'])) {
        $_SESSION['VERIFICATION_ERROR'] = 'Veuillez entrer le code de vérification';
    } else {
        $code = $postData['code'];
        $userId = $_SESSION['PENDING_USER']['user_id'];

        // Vérifier le code
        $stmt = $mysqlClient->prepare("SELECT * FROM verification_codes 
            WHERE user_id = :user_id 
            AND code = :code 
            AND is_used = FALSE 
            AND expires_at > NOW() 
            ORDER BY created_at DESC 
            LIMIT 1");
        
        $stmt->execute([
            'user_id' => $userId,
            'code' => $code
        ]);

        $verification = $stmt->fetch();

        if ($verification) {
            // Marquer le code comme utilisé
            $updateStmt = $mysqlClient->prepare("UPDATE verification_codes SET is_used = TRUE WHERE id = :id");
            $updateStmt->execute(['id' => $verification['id']]);

            // Finaliser la connexion
            $_SESSION['LOGGED_USER'] = $_SESSION['PENDING_USER'];
            unset($_SESSION['PENDING_USER']);

            // Rediriger selon le niveau de l'utilisateur
            if ($_SESSION['LOGGED_USER']['email'] == "franckdjk@gmail.com") {
                redirectToUrl('admin.php');
            } else {
                redirectToUrl('profil.php');
            }
        } else {
            $_SESSION['VERIFICATION_ERROR'] = 'Code invalide ou expiré';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/LOGO_IAI.jpg" />
    <title>Vérification - PGE-IAI</title>
    <script src="assets/config/tailwindcss.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="min-h-screen flex items-center justify-center">
        <section class="w-full max-w-md">
            <div class="flex flex-col items-center justify-center px-6 py-8">
                <a href="#" class="flex items-center mb-6 text-2xl font-bold text-black">
                    <img class="w-12 h-12 mr-2" src="assets/images/LOGO_IAI.jpg" alt="logo">
                    IAI Student Management Platform    
                </a>
                <div class="w-full bg-white/90 backdrop-blur-sm rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800/90 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Vérification du code
                        </h1>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Un code de vérification a été envoyé à votre adresse email. Veuillez le saisir ci-dessous.
                        </p>
                        <form class="space-y-4 md:space-y-6" method="POST" action="">
                            <div>
                                <label for="code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code de vérification</label>
                                <input type="text" name="code" id="code" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Entrez le code à 6 chiffres" required="">
                            </div>
                            <button type="submit" name="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Vérifier</button>
                            
                            <?php if (isset($_SESSION['VERIFICATION_ERROR'])): ?>
                                <div class="bg-red-100 rounded p-3 text-center text-red-700">
                                    <?php 
                                    echo $_SESSION['VERIFICATION_ERROR'];
                                    unset($_SESSION['VERIFICATION_ERROR']);
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