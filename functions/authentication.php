<?php

require_once (__DIR__ . "/connection.php");

function loginAttempt(string $username, string $password): bool
{
  $connection = getConnection();
  $user = $connection->query("SELECT * FROM user WHERE username='$username' AND password='$password'");

  $result = $user->fetch_object();
  $_SESSION['id'] = $result->id;
  $_SESSION['username'] = $result->username;

  if (!$result) {
    return false;
  }

  return true;
}
function isLogged(): bool
{
  if (!isset($_SESSION['id'])) {
    return false;
  }

  return true;
}

function logout(): void
{
  session_destroy();
}
?>