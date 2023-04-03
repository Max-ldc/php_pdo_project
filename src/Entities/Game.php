<?php

namespace App\Entities;

use App\Entities\Team;

class Game
{
    public function __construct(
        private Team $teamA,
        private Team $teamB,
        private Team $win_team
    ) {
    }

    public function getTeamA()
    {
        return $this->teamA;
    }
    public function setTeamA($team)
    {
        $this->teamA = $team;
    }

    public function getTeamB()
    {
        return $this->teamB;
    }
    public function setTeamB($team)
    {
        $this->teamB = $team;
    }

    public function getWinnerTeam()
    {
        return $this->win_team;
    }
    public function setWinnerTeam($team)
    {
        $this->win_team = $team;
    }

    // méthode qui teste si un match a un gagnant ou non (retourne false ou l'id du gagnant)

    // méthode qui créé une classe équipe 
}
