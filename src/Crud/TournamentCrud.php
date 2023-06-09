<?php

namespace App\Crud;

use App\Entity\Tournament;
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

    public function getTournById(int $id): ?Tournament
    {
        $stmt = $this->pdo->prepare('SELECT * FROM tournament WHERE id = :id;');
        $stmt->execute( ['id' => $id] );
        $tournament = $stmt->fetch();
        if ($tournament === false) {
            return null;
        } else {
            return new Tournament(
                $tournament['name'],
                $tournament['game'],
                $tournament['nb_equipe'],
                $tournament['id']
            );
        }
    }

    public function updateName(int $id, string $name): bool
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

    public function updateGame(int $id, string $game): bool
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
