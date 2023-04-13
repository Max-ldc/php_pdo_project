<?php
require_once 'vendor/autoload.php';

use App\Utils;

Utils::killSession();
Utils::redirect('index.php');
