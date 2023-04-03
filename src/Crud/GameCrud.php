<?php

namespace App\Crud;

use App\Entities\Game;
use App\Entities\Tournament;
use PDO;

class TournamentCrud
{
    public function __construct(private PDO $pdo)
    {
    }

    public function create(Game $game)
    {
        $query = "INSERT INTO users VALUES(:teamA, :teamB, :winTeam);";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(
            [
                'teamA' => $game->getTeamA(),
                'teamB' => $game->getTeamB(),
                'winTeam' => $game->getWinnerTeam()
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
}
