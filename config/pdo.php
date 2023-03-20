<?php

// chargement de mes paramètres de configuration
$dbConfig = parse_ini_file('db.ini');

[
    'DB_HOST' => $host,
    'DB_PORT' => $port,
    'DB_NAME' => $dbName,
    'DB_CHARSET' => $dbCharset,
    'DB_USER' => $user,
    'DB_PASSWORD' => $password
] = $dbConfig;

$dsn = "mysql:host=$host;port=$port;dbname=$dbName;charset=$dbCharset";

// ATTR_DEFAULT_FETCH_MODE => FETCH_ASSOC = la methode fetch renverra un tableau associatif sans préciser de paramètre
$options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
    die('Une erreur est survenue : ' . $e->getCode() . ' - ' . $e->getMessage());
}