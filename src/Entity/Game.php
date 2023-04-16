<?php

namespace App\Entity;

use App\Entity\Team;

class Game
{
    public function __construct(
        private Team $teamA,
        private Team $teamB,
        private ?Team $win_team = null
    ) {
    }

    public function getTeamAId(): int
    {
        return $this->teamA->getId();
    }
    public function setTeamA(Team $team)
    {
        $this->teamA = $team;
    }

    public function getTeamBId(): int
    {
        return $this->teamB->getId();
    }
    public function setTeamB(Team $team)
    {
        $this->teamB = $team;
    }

    public function getWinnerTeamId(): ?int
    {
        if ($this->win_team !== null) {
            return $this->win_team->getId();
        } else {
            return null;
        }
    }
    public function setWinnerTeam(Team $team)
    {
        $this->win_team = $team;
    }

    // méthode qui teste si un match a un gagnant ou non (retourne false ou l'id du gagnant)

    // méthode qui créé une classe équipe 
}
