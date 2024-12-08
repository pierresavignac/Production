<?php
// Paramètres de connexion à la base de données
$db_host = 'localhost';  // L'hôte de la base de données
$db_name = 'vivreenl_production';  // Le nom de la base de données
$db_user = 'vivreenl_user';  // L'utilisateur de la base de données
$db_pass = 'Vl2023!';  // Le mot de passe de la base de données

// Création de la connexion
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Vérification de la connexion
if ($conn->connect_error) {
    error_log("Erreur de connexion MySQL: " . $conn->connect_error);
    die("Erreur de connexion à la base de données: " . $conn->connect_error);
}

// Configuration du jeu de caractères
$conn->set_charset("utf8mb4");

// Définition du fuseau horaire
date_default_timezone_set('America/Toronto');
?> 