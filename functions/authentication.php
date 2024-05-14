<?php

require_once(__DIR__ . "/connection.php");

function loginAttempt(string $username, string $password, bool $remember): bool
{
  $connection = getConnection();
  $user = $connection->query("SELECT * FROM user WHERE username='$username' AND password='$password'");

  $result = $user->fetch_object();

  if (!$result) {
    return false;
  }

  if ($remember) {
    setcookie('id', $result->id, time() + 3600);
    setcookie('key', hash('sha256', $result->username), time() + 3600);
  }

  $_SESSION['id'] = $result->id;
  $_SESSION['username'] = $result->username;
  $_SESSION['login'] = true;

  if (!$result) {
    return false;
  }


  return true;
}
function isLogged(): bool
{
  if ((isset($_COOKIE['id']) && isset($_COOKIE['key'])) && !isset($_SESSION['login'])) {
    $connection = getConnection();
    $user = $connection->query("SELECT username FROM user WHERE id='" . $_COOKIE['id'] . "'")->fetch_object();

    if (!$user) {
      return false;
    }

    if ($_COOKIE['key'] != hash('sha256', $user->username)) {
      return false;
    }

    $_SESSION['login'] = true;
  }

  if (isset($_SESSION['login'])) {
    return true;
  }

  return false;
}

function logout(): void
{
  setcookie('id', "", time() - 3600);
  setcookie('key', "", time() - 3600);
  session_destroy();
}

