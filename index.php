<?php

session_start();

require_once (__DIR__ . "/functions/authentication.php");
require_once (__DIR__ . "/functions/connection.php");

if (!isLogged()) {
  require_once (__DIR__ . "/functions/route.php");
  redirect("login.php?pesan=belum_login");
}

$connection = getConnection();

if (isset($_GET['op'])) {
  $op = $_GET['op'];
} else {
  $op = "";
}

if ($op == 'delete') {
  $kode_obat = $_GET['kode'];
  $delete = $connection->query("delete from obat where kode_obat = $kode_obat");
  if ($delete) {
    header("Location: index.php?status=success&message=Berhasil Hapus Data");
  } else {
    header("Location: index.php?status=danger&message=Gagal Hapus Data");
  }
}

$title = "home";

include (__DIR__ . "/components/header.php");

?>

<div style="background-color: #FADFDB">
  <section class="d-flex justify-content-center align-items-center min-vh-100 flex-column">
    <header class="mx-auto my-4">
      <?php if (isset($_GET['message'])): ?>
        <div id="notification" class="alert alert-<?= $_GET['status'] ?> text-center" role="alert">
          <?= $_GET['message'] ?>
        </div>
      <?php endif ?>

      <!-- <h2>Tugas Crud PHP & MySQL</h2> -->
    </header>

    <div class="mx-auto d-flex justify-content-between">
      <a class="btn shadow-lg text-white ml-auto" style="background-color: #F3635A" href="create.php">Insert Data</a>
      <a class="btn shadow-lg text-white mr-auto" style="background-color: #F3635A" href="logout.php">Logout</a>
    </div>

    <div class="mx-auto">
      <!-- untuk mengeluarkan data -->
      <div class="card shadow-lg">
        <div class="card-header text-white" style="background-color: #F79B95">
          Data Mahasiswa
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Kode</th>
                <th scope="col">Nama Obat</th>
                <th scope="col">Stok</th>
                <th scope="col">Tgl Expired</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $medicines = $connection->query("SELECT * FROM obat");
              $urut = 1;
              while ($medicine = $medicines->fetch_object()) {
                ?>
                <tr>
                  <th scope="row">
                    <?php echo $urut++ ?>
                  </th>
                  <td scope="row">
                    <?php echo $medicine->kode_obat ?>
                  </td>
                  <td scope="row">
                    <?php echo $medicine->nama_obat ?>
                  </td>
                  <td scope="row">
                    <?php echo $medicine->stok ?>
                  </td>
                  <td scope="row">
                    <?php echo $medicine->tgl_exp ?>
                  </td>
                  <td scope="row">
                    <a href="edit.php?kode=<?php echo $medicine->kode_obat ?>"><button type="button"
                        class="btn text-white" style="background-color: #F77870">Edit</button></a>
                    <a href="index.php?op=delete&kode=<?php echo $medicine->kode_obat ?>"
                      onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn text-white"
                        style="background-color: #D93043">Delete</button></a>
                  </td>
                </tr>
                <?php
              }
              ?>
            </tbody>

          </table>
        </div>
      </div>
    </div>
  </section>
</div>


<?php include (__DIR__ . "/components/footer.php"); ?>