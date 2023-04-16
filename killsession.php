<?php
require_once 'vendor/autoload.php';

use App\Session;
use App\Utils;

$session = new Session();
$session->addErrorFlash("Pas Bravo");
Utils::redirect('index.php');
