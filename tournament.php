<?php
require_once 'vendor/autoload.php';

use App\Crud\GameCrud;
use App\Crud\TeamCrud;
use App\Crud\TournamentCrud;
use App\Entities\Game;
use App\Session;
use App\Utils;

$session = new Session();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $session->addErrorFlash("Recherche incorrecte");
    Utils::redirect('index.php');
}
$idTourn = $_GET['id'];

require 'config/pdo.php';
$tournsDB = new TournamentCrud($pdo);
$tournament = $tournsDB->getTournById($idTourn);
// Si l'id n'est pas trouvé dans la BDD, on redirige vers l'index avec un message d'erreur:
if (empty($tournament)) {
    $session->addErrorFlash("Erreur : tournoi introuvable");
    http_response_code(404);
    Utils::redirect('index.php');
}

require_once 'layout/header.php';

// Infos du tournoi :
?>
<div class="container">
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
        // on récupère les 2 équipes et le gagnant s'il y en a un, pour créer un match
        $teamA = $teamCrud->getTeamById($game['teamA']);
        $teamB = $teamCrud->getTeamById($game['teamB']);
        $winner = (isset($game['teamWin'])) ? $teamCrud->getTeamById($game['teamWin']) : null;
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
