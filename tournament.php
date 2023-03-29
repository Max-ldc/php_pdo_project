<?php

if (!isset($_GET['id']) || empty($_GET['id'])) {
    exit('Recherche incorrecte');
}
$idTourn = $_GET['id'];

require 'config/pdo.php';
$stmtTourn = $pdo->prepare("SELECT * FROM tournament WHERE id = :id");
$stmtTourn->execute([
    'id' => $idTourn
]);
$tournament = $stmtTourn->fetch();

require_once 'layout/header.php';

if ($tournament === false) { ?>
    <h3 class="ms-5 mt-3">Tournoi introuvable</h3>
    <a href="index.php" class="ms-5 mt-2"><button type="button" class="btn btn-info">Accueil</button></a>
<?php http_response_code(404);
    exit;
}

require_once 'classes/Tournament.php';

$trn = new Tournament(
    $tournament['id'],
    $tournament['name'],
    $tournament['game'],
    $tournament['nb_equipe']
);

echo $trn->getName() . '<br/>';
echo $trn->getGame();
$matchs = $trn->returnMatches($idTourn);
var_dump($matchs);
?>

<a href="index.php" class="ms-5 mt-2"><button type="button" class="btn btn-info">Accueil</button></a>

<?php
require_once 'layout/footer.php';
