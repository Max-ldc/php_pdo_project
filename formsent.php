<?php

require_once 'vendor/autoload.php';

use App\Crud\GameCrud;
use App\Crud\TeamCrud;
use App\Crud\TournamentCrud;
use App\Entities\Team;
use App\Entities\Tournament;
use App\Utils;

require_once 'config/pdo.php';

session_start();
var_dump($_SESSION);
var_dump($_POST);

if (!isset($_SESSION['trnName']) || !isset($_SESSION['trnGame']) || !isset($_SESSION['nbTeam'])) {
    Utils::redirect('createtourn.php');
}

try {
    // On créé un tournoi avec les données dans $_POST
    $tourn = new Tournament($_SESSION['trnName'], $_SESSION['trnGame'], intval($_SESSION['nbTeam']));
    $crudTourn = new TournamentCrud($pdo);
    // $crudTourn->create($tourn);
    // On récupère l'id du tournoi créé, pour la création des matchs
    $idTourn = $crudTourn->lastCreatedId();

    // On veut créer toutes les teams dans la BDD. 
    $crudTeam = new TeamCrud($pdo);
    // Pour l'étape suivante, il nous faudra un tableau avec les ID de toutes les teams créées
    $createdTeams = [];

    foreach ($_POST as $teamName) { // Pour chaque team dans $_POST
        $team = new Team($teamName);
        // var_dump($crudTeam->create($team)); // création dans la BDD

        // $createdTeams[] = $crudTeam->lastCreatedId(); // mise de l'id de l'équipe créée dans un tableau
    }
    $createdTeams = [9, 10, 11, 12];
    var_dump($createdTeams);

    // Il faut maintenant créer les matchs aléatoirement
    $crudGame = new GameCrud($pdo);
    // $crudGame->createFirstRound($createdTeams, $idTourn);
    // var_dump($crudGame->listOfTournMatches($idTourn));
} catch (Exception $e) {
    echo $e->getMessage();
}
