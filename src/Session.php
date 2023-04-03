<?php

namespace App;

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function hasTournCreationInfos()
    {
        // retourne si il y a dans la session des infos d'une création de tournoi
    }

    public function addFlash($msg): void
    {
        $_SESSION['flash'] = $msg;
    }

    public function hasFlash(): bool
    {
        return array_key_exists('flash', $_SESSION);
    }

    public function consumeFlash(): string
    {
        if (!$this->hasFlash()) {
            return '';
        }
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
}
