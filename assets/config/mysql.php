<?php

const MYSQL_HOST = 'localhost';
const MYSQL_PORT = 3306;
const MYSQL_NAME = 'PGE';
const MYSQL_USER = 'root';
const MYSQL_PASSWORD = '';

// try {
//     $mysqlClient = new PDO(
//         sprintf("mysql:host=%s;port=%s;dbname=%s;charset=utf8", MYSQL_HOST, MYSQL_PORT, MYSQL_NAME),
//         MYSQL_USER,
//         MYSQL_PASSWORD
//     );
//     $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     // Création de la table verification_codes si elle n'existe pas
//     $mysqlClient->exec("CREATE TABLE IF NOT EXISTS verification_codes (
//         id INT AUTO_INCREMENT PRIMARY KEY,
//         user_id INT NOT NULL,
//         user_type ENUM('student', 'professor', 'admin') NOT NULL,
//         code VARCHAR(6) NOT NULL,
//         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//         expires_at TIMESTAMP DEFAULT (CURRENT_TIMESTAMP + INTERVAL 15 MINUTE),
//         is_used BOOLEAN DEFAULT FALSE
//     )");

// } catch(PDOException $e) {
//     die('Erreur : ' . $e->getMessage());
// }