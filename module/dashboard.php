<?php
  // Kirim Pesan
  if ( isset($_POST['kirim']) ) {
    if ( kirimpesan($_POST) > 0 ) {
      echo "
        <script>
          alert('Berhasil mengirim pesan!');
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Gagal Mengirim Pesan!');
        </script>
      ";
    }
  }

  // Hapus Pesan
  if ( isset($_GET['hapus']) ) {
    if ( hapuspesan($_GET) > 0 ) {
      echo "
        <script>
          alert('Pesan berhasil dihapus!');
          window.location = 'index.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Pesan gagal dihapus!');
          window.location = 'index.php';
        </script>
      ";
    }
  }


  // Menampilkan Informasi Buku di Perpustakaan
$judulbuku = mysqli_query($conn, "SELECT * FROM tblbuku");
$resultjudulbuku = mysqli_num_rows($judulbuku);

$jumlahbuku = mysqli_query($conn, "SELECT SUM(jumlah) AS TOTAL FROM tblbuku ");
$resultjumlahbuku = mysqli_fetch_array($jumlahbuku)[0];

$jenisbuku = mysqli_query($conn, "SELECT COUNT(DISTINCT jenis) AS jenis FROM tblbuku");
$resultjenisbuku = mysqli_fetch_array($jenisbuku)[0];

$penerbitbuku = mysqli_query($conn, "SELECT COUNT(DISTINCT penerbit) AS penerbit FROM tblbuku");
$resultpenerbitbuku = mysqli_fetch_array($penerbitbuku)[0];

$jumlahuser = mysqli_query($conn, "SELECT COUNT(DISTINCT username) AS username FROM tbluser WHERE lvl='User'");
$resultuser = mysqli_fetch_array($jumlahuser)[0];

$pinjambuku = mysqli_query($conn, "SELECT * FROM tblpinjam WHERE status = 'Pending' OR status = 'Dibaca'");
$resultpinjambuku = mysqli_num_rows($pinjambuku);

$pendingbuku = mysqli_query($conn, "SELECT * FROM tblpinjam WHERE status = 'Pending'");
$resultpending = mysqli_num_rows($pendingbuku);

?>

<!--Bagian Dashboard-->

<div class="row">
        <div class="col col-lg-3">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="stats-icon purple">
                                <i class="iconly-boldPaper"></i>
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Jumlah Buku</h6>
                            <h6 class="font-extrabold mb-0"><?= $resultjumlahbuku; ?></h6>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col col-lg-3">
          <div class="card">
            <div class="card-body px-3 py-4-5">
              <div class="row">

                <div class="col-md-4">
                  <div class="stats-icon green">
                    <i class="iconly-boldBookmark"></i>
                  </div>
                </div>

                <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Judul Buku</h6>
                  <h6 class="font-extrabold mb-0"><?= $resultjudulbuku; ?></h6>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="col col-lg-3">
          <div class="card">
            <div class="card-body px-3 py-4-5">
              <div class="row">

                <div class="col-md-4">
                  <div class="stats-icon red">
                    <i class="iconly-boldCategory"></i>
                  </div>
                </div>

                <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Kategori</h6>
                  <h6 class="font-extrabold mb-0"><?= $resultjenisbuku; ?></h6>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="col col-lg-3">
          <div class="card">
            <div class="card-body px-3 py-4-5">
              <div class="row">

                <div class="col-md-4">
                  <div class="stats-icon blue">
                    <i class="iconly-boldSend"></i>
                  </div>
                </div>

                <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Penerbit</h6>
                  <h6 class="font-extrabold mb-0"><?= $resultpenerbitbuku; ?></h6>
                </div>

              </div>
            </div>
          </div>
        </div>
</div>

<?php if ( $datauser["lvl"] === 'Admin' ) : ?>

<div class="row">
    <div class="col col-lg-12">
            <h4>Informasi Anggota & Peminjaman</h4>
    </div>
</div>

<div class="row">
    <div class="col col-lg-4">
        <div class="card">
            <div class="card-body px-3 py-4-5">
              <div class="row">

                <div class="col-md-4">
                  <div class="stats-icon blue">
                    <i class="iconly-boldUser1"></i>
                  </div>
                </div>

                <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Jumlah Anggota</h6>
                  <h6 class="font-extrabold mb-0"><?= $resultuser; ?></h6>
                </div>

              </div>
            </div>
        </div>
    </div>

    <div class="col col-lg-4">
        <div class="card">
            <div class="card-body px-3 py-4-5">
              <div class="row">

                <div class="col-md-4">
                  <div class="stats-icon green">
                    <i class="iconly-boldBag"></i>
                  </div>
                </div>

                <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Dipinjam</h6>
                  <h6 class="font-extrabold mb-0"><?= $resultpinjambuku; ?></h6>
                </div>

              </div>
            </div>
        </div>
    </div>

    <div class="col col-lg-4">
        <div class="card">
            <div class="card-body px-3 py-4-5">
              <div class="row">

                <div class="col-md-4">
                  <div class="stats-icon red">
                    <i class="iconly-boldInfo-Circle"></i>
                  </div>
                </div>

                <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Pending Pinjaman</h6>
                  <h6 class="font-extrabold mb-0"><?= $resultpending; ?></h6>
                </div>

              </div>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>

<?php
  $myuname = $datauser["username"];
  $kueri = query("SELECT * FROM tblpesan WHERE penerima = '$myuname' ORDER BY id DESC");
?>

<div class="container-fluid">
    <div class="row">
      <!-- Pesan -->
      <div class="col-lg-6">
          <div class="card">
              <div class="card-header">
                  <h4>Pesan</h4>
              </div>
              <div class="card-body">
                <div class="card-body px-3 py-4-5">
                  <div class="row">
                    <?php foreach ($kueri as $data) : ?>
                      <?php
                        $id = $data['id'];
                        $judul = $data['judul'];
                        $pengirim = $data['pengirim'];
                        $userpengirim = $data['username'];

                        $queryfoto = mysqli_query($conn, "SELECT * FROM tbluser WHERE username = '$userpengirim'");
                        $foto = mysqli_fetch_array($queryfoto);
                        $fotoprofil = $foto['pict'];
                      ?>
                      <li class="list-group-item">
                      <div class="row">
                      <div class="col-md-2">
                      <a href="?page=tampilpesan&show=&id=<?= $id; ?>&uname=<?= $userpengirim; ?>" class="feed-profile"><div class="avatar avatar-xl"><img src="../assets/images/faces/<?= $fotoprofil; ?>" alt=""></div></a>
                      </div>
                          
                      <div class="col-md-8">
                          <h5><a href="?page=tampilpesan&show=&id=<?= $id; ?>&uname=<?= $userpengirim; ?>"><?= $judul; ?></a></h5>
                          <div>
                          <small><?= $pengirim; ?> - <?= $userpengirim; ?> </small>
                          </div>
                      </div>
                      </div>
                      </li>
                    <?php endforeach; ?>
                        

                  </div>
                </div>
              </div>
          </div>
      </div>

      <!-- Tulis Pesan -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h4>Kirim Pesan</h4>
          </div>
          <div class="card-body">
            <form class="form-horizontal" action="" method="post" class="regi">
              <input type="text" name="nama" value="<?= $datauser['nama']; ?>" hidden>
              <input type="text" name="username" value="<?= $datauser['username']; ?>" hidden>
              <div class="form-group row">
                <div class="col-sm-10">
                  <input class="form-control" type="text" name="judul" placeholder="Masukkan Subject Pesan" required autocomplete="off">
                </div>
                <div class="col-sm-10">
                  <input class="form-control" type="text" name="penerima" placeholder="Masukkan Username Penerima Pesan" required autocomplete="off">
                </div>
                <div class="col-sm-10">
                  <textarea class="form-control" name="pesan"></textarea>
                </div>
              </div>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary" name="kirim">Kirim</button>
                </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
