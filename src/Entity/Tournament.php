<?php

namespace App\Entity;

class Tournament
{
    public function __construct(
        private string $name,
        private string $game,
        private int $nb_team,
        private ?int $id = null
    ) {
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
}
