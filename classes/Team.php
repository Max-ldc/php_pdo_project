<?php

class Team
{
    private string $name;

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
