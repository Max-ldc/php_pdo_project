<?php

namespace App\Crud;

use App\Entities\Game;
use App\Utils;
use PDO;

class GameCrud
{
    public function __construct(private PDO $pdo)
    {
    }

    public function create(Game $game, int $idTourn)
    {
        $query = "INSERT INTO game VALUES(null, :idTourn, :teamA, :teamB, null, CURRENT_TIME());";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(
            [
                'idTourn' => $idTourn,
                'teamA' => $game->getTeamAId(),
                'teamB' => $game->getTeamBId()
            ]
        );
        // On tente d'exécuter l'insertion et on retourne si elle s'est bien executée ou non
        return ($stmt !== false);
    }

    public function listOfTournMatches(int $id): array
    {
        $stmtMatch = $this->pdo->query("
        SELECT game.id 'game', TA.name 'teamA', TB.name 'teamB'
        FROM game
        LEFT JOIN team `TA` ON game.id_team_A = TA.id
        LEFT JOIN team `TB` ON game.id_team_B = TB.id
        WHERE game.id_tour = $id;
        ");
        $matchs = $stmtMatch->fetchAll();
        return $matchs;
    }

    public function updateWinner(int $idMatch, int $idWinner): bool
    {
        $stmt = $this->pdo->prepare('UPDATE game SET id_team_win = :idWinner WHERE id = :idMatch;');
        $stmt->execute(
            [
                'idWinner' => $idWinner,
                'idMatch' => $idMatch
            ]
        );
        // On tente d'exécuter la modification et on retourne si elle s'est bien executée ou nonx
        return ($stmt !== false);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->query('DELETE FROM game WHERE id = ' . $id);
        // On tente d'exécuter la suppression et on retourne si elle s'est bien executée ou non
        return ($stmt !== false);
    }

    public function createFirstRound(array $createdTeams, int $idTourn): void
    {
        $crudTeam = new TeamCrud($this->pdo);
        while (!empty($createdTeams)) {
            $randKey1 = 0;
            $randKey2 = 0;
            while ($randKey1 === $randKey2) {
                $randKey1 = Utils::randomArrayKey($createdTeams);
                $randKey2 = Utils::randomArrayKey($createdTeams);
            }
            $idTeam1 = $createdTeams[$randKey1];
            $team1 = $crudTeam->getTeamById($idTeam1);
            $idTeam2 = $createdTeams[$randKey2];
            $team2 = $crudTeam->getTeamById($idTeam2);

            $match = new Game($team1, $team2);
            var_dump($match);
            // $this->create($match, $idTourn);
            Utils::removeTwoValues($createdTeams, $randKey1, $randKey2);
            var_dump($createdTeams);
        }
    }
}
