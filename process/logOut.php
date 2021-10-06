<?php

session_start();
include_once "../process/url.php";

// limpando todas as sessões

unset($_POST);
unset($_SESSION);
unset($_GET);

header("Location:" . $url);
exit;