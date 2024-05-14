<?php

session_start();

require_once (__DIR__ . "/functions/authentication.php");
require_once (__DIR__ . "/functions/route.php");

if (isLogged()) {
  redirect("index.php");
}

if (isset($_POST['username'])) {
  $result = register($_POST['username'], $_POST['password'], $_POST['confirm_password']);
  if ($result) {
    redirect("login.php");
  } else {
    redirect("register.php?pesan=gagal");
  }
}

$title = "register";
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
  <div class="card shadow-lg" style="max-width: 300px">
    <h5 class="card-header text-white" style="background-color: #F79B95">Register</h5>
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
          <label for="input-confirm-password" class="form-label">konfirmasi password</label>
          <input type="password" name="confirm_password" id="input-confirm-password" class="form-control">
        </div>
        <button type="submit" class="btn text-white" style="background-color: #F3635A">register</button>
        <p class="pt-3" style="font-size: 12px;">Sudah memiliki akun? klik <a href="login.php">login</a></p>
      </form>
    </div>
  </div>
</section>

<?php
include (__DIR__ . "/components/footer.php");
?>