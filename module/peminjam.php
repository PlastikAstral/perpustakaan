<?php
  $kueri = query("SELECT * FROM tblpinjam WHERE status='Pending' ORDER BY id ASC ");

    if ( isset($_GET["konfirmasikan"]) ) {

        if ( konfir($_GET) > 0 ) {
        echo "
          <script>
            alert('Berhasil dikonfirmasi!');
            window.location = '?page=peminjam';
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
        <h5>Konfirmasi Peminjaman</h5>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="table-responsive">
              <table class="table table-stripped tabble-sm">
                <thead>
                  <tr>
                    <th>Kode</th>
                    <th>Judul Buku</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Jumlah Pinjam</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ( $kueri as $data ) : ?>
                        <?php
                        $id = $data["id"];
                        $kode = $data["kode"];
                        $judul = $data["judul"];
                        $nama = $data["nama"];
                        $tanggal = $data["tanggal"];
                        $status = $data["status"];
                        $jmlpinjam = $data["jml_pinjam"]
                        ?>
                        <tr>
                        <td><?= $kode; ?></td>
                        <td><?= $judul; ?></td>
                        <td><?= $nama; ?></td>
                        <td><?= $tanggal; ?></td>
                        <td><?= $jmlpinjam; ?></td>
                        <td><?= $status == 'Pending' ? "<a class='btn btn-primary' href='?page=peminjam&konfirmasikan=$id'>Konfirmasi</a>" : $status; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <table>
        </div>
    </div>
</div>