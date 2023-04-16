<?php

require_once 'vendor/autoload.php';

use App\Session;
use App\Utils;

$session = new Session();

if ((empty($_POST) || !isset($_POST['trnName']) || !isset($_POST['trnGame']) || !Utils::isPowerOfTwo($_POST['nbTeam']))) {
    $session->addErrorFlash("Veuillez correctement renseigner tous les champs");
    Utils::redirect('createtourn.php');
}

[
    'trnName' => $trnName,
    'trnGame' => $trnGame,
    'nbTeam' => $nbTeam
] = $_POST;
$_SESSION['trnName'] = $trnName;
$_SESSION['trnGame'] = $trnGame;
$_SESSION['nbTeam'] = $nbTeam;

require_once 'layout/header.php';
?>

<section class="container mt-3">
    <h6 class="d-inline">Nom du tournoi : </h6>
    <h6 class="d-inline"><?php echo $trnName ?></h6>
</section>

<section class="frm container">
    <form action="formsent.php" method="post" class="">
        <div class="row my-3">
            <?php for ($i = 1; $i <= $nbTeam; $i++) { ?>
                <div class="d-flex flex-column col-6 col-md-4 col-lg-3 flex-wrap">
                    <label for="teamName">Nom d'équipe <?php echo $i ?></label>
                    <input type="text" name="<?php echo 'teamName' . $i ?>" required>
                </div>
            <?php } ?>
        </div>
        <input type="submit" value="Envoyer" class="btn btn-dark col-auto">
    </form>
    <a href="killsession.php">
        <button type="button" class="btn btn-danger">Kill Session</button>
    </a>
</section>