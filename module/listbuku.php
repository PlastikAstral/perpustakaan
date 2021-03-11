<?php
  $kueri = query("SELECT * FROM tblbuku ORDER BY id DESC");

  $tanggal = Date("Y-m-d");

  // Cek tombol submit pencarian
  if ( isset($_POST["cari"]) ) {
    $kueri = pencarian($_POST["keyword"]);
  }

  // Cek pilihan pinjam buku
  if ( isset($_GET["pinjam"]) ) {

      if ( pinjambuku($_GET) > 0 ) {
      echo "
        <script>
          alert('Terima Kasih sudah meminjam');
          window.location = '?page=listbuku';
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
        <h5>List Buku</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <form class="input-group" method="post" action="">
                    <input type="text" class="form-control" name="keyword" placeholder="Cari Judul Buku" autocomplete="off">
                    <button type="submit" class="btn btn-primary input-group-append" name="cari">Cari</button>
                </form>
            </div>
            <div class="col-md-5">
                <a href="?page=listbuku" class="btn btn-primary">Tampilkan Semua Buku</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">

                        <thead>
                            <tr>
                                <th>KODE</th>
                                <th>JUDUL</th>
                                <th>PENULIS</th>
                                <th>PENERBIT</th>
                                <th>TAHUN</th>
                                <th>JUMLAH</th>
                                <th>JENIS</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ( $kueri as $data ) : ?>
                            <?php
                            $kode = $data["kode"];
                            $judul = $data["judul"];
                            $penulis = $data["penulis"];
                            $penerbit = $data["penerbit"];
                            $jumlah = $data["jumlah"];
                            $jenis = $data["jenis"];
                            $tahun = $data["tahun"];
                            ?>
                                <tr>
                                <td><?= $kode; ?></td>
                                <td><?= $judul; ?></td>
                                <td><?= $penulis; ?></td>
                                <td><?= $penerbit; ?></td>
                                <td><?= $tahun; ?></td>
                                <td><?= $jumlah; ?></td>
                                <td><?= $jenis; ?></td>
                                <td><a class="btn btn-primary" href="?page=listbuku&pinjam=&kode=<?= $kode; ?>&nama=<?= $datauser['nama']; ?>&tanggal=<?= $tanggal; ?>&jumlah=<?= $jumlah; ?>">Pinjam</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

</div>