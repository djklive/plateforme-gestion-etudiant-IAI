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
        || empty($postData['user_type'])
    ) {
        $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Veuillez remplir tous les champs';
        redirectToUrl('index.php');
    } else {
        $email = $postData['email'];  
        $password = $postData['password'];
        $userType = $postData['user_type'];

        // Sélectionner la table appropriée en fonction du type d'utilisateur
        $table = '';
        $idField = '';
        switch($userType) {
            case 'student':
                $table = 'student';
                $idField = 'idetu';
                break;
            case 'professor':
                $table = 'professeur';
                $idField = 'idprofesseur';
                break;
            case 'admin':
                $table = 'admin';
                $idField = 'idadmin';
                break;
            default:
                $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Type d\'utilisateur invalide';
                redirectToUrl('index.php');
                return;
        }

        // Vérifier les identifiants dans la table appropriée
        $stmt = $mysqlClient->prepare("SELECT * FROM `$table` WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            if (sha1($password) == $user['motdepasse']) {
                // Générer un code de vérification
                $verificationCode = sprintf("%06d", mt_rand(0, 999999));
                
                // Stocker le code dans la base de données
                $stmt2 = $mysqlClient->prepare("INSERT INTO verification_codes (user_id, user_type, code) VALUES (:user_id, :user_type, :code)");
                $stmt2->execute([
                    'user_id' => $user[$idField],
                    'user_type' => $userType,
                    'code' => $verificationCode
                ]);

                // Envoyer le code par email
                $to = $email;
                $subject = "Code de vérification";
                $message = "Votre code de vérification est : " . $verificationCode;
                $headers = "From: noreply@iai.com";

                mail($to, $subject, $message, $headers);

                // Stocker les informations de l'utilisateur en session pour la vérification
                $_SESSION['PENDING_USER'] = [
                    'email' => $email,
                    'user_id' => $user[$idField],
                    'user_type' => $userType,
                    'role' => $user['role']
                ];

                // Rediriger vers la page de vérification
                redirectToUrl('verification.php');
            } else {
                $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Mot de passe incorrect';
                redirectToUrl('index.php');
            }
        } else {
            $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Nous ne trouvons pas votre compte';
            redirectToUrl('index.php');
        }
    }
}