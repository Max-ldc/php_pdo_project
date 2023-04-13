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
        $query = "INSERT INTO tournament VALUES(null, :name, :game, :nbTeam);";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(
            [
                'name' => $tourn->getName(),
                'game' => $tourn->getGame(),
                'nbTeam' => $tourn->getNbTeam()
            ]
        );
        return ($stmt !== false);
    }

    public function list(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM tournament;');
        $tournaments = $stmt->fetchAll();
        return $tournaments;
    }

    public function getTournById(int $id): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM tournament WHERE id = :id;');
        $stmt->execute( ['id' => $id] );
        $tourn = $stmt->fetch();
        return ($tourn === false) ? [] : $tourn;
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
        return ($stmt !== false);
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
        return ($stmt !== false);
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
    
    public function lastCreatedId(): int
    {
        $stmt = $this->pdo->query("SELECT id FROM tournament ORDER BY id DESC LIMIT 1");
        $row = $stmt->fetch();
        return $row['id'];
    }
}
