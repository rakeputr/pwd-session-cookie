<?php

session_start();

require_once (__DIR__ . "/functions/route.php");
require_once (__DIR__ . "/functions/authentication.php");

if (isLogged()) {
  session_destroy();
}

redirect("login.php?logout");
?>