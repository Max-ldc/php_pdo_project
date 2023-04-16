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

    public function addErrorFlash($msg): void
    {
        $_SESSION['errorFlash'] = $msg;
    }

    public function hasErrorFlash(): bool
    {
        return array_key_exists('errorFlash', $_SESSION);
    }

    public function addSuccessFlash($msg): void
    {
        $_SESSION['successFlash'] = $msg;
    }

    public function hasSuccessFlash(): bool
    {
        return array_key_exists('successFlash', $_SESSION);
    }

    public function consumeFlash(): string
    {
        if (!$this->hasErrorFlash() && !$this->hasSuccessFlash()) {
            return '';
        }
        $flash = $_SESSION['errorFlash'] ?? $_SESSION['successFlash'];
        unset($_SESSION['errorFlash']);
        unset($_SESSION['successFlash']);
        return $flash;
    }
}
