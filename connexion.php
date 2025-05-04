<?php 
session_start();

require_once(__DIR__ . '/assets/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/function.php');

/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */
$postData = $_POST;

// Vérification du formulaire soumis
if (isset($postData['submit'])) {
    if (
        empty($postData['email'])
        || empty($postData['password'])
    ) {
        $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Veuillez remplir tous les champs';
    } else {
        $email = $postData['email'];  
        $password = $postData['password'];

        $stmt1 = $mysqlClient->prepare("SELECT * FROM `users` WHERE email = :email");
        $stmt1->execute(['email' => $email]);

        $user = $stmt1->fetch();

        if ($user) {
            if (sha1($password) == $user['password']) {
                // Générer un code de vérification
                $verificationCode = sprintf("%06d", mt_rand(0, 999999));
                
                // Stocker le code dans la base de données
                $stmt2 = $mysqlClient->prepare("INSERT INTO verification_codes (user_id, code) VALUES (:user_id, :code)");
                $stmt2->execute([
                    'user_id' => $user['id'],
                    'code' => $verificationCode
                ]);

                // Envoyer le code par email
                $to = $email;
                $subject = "Code de vérification";
                $message = "Votre code de vérification est : " . $verificationCode;
                $headers = "From: noreply@votresite.com";

                mail($to, $subject, $message, $headers);

                // Stocker les informations de l'utilisateur en session pour la vérification
                $_SESSION['PENDING_USER'] = [
                    'email' => $email,
                    'user_id' => $user['id'],
                    'niveau' => $user['niveau'],
                ];

                // Rediriger vers la page de vérification
                redirectToUrl('verification.php');
            } else {
                $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Mot de passe incorrect.';
                redirectToUrl('index.php');
            }
        } else {
            $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Nous ne trouvons pas votre compte.';
            redirectToUrl('index.php');
        }
    }
}