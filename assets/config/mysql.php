<?php

const MYSQL_HOST = 'localhost';
const MYSQL_PORT = 3306;
const MYSQL_NAME = 'users_base1';
const MYSQL_USER = 'root';
const MYSQL_PASSWORD = '';

// Création de la table verification_codes si elle n'existe pas
// $mysqlClient->exec("CREATE TABLE IF NOT EXISTS verification_codes (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     user_id INT NOT NULL,
//     code VARCHAR(6) NOT NULL,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     expires_at TIMESTAMP DEFAULT (CURRENT_TIMESTAMP + INTERVAL 15 MINUTE),
//     is_used BOOLEAN DEFAULT FALSE,
//     FOREIGN KEY (user_id) REFERENCES users(id_user)
// )");