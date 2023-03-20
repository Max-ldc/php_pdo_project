<?php

require_once 'config/pdo.php';

require_once 'layout/header.php';

$stmt = $pdo->query('SELECT * FROM tournament');

$tournaments = $stmt->fetchAll();
var_dump($tournaments);

// foreach ($tournaments as $tournament) {

// }

require_once 'layout/footer.php';