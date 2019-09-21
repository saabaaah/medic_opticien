<?php
// configuration de la base de données //
$dbConfig = [
    'host' => '127.0.0.1:3306',
    'username' => 'dexpriaaa',
    'password' => '36Ro0e',
    'name' => 'dexpriaa'
];
$bdd = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['name']);
if ($bdd->connect_error) {
    die("Probleme de connexion: " . $bdd->connect_error);
} 

// lancer une session //
session_start();

?>