<?php

session_start();

require_once (__DIR__ . "/functions/authentication.php");
require_once (__DIR__ . "/functions/route.php");

if (isLogged()) {
  redirect("index.php");
}

if (isset($_POST['username'])) {
  $result = loginAttempt($_POST['username'], $_POST['password'], isset($_POST['remember']) ? true : false);
  if ($result) {
    redirect("index.php");
  } else {
    redirect("login.php?pesan=gagal");
  }
}

$title = "login";
include (__DIR__ . "/components/header.php");

if (isset($_GET['pesan'])) {
  if ($_GET['pesan'] == "gagal") {
    ?>
    <script>
      alert('Login gagal username dan password salah!')
    </script>
    <?php
  } else if ($_GET['pesan'] == "logout") {
    ?>
      <script>
        alert('Anda telah berhasil logout')
      </script>
    <?php
  } else if ($_GET['pesan'] == "belum_login") {
    ?>
        <script>
          alert('Anda harus login untuk mengakses halaman admin')
        </script>
    <?php

  }
}
?>

<section class="min-vh-100 vw-100 d-flex justify-content-center align-items-center">
  <div class="card" style="max-width: 300px">
    <h5 class="card-header text-white" style="background-color: #F79B95">Login</h5>
    <div class="card-body">
      <form method="post">
        <div class="mb-3">
          <label for="input-username" class="form-label">username</label>
          <input type="text" name="username" id="input-username" class="form-control" autofocus>
        </div>
        <div class="mb-3">
          <label for="input-password" class="form-label">password</label>
          <input type="password" name="password" id="input-password" class="form-control">
        </div>
        <div class="mb-3">
          <input type="checkbox" name="remember" id="remember">
          <label for="remember" class="form-label">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <p class="pt-3" style="font-size: 12px;">Saya belum memiliki akun? klik <a href="register.php">register</a></p>
      </form>
    </div>
  </div>
</section>

<?php
include (__DIR__ . "/components/footer.php");
?>