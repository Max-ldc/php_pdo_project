<?php
require_once 'config/pdo.php';
// Je sélectionne tous les tournois de ma BDD pour les afficher en page d'accueil
$stmt = $pdo->query('SELECT * FROM tournament');
$tournaments = $stmt->fetchAll();

require_once 'layout/header.php';
?>

<section class="container mt-4">
    <a href="createtourn.php" class="mt-2"><button type="button" class="btn btn-info">Créer un tournoi</button></a>
</section>

<section class="tournlist container mt-4">
    <h1>Les tournois créés</h1>
    <div class="row mt-5">
        <?php foreach ($tournaments as $tournament) { ?>
            <a href="tournament.php?id=<?php echo $tournament['id']?>" class="card text-center col-6 col-md-4 col-lg-3">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $tournament['name'] ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $tournament['game'] ?></h6>
                    <p class="card-text">Nombre d'équipes : <?php echo $tournament['nb_equipe']?></p>
                </div>
            </a>
        <?php } ?>
    </div>
</section>
<?php

require_once 'layout/footer.php';