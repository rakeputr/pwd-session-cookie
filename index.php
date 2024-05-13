<?php

session_start();

require_once (__DIR__ . "/functions/authentication.php");

if (!isLogged()) {
  require_once (__DIR__ . "/functions/route.php");
  redirect("login.php?belum_login");
}

$title = "home";

include (__DIR__ . "/components/header.php");

?>
<h1>hello <?= $_SESSION['username'] ?></h1>
<a href="logout.php">logout</a>

<?php include (__DIR__ . "/components/footer.php"); ?>