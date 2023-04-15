<?php

namespace App\Crud;

use App\Entities\Team;
use PDO;

class TeamCrud
{
    public function __construct(private PDO $pdo)
    {
    }

    public function create(Team $team): bool
    {
        $query = "INSERT INTO team VALUES(null, :name);";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(
            [
                'name' => $team->getName(),
            ]
        );
        return ($stmt !== false);
    }

    public function listOfTournTeams(int $id): array
    {
        $stmtTeams = $this->pdo->query(
            "SELECT name FROM team WHERE id IN (
            SELECT id_team_A FROM game WHERE id_tour = $id
            UNION
            SELECT id_team_B FROM game WHERE id_tour = $id
        );"
        );
        // On récupère juste le nom de chaque équipe
        while ($row = $stmtTeams->fetch()) {
            $teams[] = $row->getName();
        }
        return $teams;
    }

    public function updateTeam(int $idTeam, string $name): bool
    {
        $stmt = $this->pdo->prepare('UPDATE team SET name = :name WHERE id = :idTeam;');
        $stmt->execute(
            [
                'name' => $name,
                'idTeam' => $idTeam
            ]
        );
        return ($stmt !== false);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->query('DELETE FROM team WHERE id = ' . $id);
        return ($stmt !== false);
    }

    public function lastCreatedId(): int
    {
        $stmt = $this->pdo->query("SELECT id FROM team ORDER BY id DESC LIMIT 1");
        $row = $stmt->fetch();
        return $row['id'];
    }

    public function getTeamById(int $id): Team
    {
        $stmt = $this->pdo->query("SELECT * FROM team WHERE id = $id");
        $row = $stmt->fetch();
        return new Team($row['name'], $row['id']);
    }
}
