<?php

namespace App;

class Tournament {
    public function __construct(
        private int $id,
        private string $name,
        private string $game,
        private int $nb_team
        ){
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getGame(): string
    {
        return $this->game;
    }

    public function setGame(string $game): void
    {
        $this->game = $game;
    }

    public function getNbTeam(): int
    {
        return $this->nb_team;
    }

    public function setNbTeam(int $nbTeam): void
    {
        $this->nb_team = $nbTeam;
    }

    // Méthode qui va chercher les matchs du tournoi dans la db
    /**
     * return the list of each created tournaments matches with their id and the teams
     * 
     * 
     * @param PDO $pdo
     * @return array
     */
    public function returnMatches($tournID) : array
    {
        require __DIR__ . '/../config/pdo.php';
        $stmtMatch = $pdo->query("
        SELECT game.id 'game', TA.name 'teamA', TB.name 'teamB'
        FROM game
        LEFT JOIN team `TA` ON game.id_team_A = TA.id
        LEFT JOIN team `TB` ON game.id_team_B = TB.id
        WHERE game.id_tour = $tournID;
        ");
        $matchs = $stmtMatch->fetchAll();
        return $matchs;
    }

    // // Méthode qui va chercher toutes les équipes du tournoi :
    // /**
    //  * return an array of the names of all the current tournament teams'
    //  *
    //  * @param PDO $pdo
    //  * @return array
    //  */
    // public function getTeams(): array
    // {
    //     require __DIR__ . '/../config/pdo.php';

    //     $stmtTeams = $pdo->query(
    //         "SELECT name FROM team WHERE id IN (
    //             SELECT id_team_A FROM game WHERE id_tour = 1
    //             UNION
    //             SELECT id_team_B FROM game WHERE id_tour = 1
    //         );"
    //     );
    //     // On créé un objet Team pour chaque ligne trouvée et on récupère le nom grâce au getter
    //     while($row = $stmtTeams->fetchObject('Team')){
    //         $teams[] = $row->getName();
    //     }
    //     return $teams;
    // }

    // Méthode qui ajoute à la DB ?
    // Avec envoi d'erreur si le nom est déjà dans la DB ou si les types demandés ne sont pas les bons ?
    
    // Méthode qui créé les équipes dans la database
    // Méthode qui créé automatiquement les 1ers matchs (nb_equipe/2) du tournoi dans la database
}