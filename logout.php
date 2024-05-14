<?php

session_start();

require_once(__DIR__ . "/functions/route.php");
require_once(__DIR__ . "/functions/authentication.php");

if (isLogged()) {
  logout();
}

redirect("login.php?pesan=logout");

