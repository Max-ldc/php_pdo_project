<?php

namespace App\Entities;

class Team
{
    public function __construct(
        private string $name
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

    // créer méthode pour ajouter une team dans la BDD
}
