<?php
require_once 'vendor/autoload.php';

use App\Crud\GameCrud;
use App\Crud\TournamentCrud;
use App\Entities\Tournament;

if (!isset($_GET['id']) || empty($_GET['id'])) {
    exit('Recherche incorrecte');
}
$idTourn = $_GET['id'];

require 'config/pdo.php';
$tournsDB = new TournamentCrud($pdo);
$tournament = $tournsDB->getTournById($idTourn);

require_once 'layout/header.php';

if (empty($tournament)) { ?>
    <h3 class="ms-5 mt-3">Tournoi introuvable</h3>
    <a href="index.php" class="ms-5 mt-2"><button type="button" class="btn btn-info">Accueil</button></a>
    <?php http_response_code(404);
    exit;
}

$trn = new Tournament(
    $tournament['name'],
    $tournament['game'],
    $tournament['nb_equipe'],
    $tournament['id']
);

echo $trn->getName() . '<br/>';
echo $trn->getGame();
$matchs = new GameCrud($pdo);
var_dump($matchs->listOfTournMatches($idTourn));
?>

<a href="index.php" class="ms-5 mt-2"><button type="button" class="btn btn-info">Accueil</button></a>

<?php
require_once 'layout/footer.php';
