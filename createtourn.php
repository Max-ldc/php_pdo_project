<?php
require_once 'vendor/autoload.php';
use App\Crud\TournamentCrud;

require_once 'config/pdo.php';

$suppTourn = new TournamentCrud($pdo);

if ($suppTourn->delete(2)) {
    echo "Suppression validée";
} else {
    echo "Erreur lors de la suppression";
}
