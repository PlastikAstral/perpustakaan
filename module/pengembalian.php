<?php
  $kueri = query("SELECT * FROM tblrequestkembali ORDER BY id ASC");

  // Cek Tombol Search
  if ( isset($_POST["cari"]) ) {
    $kueri = pencarianuser($_POST["keyword"]);
  }

  // Cek Konfirmasi
  if ( isset($_GET["konfirmasi"]) ) {

      if ( konfirmasikembalibuku($_GET) > 0 ) {
      echo "
        <script>
          alert('Buku Telah Di Konfirmasi!');
          window.location = '?page=pengembalian';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Gagal!');
        </script>
      ";
    }
  }

?>

<div class="card">
    <div class="card-header">
        <h5>Konfirmasi Pengembalian</h5>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <form class="input-group" method="post" action="">
                        <input type="text" class="form-control" name="keyword"  <?php if (isset($_POST['keyword'])) {
                            echo "value='$_POST[keyword]'";
                            } ?>  placeholder="Masukan Nama Peminjam" autocomplete="off">
                        <button type="submit" class="btn btn-primary input-group-append" name="cari">Cari</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
              <table class="table table-stripped tabble-sm">
                <thead>
                  <tr>
                    <th>Kode</th>
                    <th>Judul Buku</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Jumlah Pengembalian</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ( $kueri as $data ) : ?>
                        <?php
                        $id = $data["id"];
                        $kode = $data["kode"];
                        $judul = $data["judul"];
                        $nama = $data["nama"];
                        $tanggalpinjam = $data["tanggalpinjam"];
                        $tanggalkembalikan = $data["tanggalkembalikan"];
                        $jmlkembali = $data["jmlkembali"];
                        ?>
                        <tr>
                        <td><?= $kode; ?></td>
                        <td><?= $judul; ?></td>
                        <td><?= $nama; ?></td>
                        <td><?= $tanggalpinjam; ?></td>
                        <td><?= $tanggalkembalikan; ?></td>
                        <td><?= $jmlkembali; ?></td>
                        <td>
                        <a class="btn btn-primary" href="?page=pengembalian&konfirmasi=&id=<?= $id; ?>&kode=<?= $kode; ?>&nama=<?= $nama; ?>&tanggalpinjam=<?= $tanggalpinjam; ?>&tanggalkembalikan=<?= $tanggalkembalikan; ?>&jmlkembali=<?= $jmlkembali; ?>">Konfirmasi</a>
                        </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <table>
        </div>
    </div>
</div>