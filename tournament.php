<?php
require_once 'vendor/autoload.php';

use App\Crud\GameCrud;
use App\Crud\TeamCrud;
use App\Crud\TournamentCrud;
use App\Entities\Game;

if (!isset($_GET['id']) || empty($_GET['id'])) {
    exit('Recherche incorrecte');
}
$idTourn = $_GET['id'];

require 'config/pdo.php';
$tournsDB = new TournamentCrud($pdo);
$tournament = $tournsDB->getTournById($idTourn);

require_once 'layout/header.php';
?>

<div class="container">

    <?php
    if (empty($tournament)) { ?>
        <h3 class="mt-3">Tournoi introuvable</h3>
        <a href="index.php" class="mt-2"><button type="button" class="btn btn-info">Accueil</button></a>
    <?php http_response_code(404);
        exit;
    }

    // Infos du tournoi :
    ?>
    <h3 class="mt-3">Tournoi : <?php echo $tournament->getName(); ?></h3>
    <h5 class="mt-3"> <?php echo $tournament->getGame(); ?> </h5>

    <h3 class="mt-3">Les matchs :</h3>
    <?php
    // On récupère les matchs sous forme d'un tableau de tableaux associatifs
    $gameCrud = new GameCrud($pdo);
    $teamCrud = new TeamCrud($pdo);
    $games = $gameCrud->listOfTournMatches($idTourn);
    // Pour chaque game on veut afficher le nom de chaque équipe, et changer le visuel si il y a déjà un vainqueur
    foreach ($games as $game) {
        $teamA = $teamCrud->getTeamById($game['teamA']);
        $teamB = $teamCrud->getTeamById($game['teamB']);
        $winner = (isset($game['teamWin'])) ? $teamCrud->getTeamById($game['teamWin']) : null;
        $match = new Game(
            $teamA,
            $teamB,
            $winner
        );
    ?>
        <div class="card my-3 col-4 col-md-3 col-lg-2">
            <ul class="list-group list-group-flush text-center">
                <!-- On affiche les 2 noms d'équipes, sans fond s'il n'y a pas de vainqueurs, sinon : fond vert pour le gagnant et rouge pour le perdant -->
                <li class="list-group-item <?php echo (($winner === null) ? "" : (($winner == $teamA) ? "bg-success" : "bg-danger")) ?>"> <?php echo $teamA->getName() ?> </li>
                <li class="list-group-item <?php echo (($winner === null) ? "" : (($winner == $teamB) ? "bg-success" : "bg-danger")) ?>"> <?php echo $teamB->getName() ?> </li>
            </ul>
        </div>
    <?php } ?>

    <a href="index.php" class="mt-2"><button type="button" class="btn btn-info">Accueil</button></a>

</div>

<?php
require_once 'layout/footer.php';
