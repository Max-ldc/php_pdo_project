<?php

session_start();

require_once 'functions.php';
require_once 'layout/header.php';

var_dump($_SESSION);
?>

<section class="frm container">
    <form action="" method="post" class="d-flex flex-column">
    <?php
    if (empty($_POST) && !isset($_POST['trnName']))
    {
    ?>
        <div class="my-2 d-flex flex-column">
            <label for="trnName">Nom du tournoi</label>
            <input type="text" name="trnName" class="col-2" required value="<?php echo $_SESSION['trnName'] ?? ''; ?>">
        </div>
        <div class="col-auto my-2">
            <label for="nbTeam">Nombre d'équipes : </label>
            <select name="nbTeam" required>
                <option value="4" <?php if ($_SESSION['nbTeam'] === '4') {echo 'selected';} ?>>4</option>
                <option value="8" <?php if ($_SESSION['nbTeam'] === '8') {echo 'selected';} ?>>8</option>
                <option value="16" <?php if ($_SESSION['nbTeam'] === '16') {echo 'selected';} ?>>16</option>
                <option value="32" <?php if ($_SESSION['nbTeam'] === '32') {echo 'selected';} ?>>32</option>
                <option value="64" <?php if ($_SESSION['nbTeam'] === '64') {echo 'selected';} ?>>64</option>
            </select>
        </div>
        <div class="col-auto my-2">
            <input type="submit" value="Suivant" class="btn btn-dark col-auto">
        </div>

    <?php } else {
        ['trnName' => $trnName,
        'nbTeam' => $nbTeam] = $_POST;
        $_SESSION['trnName'] = $trnName;
        $_SESSION['nbTeam'] = $nbTeam;
        var_dump($trnName, $nbTeam);
        var_dump(isPowerOfTwo($nbTeam));


    }
        ?>
    </form>
    <a href="killsession.php">
        <button type="button" class="btn btn-danger">Kill Session</button>
    </a>
</section>