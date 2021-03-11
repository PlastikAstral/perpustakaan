<?php
  $kueri = query("SELECT * FROM tblbuku ORDER BY id DESC");

  // Cek tombol Submit Tambah Data
  if ( isset($_POST["submit"]) ) {
    if ( tambahbuku($_POST) > 0 ) {
      echo "
        <script>
          alert('Buku Berhasil Ditambah!');
          window.location = '?page=managebuku';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Buku Gagal Ditambahkan! Mungkin Saja kode buku sudah ada');
          window.location  = '?page=managebuku';
        </script>
      ";
    }
  }

  // Cek tombol submit pencarian
  if ( isset($_POST["cari"]) ) {
    $kueri = pencarian($_POST["keyword"]);
  }

?>

<div class="card">
    <div class="card-header">
        <h5>Manajemen Buku</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Tambah Buku</a>
            </div>
            <div class="col-md-4">
                <form class="input-group" method="post" action="">
                    <input type="text" class="form-control" name="keyword" placeholder="Cari Judul Buku" autocomplete="off">
                    <button type="submit" class="btn btn-primary input-group-append" name="cari">Cari</button>
                </form>
            </div>
            <div class="col-md-4">
                <a href="?page=managebuku" class="btn btn-primary">Tampilkan Semua Buku</a>
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
                            $id = $data["id"];
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
                                    <td>
                                    <a class="btn btn-danger" href="hapus.php?id=<?= $id; ?>" onclick="return confirm('Apakah data ini akan dihapus ?');">Hapus</a>
                                    <a class="btn btn-primary" href="?page=editbuku&id=<?= $id; ?>">Edit</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Koleksi Buku</h5>
                    <button type="button" class="close " data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                
                
                    <div class="modal-body">
                        <form method="post" action="#">
                            <div class="form-group">
                                <label for="kode">Kode Buku</label>
                                <input placeholder="Kode Buku" class="form-control" id="kode" type="text" name="kode" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="judul">Judul Buku</label>
                                <input placeholder="Judul Buku" class="form-control" id="judul" type="text" name="judul" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="judul">Penulis Buku</label>
                                <input placeholder="Penulis Buku" class="form-control" id="penulis" type="text" name="penulis" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="penerbit">Penerbit Buku</label>
                                <input placeholder="Penerbit Buku" class="form-control" id="penerbit" type="text" name="penerbit" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Tahun</label>
                                <input placeholder="Tahun" class="form-control" id="tahun" type="text" name="tahun" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah Buku</label>
                                <input placeholder="Jumlah Buku" class="form-control" id="jumlah" type="text" name="jumlah" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="jenis">Jenis Buku</label>
                                <input placeholder="Jenis Buku" class="form-control" id="jenis" type="text" name="jenis" autocomplete="off" required>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" name="submit" class="btn btn-primary ml-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Tambahkan</span>
                                </button>
                                <button type="button" class="btn" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Batal</span>
                                </button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>