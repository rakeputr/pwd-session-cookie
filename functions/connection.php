<?php
function getConnection()
{
  $connection = null;
  $hostname = "localhost"; //hostname
  $username = "root";
  $password = "";
  $database = "dataapotik";

  try {
    $connection = new mysqli($hostname, $username, $password, $database);
  } catch (Exception $e) {
    die('Maaf koneksi gagal: ' . $e->getMessage());
  }

  return $connection;
}

?>