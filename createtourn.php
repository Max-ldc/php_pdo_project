<?php

require_once 'vendor/autoload.php';

use App\Utils;

session_start();

require_once 'layout/header.php';

var_dump($_SESSION)
?>

<section class="frm container">
    <form action="createteams.php" method="post" class="d-flex flex-column">
        <div class="my-2 d-flex flex-column">
            <label for="trnName">Nom du tournoi</label>
            <input type="text" name="trnName" class="col-2" required value="<?php echo $_SESSION['trnName'] ?? ''; ?>">
        </div>
        <div class="my-2 d-flex flex-column">
            <label for="trnGame">Jeu / Sport</label>
            <input type="text" name="trnGame" class="col-2" required value="<?php echo $_SESSION['trnGame'] ?? ''; ?>">
        </div>
        <div class="col-auto my-2">
            <label for="nbTeam">Nombre d'équipes : </label>
            <select name="nbTeam" required>
                <option value="4" <?php Utils::isSelected(4); ?>>4</option>
                <option value="8" <?php Utils::isSelected(8); ?>>8</option>
                <option value="16" <?php Utils::isSelected(16); ?>>16</option>
                <option value="32" <?php Utils::isSelected(32); ?>>32</option>
                <option value="64" <?php Utils::isSelected(64); ?>>64</option>
            </select>
        </div>
        <div class="col-auto my-2">
            <input type="submit" value="Suivant" class="btn btn-dark col-auto">
        </div>
    </form>
    <a href="killsession.php">
        <button type="button" class="btn btn-danger">Kill Session</button>
    </a>
</section>

<?php

require_once 'layout/footer.php';
