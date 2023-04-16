<?php

require_once 'vendor/autoload.php';
require_once 'config/pdo.php';

use App\Crud\TournamentCrud;
use App\Session;

$session = new Session();

// Je sélectionne tous les tournois de ma BDD pour les afficher en page d'accueil
$tournamentsDB = new TournamentCrud($pdo);
$tournaments = $tournamentsDB->list();

require_once 'layout/header.php';
?>
<section class="container mt-4">
    <?php
    if ($session->hasSuccessFlash()) { ?>
        <div class="alert alert-success mt-3">
            <?php echo $session->consumeFlash(); ?>
        </div>
    <?php } else if ($session->hasErrorFlash()) { ?>
        <div class="alert alert-danger mt-3">
            <?php echo $session->consumeFlash(); ?>
        </div>
    <?php } ?>

    <a href="createtourn.php" class="mt-2"><button type="button" class="btn btn-info">Créer un tournoi</button></a>
</section>

<section class="tournlist container mt-4">
    <h1>Les tournois créés</h1>
    <div class="row mt-5 gap-1">
        <?php foreach ($tournaments as $tournament) { ?>
            <a href="tournament.php?id=<?php echo $tournament['id'] ?>" class="card text-center col-6 col-md-4 col-lg-3">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $tournament['name'] ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $tournament['game'] ?></h6>
                    <p class="card-text">Nombre d'équipes : <?php echo $tournament['nb_equipe'] ?></p>
                </div>
            </a>
        <?php } ?>
    </div>
</section>
<?php

require_once 'layout/footer.php';
