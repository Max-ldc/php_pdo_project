<?php

namespace App\Crud;

use App\Entities\Tournament;
use PDO;

class TournamentCrud
{
    public function __construct(private PDO $pdo)
    {
    }

    public function create(Tournament $tourn)
    {
        $query = "INSERT INTO users VALUES(null, :name, :game, :nbTeam);";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(
            [
                'name' => $tourn->getName(),
                'game' => $tourn->getGame(),
                'nbTeam' => $tourn->getNbTeam()
            ]
        );
    }

    public function list(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM tournament;');
        $tournaments = $stmt->fetchAll();
        return $tournaments;
    }

    public function updateName(int $id, string $name)
    {
        $stmt = $this->pdo->prepare('UPDATE tournament SET name = :name WHERE id = :id;');
        $stmt->execute(
            [
                'name' => $name,
                'id' => $id
            ]
        );
    }

    public function updateGame(int $id, string $game)
    {
        $stmt = $this->pdo->prepare('UPDATE tournament SET name = :game WHERE id = :id;');
        $stmt->execute(
            [
                'game' => $game,
                'id' => $id
            ]
        );
    }

    public function updateNbTeam(int $id, int $nbTeam): bool
    {
        $stmt = $this->pdo->prepare('UPDATE tournament SET name = :nbTeam WHERE id = :id;');
        $stmt->execute(
            [
                'nbTeam' => $nbTeam,
                'id' => $id
            ]
        );
        return ($stmt !== false);
    }

    public function delete(int $id): bool
    {
        // On exécute la suppression et on retourne si elle s'est bien executée ou non
        $stmt = $this->pdo->query('DELETE FROM tournament WHERE id = ' . $id);
        return ($stmt !== false);
    }
}
