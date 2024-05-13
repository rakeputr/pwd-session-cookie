<?php
session_start();

require_once (__DIR__ . "/functions/connection.php");

$connection = getConnection();

$kode = "";
$nama = "";
$stok = "";
$tgl_exp = "";
$sukses = "";
$error = "";

if (isset($_POST['simpan'])) { //untuk create
  $kode = $_POST['kode'];
  $nama = $_POST['nama'];
  $stok = $_POST['stok'];
  $tgl_exp = $_POST['tgl_exp'];

  if ($kode && $nama && $stok && $tgl_exp) {
    $insert = $connection->query("INSERT INTO obat(kode_obat, nama_obat, stok, tgl_exp) VALUES ($kode, '$nama', $stok, '$tgl_exp')");
    if ($insert) {
      $sukses = "Berhasil memasukkan data baru";
      header("location: index.php?status=success&message=Berhasil Tambah Data");//5 : detik
    } else {
      header("location: index.php?status=danger&message=Gagal Tambah Data");//5 : detik
    }
  } else {
    $error = "Silakan masukkan semua data";
  }
}
$title = "create";

include (__DIR__ . "/components/header.php");

?>

<div style="background-color: #FADFDB">
  <section class="d-flex justify-content-center align-items-center min-vh-100 flex-column">
    <div class="mx-auto">
      <!-- untuk memasukkan data -->
      <div class="card shadow-lg">
        <div class="card-header text-white" style="background-color: #F79B95">
          Create Data
        </div>
        <div class="card-body">
          <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $error ?>
            </div>
          <?php endif; ?>

          <form action="" method="POST">
            <div class="mb-3 row">
              <label for="kode" class="col-sm-2 col-form-label">Kode Obat</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="kode" name="kode" value="<?php echo $kode ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="nama" class="col-sm-2 col-form-label">Nama Obat</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="stok" class="col-sm-2 col-form-label">Stok</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="stok" name="stok" value="<?php echo $stok ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tgl_exp" class="col-sm-2 col-form-label">Tanggal Expired</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" id="tgl_exp" name="tgl_exp" value="<?php echo $tgl_exp ?>">
              </div>
            </div>
            <div class="col-12">
              <a class="btn text-white" style="background-color: #FBAEB4" href="index.php">Kembali</a>
              <input type="submit" name="simpan" value="Simpan Data" class="btn text-white"
                style="background-color: #F3635A" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include (__DIR__ . "/components/footer.php"); ?>