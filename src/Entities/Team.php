<?php

namespace App\Entities;

class Team
{
    public function __construct(
        private string $name,
        private ?int $id = null
    ) {
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    // créer méthode pour ajouter une team dans la BDD
}
